<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Events\Order;


class OrderController extends Controller
{
    private $user;
    private $items;
    private $payment;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if ($request->session()->missing('items')) {
                return redirect()->route('cart');
            }

            $this->user    = Auth::user();
            $this->items   = $request->session()->get('items');
            $this->payment = $request->get('payment');

            return $next($request);
        });
    }

    public function confirm()
    {
        return view('confirm-order', [
            'user'  => $this->user,
            'items' => $this->items,
        ]);
    }

    public function complete(Request $request)
    {
        $order_id = DB::table('orders')
            ->insertGetId([
                'user_id' => $this->user->id,
                'payment' => $this->payment,
            ]);

        foreach ($this->items as $item) {
            DB::table('order_details')
                ->insert([
                    'order_id'   => $order_id,
                    'product_id' => $item->id,
                    'quantity'   => $item->qty,
                ]);

            DB::table('products')
                ->where('id', $item->id)
                ->update([
                    'stock' => $item->stock - $item->qty,
                ]);
        }

        /* NOTE: メール送信の為のイベント */
        Order::dispatch($this->user, $this->items, $this->payment);

        $request->session()->forget('items');

        return redirect()->route('order.history')
            ->with('status', __('messages.complete.order'));
    }
}