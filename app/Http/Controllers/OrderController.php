<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Phone;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if(count($cart) == 0) return redirect('/cart')->with('error', 'Giỏ hàng đang trống!');

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $paymentMethods = PaymentMethod::all();

        return view('checkout.index', compact('cart', 'total', 'paymentMethods'));
    }

    public function index()
    {
        $customer = Auth::user()->customer;
        
        $orders = $customer 
            ? Order::where('customer_id', $customer->id)->with('status')->latest()->paginate(10)
            : collect([]); // Empty collection/paginator behavior handled in view or return empty
            
        // If it's a collection, paginate won't work directly if we just pass collection. 
        // Better to just check if $customer exists.
        if (!$customer) {
            $orders = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
        }

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $customer = Auth::user()->customer;
        if (!$customer) {
            return redirect()->route('orders.index')->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $order = Order::where('customer_id', $customer->id)
            ->with(['status', 'paymentMethod', 'details.phone'])
            ->findOrFail($id);
            
        return view('orders.show', compact('order'));
    }

    public function checkCoupon(Request $request)
    {
        $coupon = Coupon::where('couponCode', $request->code)->first();
        if ($coupon) {
            return response()->json([
                'success' => true,
                'discount' => $coupon->discountValue
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Mã giảm giá không tồn tại'
        ]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shippingAddress' => 'required',
            'payment_method_id' => 'required'
        ]);

        $cart = session()->get('cart', []);
        if(count($cart) == 0) return redirect('/cart')->with('error', 'Giỏ hàng đang trống!');

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $coupon = null;
        $discountAmount = 0;
        if ($request->coupon_code) {
            $coupon = Coupon::where('couponCode', $request->coupon_code)->first();
            if ($coupon) {
                $discountAmount = $coupon->discountValue;
            }
        }

        $finalTotal = $total - $discountAmount;
        if ($finalTotal < 0) $finalTotal = 0;

        DB::beginTransaction();
        try {
            $orderStatus = OrderStatus::where('statusName', 'Chờ duyệt')->first();
            
            $customer = Auth::user()->customer;
            if (!$customer) {
                // Lazy create customer record for legacy users or admins buying things
                $customer = \App\Models\Customer::create(['user_id' => Auth::id()]);
            }

            $order = Order::create([
                'customer_id' => $customer->id,
                'orderDate' => now(),
                'totalAmount' => $finalTotal,
                'shippingAddress' => $request->shippingAddress,
                'payment_method_id' => $request->payment_method_id,
                'status_id' => $orderStatus->id,
                'coupon_id' => $coupon ? $coupon->id : null,
                'discount_amount' => $discountAmount,
                'trackingInfo' => 'Sẽ được cập nhật sau'
            ]);

            foreach($cart as $id => $details) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'phone_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);

                // Giảm số lượng tồn kho
                $phone = Phone::find($id);
                $phone->stockQuantity -= $details['quantity'];
                $phone->save();
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.show', $order->id)->with('success', 'Đơn hàng của bạn đã được đặt thành công! Vui lòng thanh toán để hoàn tất.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
