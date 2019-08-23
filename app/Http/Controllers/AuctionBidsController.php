<?php

namespace App\Http\Controllers;

use App\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuctionBidsController extends Controller
{
    public function store(Request $request, Auction $auction)
    {

//        request()->validate(['value' => 'required']);

        Validator::make($request->all(), [
            'value' => [
                'required',
//                function ($attribute, $value, $fail) use ($auction) {
//                    if ($auction->bids->count() == 0 && $value <= $auction->price_start) {
//                        $fail($attribute . ' Must be greather than start price ' . $auction->price_start);
//                    }
//                },
//                function ($attribute, $value, $fail) use ($auction) {
//                    $bid = $auction->bids->first();
//                    if ($bid && $value <= $bid->value) {
//                        $fail($attribute . ' already exists. Must be greather than ' . $bid->value);
//                    }
//                },
            ]
        ])->validate();

        $auction->bids()->create(["value" => request('value'), "user_id" => auth()->id()]);

        return redirect('/auctions/' . $auction->id . '/details');

    }
}
