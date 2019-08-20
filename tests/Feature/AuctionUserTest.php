<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuctionUserTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function user_can_create_an_auction()
    {

        $this->withoutExceptionHandling();

        $attributes = factory('App\Auction')->create();

        $this->post('/auctions', $attributes)->assertSeeText($attributes['title']);

        $this->assertDatabaseHas('auctions', $attributes);

    }

}
