<?php

namespace Tests\Unit;

use App\Auction;
use App\Bid;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuctionTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_has_bids()
    {
        $auction = factory(Auction::class)->create();

        $this->assertInstanceOf(Collection::class, $auction->bids);
    }


    /** @test */
    public function it_has_medias()
    {
        $auction = factory(Auction::class)->create();

        $this->assertInstanceOf(Collection::class, $auction->medias);
    }

    /** @test */
    public function show_last_bid_value()
    {

        $auction = factory(Auction::class)->create();
        factory(Bid::class, 10)->create(["auction_id" => $auction->id]);

        $bid = Bid::latest()->first();

        $auction->getLastBid();

        $this->assertEquals($bid, $auction->getLastBid());

    }


}
