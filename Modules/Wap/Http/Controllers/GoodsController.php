<?php

namespace Modules\Wap\Http\Controllers;

use App\Model\Agent_goods_attribute;
use App\Model\Agent_shop;
use App\Model\Agents;
use App\Model\Cate;
use App\Model\Goods;
use App\Model\Goods_attr;
use App\Model\Goods_pic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getGood()
    {
        $this->agent_id = substr($this->agent_id(), 2);
        $data = Goods::getGoodsForIndex($this->agent_id(), $_GET['page'], 6);
        return response()->json($data);
    }

    public function goodDetail($good_id)
    {
        $agent_id = $this->agent_id();
        $good = Goods::getGoodDetail($good_id);
        if (!$good) return view('wap::404')->with(['message' => '商品不存在！', 'url' => url('/wap')]);
        if (!$good->agent_id == $this->agent_id() || $good->status != 1) {
            return view('wap::404')->with(['message' => '商品不存在！', 'url' => url('/wap')]);
        }
        $good_attr = $good->attr->toArray();
        $good_brand = $good->brand->toArray();
        $good_cate = $good->cate->toArray();
        $good = $good->toArray();
        $good['attr'] = $good_attr;
        $good['brand'] = $good_brand;
        $good['cate'] = $good_cate;
        if ($good_attr) {
            $attr_price = array_column($good_attr, 'attr_price');
            sort($attr_price);
            $good['attr_price'] = array_shift($attr_price);
        }
        $good['goods_content'] = $this->changeContent($good['goods_content']);
        $good['picture'] = Goods_pic::where('agent_goods_id', $good_id)
            ->where('type', 'wap')
            ->orderBy('sort', 'desc')
            ->get();
        Goods::where('agent_goods_id', $good_id)->increment('click_count');
        $agent = Agent_shop::where('agent_id', $agent_id)->first();
        $attr = $this->getGoodAttr($good_id);
        if (!$attr) {
            $data = [
                'message' => '商品数据异常！',
                'url' => '/wap'
            ];
            return response()->view('wap::404', $data, 200);
        }
        return view('wap::goodDetail')->with('good', $good)
            ->with('attr', $attr)
            ->with('agent', $agent)
            ->with('commandGood', $this->getCommandGood($good_id));
    }

    public function getGoodAttr($good_id)
    {
        $attr = Goods_attr::select('attr_id', 'attr_price', 'attr_value', 'num')
            ->where('agent_goods_id', $good_id)
            ->get();
        if (!$attr) return [] or $attr = $attr->toArray();
        $attr_id = json_decode($attr[0]['attr_id'], true);
        if (!$attr_id) return ['attr' => [], 'price' => $attr[0]['attr_price']];
        $attribute = Agent_goods_attribute::select('attr_name', 'attr_id', 'attr_type')
            ->whereIn('attr_id', $attr_id)->get()->toArray();
        $good_attr = [];
        $attr_value = [];
        foreach ($attr as &$value) {
            if (!empty($attr_value)) {
                foreach ($attr_value as $key => &$item) {
                    if (is_array($item)) {
                        $item = array_unique(array_merge($item, [json_decode($value['attr_value'], true)[$key]]));
                    } else {
                        $item = array_unique([$item, json_decode($value['attr_value'], true)[$key]]);
                    }
                }
            } else {
                $attr_value = json_decode($value['attr_value'], true);
            }
            $good_attr[] = [
                'price' => $value['attr_price'],
                'value' => array_values(json_decode($value['attr_value'], true))
            ];
        }
        foreach ($attribute as &$value) {
            $value = [
                'name' => $value['attr_name'],
                'value' => $attr_value[$value['attr_id']],
                'type' => $value['attr_type'],
                'id' => $value['attr_id'],
            ];
        }
        return ['attr' => $attribute, 'price' => json_encode($good_attr)];
    }

    public function getCommandGood($id)
    {
        $good = Goods::find($id);
        if (!$good) return [];
        //先根据分类搜索
        $commandGood = Goods::where('cate_id', $good->cate_id)
            ->where('status', 1)
            ->where('agent_goods_id', '!=', $id)
            ->orderBy('click_count', 'desc')
            ->limit(3)
            ->get();
        if ($commandGood) {
            if (count($commandGood) == 3) return $commandGood;
        }
        //根据品牌
        $commandGood2 = Goods::where('brand_id', $good->brand_id)
            ->where('status', 1)
            ->where('agent_goods_id', '!=', $id)
            ->orderBy('click_count', 'desc')
            ->limit(3)
            ->get();
        if ($commandGood2) {
            $commandGood = !$commandGood->isEmpty() ? array_merge($commandGood, $commandGood2) : $commandGood2;
            if (count($commandGood) == 3) return $commandGood;
        }
        $commandGood2 = Goods::where('status', 1)
            ->where('agent_goods_id', '!=', $id)
            ->orderBy('click_count', 'desc')
            ->limit(3)
            ->get();
        if ($commandGood2) {
            $commandGood = !$commandGood->isEmpty() ? array_merge($commandGood, $commandGood2) : $commandGood2;
        }
        return $commandGood;
    }

    private function changeContent($data)
    {
        //图片
        $data = str_replace('src="', 'src="' . env('BACKEND_URL'), $data);
        //链接
        $data = str_replace('href="', 'href="' . env('BACKEND_URL'), $data);
        return $data;
    }

}
