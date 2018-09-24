<?php

namespace Modules\Wap\Http\Controllers;


use App\Model\Shop_users_address;
use App\Model\Users_cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function confirm(Request $request)
    {
        $address = $request->get('address') ?? '';
        if ($address) {
            $address = Shop_users_address::find($address);
            $good = session('orderGood');
        } else {
            $address = UserController::getDefaultAddress();
            if ($request->method() == 'POST') {
                $good = $this->getGoodByAttr($request->except('_token'));
            } else {
                $car_id = $request->get('car_id') ?? '';
                if (!$car_id) {
                    $data = [
                        'message' => '您还未选择商品',
                        'url' => '/wap'
                    ];
                    return response()->view('wap::404', $data, 200);
                }
                $good = $this->getGoodByCar(explode('_', $car_id));
            }
            session(['orderGood' => $good]);
        }
        if (count($good['good']) > 1 && $good['is_car'] ?? '') {
            $back_url = '/wap/car';
        } else {
            $back_url = '/wap/goodDetail/' . $good['good'][0]['good_id'];
        }
        $order['sum'] = $good['sum'];
        return view('wap::orderConfirm')
            ->with('good', $good)
            ->with('order', $order)
            ->with('address', $address)
            ->with('back_url', $back_url);
    }

    private function getGoodByAttr($data)
    {

    }

    private function getGoodByCar($car_id_arr)
    {
        $cars = Users_cart::whereIn('id', $car_id_arr)->get();
        if (!$cars) {
            return [];
        }
        $data = [];
        $data['sum'] = 0;
        $data['is_car'] = 1;
        foreach ($cars as $car) {
            $good = $car->good;
            if (!$good) {
                continue;
            }
            $name = $good->name;
            $name .= $car->attr ? ' ' . implode(' ', json_decode($car->attr, true)) : '';
            $data['good'][] = [
                'good_id' => $car->agent_goods_id,
                'num' => $car->num,
                'name' => $name,
                'single_price' => bcdiv($car->price_sum, $car->num),
                'pic' => agents_path($good->wap_image),
            ];
            $data['sum'] += $car->price_sum;
        }
        return $data;
    }

}
