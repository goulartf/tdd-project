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
        $auctions = auth()->user()->auctions;

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
            "end_date" => "required|date|after_or_equal:start_date",
            "images" => "required|array",
            "images.*" => "required|image:png,jpeg|max:2000"
        ]);

        unset($attributes["images"]);

        $auction = auth()->user()->auctions()->create($attributes);

        collect($request->images)->each(function ($image) use ($request, $auction) {

            $path = $image->store('auctions');
            $filename = basename($path);

            $auction->medias()->create(["path" => $path, 'filename' => $filename]);

        });

        return redirect('/auctions/' . $auction->id);

    }

    /**
     * Display the specified resource.
     *
     * @param Auction $auction
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Auction $auction)
    {
        $this->authorize('view', $auction);

        return view('auctions.show', compact('auction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Auction $auction
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Auction $auction)
    {
        $this->authorize('update', $auction);
        return view('auctions.edit', compact('auction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Auction $auction
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Auction $auction)
    {
        $this->authorize('update', $auction);

        $attributes = request()->validate([
            "title" => "required|max:191",
            "description" => "required",
            "price_start" => "required|numeric",
            "price_estimate" => "required|numeric",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
            "images.*" => "image:png,jpeg|max:2000"
        ]);

        unset($attributes["images"]);

        $auction->update($attributes);

        collect($request->images)->each(function ($image) use ($request, $auction) {

            $path = $image->store('auctions');
            $filename = basename($path);

            $auction->medias()->create(["path" => $path, 'filename' => $filename]);

        });

        return redirect('/auctions/' . $auction->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Auction $auction
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Auction $auction)
    {
        $this->authorize('delete', $auction);

        $auction->delete();

        return redirect('/auctions');
    }

    /**
     * Display the specified resource.
     *
     * @param Auction $auction
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function details(Auction $auction)
    {
        return view('auctions.details', compact('auction'));
    }

}
