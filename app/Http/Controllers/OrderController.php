<?php

namespace App\Http\Controllers;


class OrderController extends Controller
{
    public function index(){
        return view('pages.customer.orders');
    }

    public function show(){
         return view('pages.customer.single-order');
    }

}
