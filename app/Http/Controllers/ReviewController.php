<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $phoneId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string|max:255',
        ]);

        if(!Auth::check()) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đánh giá.');
        }

        $customer = Auth::user()->customer;
        if(!$customer) {
             // Create customer if not exists (fallback)
             $customer = \App\Models\Customer::create(['user_id' => Auth::id()]);
        }

        Review::create([
            'customer_id' => $customer->id,
            'phone_id' => $phoneId,
            'rating' => $request->rating,
            'description' => $request->description,
            'reviewDate' => now(),
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
}
