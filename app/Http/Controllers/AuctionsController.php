<?php

namespace App\Http\Controllers;

use App\Auction;
use Illuminate\Http\Request;

class AuctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions = Auction::all();

        return view('auctions.index', compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auctions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributes = request()->validate([
            "title" => "required|max:191",
            "description" => "required",
            "price_start" => "required|numeric",
            "price_estimate" => "required|numeric",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date'"
        ]);

        $auction = auth()->user()->auctions()->create($attributes);

        return redirect('/auctions/'.$auction->id);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        return view('auctions.show', compact('auction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
