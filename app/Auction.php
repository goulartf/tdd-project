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

    public function getLastBid()
    {
        return $this->bids()->first();
    }

}
