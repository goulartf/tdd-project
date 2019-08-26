<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = ['start_date', 'end_date'];


    public function bids()
    {
        return $this->hasMany(Bid::class)->latest();
    }

    public function lowerBids()
    {
        $start_price = $this->price_start;
        return $this->hasMany(Bid::class)->where(function ($query) use ($start_price) {
            return $query->where('value', '<', $start_price);
        });
    }

    public function higherBids()
    {
        $start_price = $this->price_start;
        return $this->hasMany(Bid::class)->where(function ($query) use ($start_price) {
            return $query->where('value', '>=', $start_price);
        });
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function getLastBid()
    {
        return $this->bids()->first();
    }

}
