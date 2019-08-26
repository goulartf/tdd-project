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
    public function it_show_last_bid_value()
    {

        $auction = factory(Auction::class)->create();
        factory(Bid::class, 10)->create(["auction_id" => $auction->id]);

        $bid = Bid::latest()->first();

        $auction->getLastBid();

        $this->assertEquals($bid, $auction->getLastBid());

    }

    /** @test */
    public function it_lower_bids_than_start_price()
    {

        $auction = factory(Auction::class)->create();

        $value = $auction->price_start - 1;

        $bid_lower = factory(Bid::class)->create(["auction_id" => $auction->id, "value" => rand(0, $value)]);
        $bid_higher = factory(Bid::class)->create(["auction_id" => $auction->id, "value" => $auction->price_start + 1]);

        $this->assertTrue($auction->lowerBids->contains($bid_lower));
        $this->assertFalse($auction->lowerBids->contains($bid_higher));
        $this->assertInstanceOf(Collection::class, $auction->lowerBids);

    }

    /** @test */
    public function it_higher_bids_than_start_price()
    {

        $auction = factory(Auction::class)->create();


        $value = $auction->price_start - 1;

        $bid_lower = factory(Bid::class)->create(["auction_id" => $auction->id, "value" => rand(0, $value)]);
        $bid_higher = factory(Bid::class)->create(["auction_id" => $auction->id, "value" => $auction->price_start + 1]);

        $this->assertTrue($auction->higherBids->contains($bid_higher));
        $this->assertFalse($auction->higherBids->contains($bid_lower));
        $this->assertInstanceOf(Collection::class, $auction->higherBids);

    }


}
