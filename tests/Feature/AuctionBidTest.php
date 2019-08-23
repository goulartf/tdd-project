<?php

namespace Tests\Feature;

use App\Auction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuctionBidTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function an_user_can_bid_an_auction()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $auction = factory(Auction::class)->create();
        $value = 100;

        $this->get('auctions/' . $auction->id . '/details')->assertStatus(200);

        $this->post('auctions/' . $auction->id . '/bid', ["value" => $value])
            ->assertRedirect('auctions/' . $auction->id . '/details');

        $this->get('auctions/' . $auction->id . '/details')->assertSee($value);

    }

    /** @test */
    public function a_bid_require_a_value()
    {

        $this->signIn();

        $auction = factory(Auction::class)->create();

        $this->post('auctions/' . $auction->id . '/bid', ["value" => ""])->assertSessionHasErrors('value');

    }


    /** @test */
    public function a_bid_require_a_value_be_greather_than_last()
    {

        $user = $this->signIn();

        $auction = factory(Auction::class)->create();

        $auction->bids()->create(["user_id" => $user->id, "value" => 100]);

        $this->post('auctions/' . $auction->id . '/bid', ["value" => 100])->assertSessionHasErrors('value');

    }

    /** @test */
    public function a_first_bid_require_a_value_be_greather_than_start_price_auction()
    {

        $this->signIn();

        $auction = factory(Auction::class)->create();

        $this->post('auctions/' . $auction->id . '/bid', ["value" => 100])->assertSessionHasErrors('value');

    }

}
