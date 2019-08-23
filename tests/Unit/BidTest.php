<?php

namespace Tests\Unit;

use App\Auction;
use App\Bid;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BidTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_an_user()
    {
        $bid = factory(Bid::class)->create();
        $this->assertInstanceOf(User::class, $bid->user);
    }

    /** @test */
    public function it_belongs_to_an_auction()
    {
        $bid = factory(Bid::class)->create();
        $this->assertInstanceOf(Auction::class, $bid->auction);
    }

}
