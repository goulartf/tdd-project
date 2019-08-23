<?php

namespace App\Http\Controllers;

use App\Auction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $auctions = Auction::all();

        return view('home',compact('auctions'));
    }
}
