<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('promotions.index', compact('coupons'));
    }
}
