<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPhones = Phone::whereHas('status', function($query) {
            $query->where('statusName', 'Mới');
        })->latest()->take(8)->get();

        $allPhones = Phone::latest()->paginate(12);

        return view('welcome', compact('featuredPhones', 'allPhones'));
    }
}
