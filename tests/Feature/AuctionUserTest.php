<?php

namespace Tests\Feature;

use App\Auction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuctionUserTest extends TestCase
{

    use WithFaker, RefreshDatabase;


    /** @test */
    public function only_authenticated_users_can_create_auction()
    {
        $auction = factory(Auction::class)->raw();

        $this->post('/auctions', $auction)->assertRedirect('login');
    }

    /** @test */
    public function user_can_create_an_auction()
    {

        $this->signIn();

        $this->get('/auctions/create')->assertStatus(200);

        $this->followingRedirects()
            ->post('/auctions', $attributes = factory('App\Auction')->raw())
            ->assertSessionHasNoErrors()
            ->assertSee($attributes["title"])
            ->assertSee($attributes["description"]);

    }

    /** @test */
    public function a_user_can_view_a_auction()
    {

        $this->signIn();

        $auction = factory('App\Auction')->create();

        $this->get('auctions/' . $auction->id)
            ->assertSee($auction->title);

    }


}
