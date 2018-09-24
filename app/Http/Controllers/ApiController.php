<?php

namespace App\Http\Controllers;

use App\Model\Agent_goods_collect;
use App\Model\Cate;
use App\Model\Goods;
use App\Model\Goods_attr;
use App\Model\Shop_users_address;
use App\Model\Users_cart;
use App\Model\Users_token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    //格式化返回格式
    private function json($data)
    {
        if (!isset($data['status'])) {
            $data['status'] = false;
        }
        if (!isset($data['message'])) {
            $data['message'] = '操作有误！';
        }
        return response()->json($data);
    }

    //收藏商品
    public function collectGood(Request $request)
    {
        $agent_goods_id = $request->get('agent_goods_id');
        if (!$agent_goods_id || !Goods::find($agent_goods_id)) {
            return $this->json([]);
        }
        $user = Auth::user();
        if (Agent_goods_collect::where('agent_goods_id', $agent_goods_id)->where('user_id', $user->id)->first()) {
            return $this->json([
                'status' => true,
                'message' => '商品已收藏'
            ]);
        }
        Agent_goods_collect::insert([
            'user_id' => $user->id,
            'agent_goods_id' => $agent_goods_id,
            'add_time' => date('Y-m-d H:i:s')
        ]);
        Goods::collection($agent_goods_id, 1);
        return $this->json([
            'status' => true,
            'message' => '商品已收藏'
        ]);
    }

    //添加购物车
    public function addBuyCar(Request $request)
    {
        $data = $request->except('_token');
        try {
            $res = Users_cart::where('agent_goods_id', $data['agent_goods_id'])
                ->where('attr', json_encode($data['attr']))
                ->first();
            if ($res) {
                return $this->json(['message' => '商品已在购物车中！']);
            }
            $goods_attr = Goods_attr::where('agent_goods_id', $data['agent_goods_id'])->get();
            if (count($goods_attr) == 1) {
                $res = 1;
                $data['attr'] = $goods_attr[0]->attr_value;
            } else {
                $res = 0;
                foreach ($goods_attr as $attr) {
                    if (!$attr->attr_value) {
                        break;
                    }
                    if (array_values(json_decode($attr->attr_value, true)) == array_values($data['attr'])) {
                        $res = 1;
                        if ($attr->attr_price * $data['num'] != $data['price_sum']) {
                            return $this->json(['message' => '操作有误！code[101]']);
                        }
                    }
                }
                $data['attr'] = json_encode($data['attr']);
            }
            //检测是否存在该属性集合
            if (!$res) {
                return $this->json(['message' => '操作有误！code[102]']);
            }
            Users_cart::insert([
                    'user_id' => Auth::user()->id,
                    'add_time' => date('Y-m-d H:i:s')
                ] + $data);
        } catch (\Exception $e) {
            Log::debug($e);
            return $this->json(['message' => '操作有误！code[103]']);
        }
        return $this->json(['status' => true, 'message' => '加入购物车成功！']);
    }

    //立即购买
    public function goToBuy(Request $request)
    {
        $data = $request->except('_token');
        return $this->json($data);
    }

    //获取顶级分类
    public function getTopCate()
    {
        $cate = Cate::getTopCate($this->agent_id());
        $data = [];
        if (!empty($cate)) {
            foreach ($cate as $value) {
                $data[] = [
                    'img' => agents_path($value['wap_image']),
                    'name' => $value['name'],
                    'id' => $value['id']
                ];
            }
        }
        return $this->json(['status' => true, 'message' => '获取成功！', 'list' => $data]);
    }

    //获取用户地址
    public function getUserAddress()
    {
        $user_id = Auth::user()->id;
        $data = Shop_users_address::getAddress($user_id);
        if (empty($data)) {
            return $this->json([
                'status' => true,
                'message' => '获取成功！',
                'list' => [],
                'default_id' => 0
            ]);
        }
        return $this->json([
            'status' => true,
            'message' => '获取成功！',
            'list' => $data,
            'default_id' => array_shift($data)['id']
        ]);
    }

    public function getCollection()
    {
        $user_id = Auth::user()->id;
        $collection = Agent_goods_collect::where('user_id', $user_id)->get();
        if ($collection->isEmpty()) {
            return $this->json([
                'status' => true,
                'message' => '您还没有收藏是商品',
                'list' => []
            ]);
        }
        $res = [];
        foreach ($collection as $item) {
            $good = $item->good;
            if (!$good) {
                break;
            }
            $res[] = [
                'id' => $item['agent_goods_id'],
                'imgurl' => agents_path($good->wap_image),
                'name' => $good->name,
                'price' => $good->market_price,
                'num' => $good->collection_num,
                'url' => '/wap/goodDetail/' . $good->agent_goods_id,
            ];
        }
        return $this->json([
            'status' => true,
            'message' => '查询成功',
            'list' => $res
        ]);
    }

    public function delCollection(Request $request)
    {
        $user_id = Auth::user()->id;
        $agent_goods_id = $request->get('id');
        $collection = Agent_goods_collect::where('agent_goods_id', $agent_goods_id)
            ->where('user_id', $user_id)
            ->first();
        if (!$collection) return $this->json(['message' => '收藏商品不存在']);
        Agent_goods_collect::where('agent_goods_id', $agent_goods_id)
            ->where('user_id', $user_id)
            ->delete();
        Goods::collection($agent_goods_id, 0);
        return $this->json([
            'status' => true,
            'message' => '商品已取消收藏'
        ]);
    }

    public function getCart()
    {
        $user = Auth::user();
        $data = Users_cart::getCart($user->id);
        if ($data->isEmpty()) {
            return $this->json([
                'status' => true,
                'message' => '获取成功！',
                'list' => [],
            ]);
        }
        $cart = [];
        foreach ($data as $item) {
            $good = $item->good;
            if ($good) {
                $cart[] = [
                    'car_id' => $item->id,
                    'id' => $item->agent_goods_id,
                    'pic' => agents_path($good->wap_image),
                    'name' => $good->name
                        . ($item->attr ? ' ' . implode(' ', json_decode($item->attr, true)) : ""),
                    'price' => $item->price_sum,
                    'number' => $item->num,
                    'scNum' => $good->collection_num,
                    'singlePrice' => $item->price_sum / $item->num
                ];
            }
        }
        return $this->json([
            'status' => true,
            'message' => '获取成功！',
            'list' => $cart,
        ]);
    }

    public function checkout(Request $request)
    {
        $data = $request->get('data') ?? '';
        if (!$data) {
            return $this->json([
                'status' => false,
                'message' => '您未选中需要结算的商品',
            ]);
        }
        return $this->json([
            'status' => true,
            'message' => '',
            'car_id' => implode('_', array_column($data, 'car_id')),
        ]);
    }

    public function getToken(Request $request)
    {
        $user_id = Auth::user()->id;
        $agent_id = $this->agent_id();
        $tokens = Users_token::getUserToken($user_id, $agent_id);
        return $this->json([
            'status' => true,
            'message' => '获取成功！',
            'list' => $tokens
        ]);
    }
}
