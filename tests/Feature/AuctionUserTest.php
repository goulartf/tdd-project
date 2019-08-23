<?php

namespace Tests\Feature;

use App\Auction;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuctionUserTest extends TestCase
{

    use WithFaker, RefreshDatabase;


    /** @test */
    public function guests_cannot_manage_projects()
    {
        $auction = factory(Auction::class)->create();

        $this->get('auctions')->assertRedirect('login');
        $this->get('auctions/create')->assertRedirect('login');
//        $this->get($project->path().'/edit')->assertRedirect('login');
//        $this->get($project->path())->assertRedirect('login');
        $this->post('auctions', $auction->toArray())->assertRedirect('login');
    }

    /** @test */
    public function guests_can_see_details()
    {
        $auction = factory(Auction::class)->create();

        $this->get("auctions/" . $auction->id . '/details')->assertStatus(200);
    }

    /** @test */
    public function guests_can_see_home()
    {
        factory(Auction::class)->create();

        $this->get("/")->assertStatus(200);
    }

    /** @test */
    public function an_authenticated_user_can_create_an_auction()
    {

        $user = $this->signIn();

        $this->get('/auctions/create')->assertStatus(200);
        $attributes = factory(Auction::class)->raw(["user_id" => $user->id]);

        $file = UploadedFile::fake()->image('auction.jpg');

        $attributes_images = [];
        $attributes_images["images"][] = $file;
        $attributes_images["images"][] = $file;

        $this->post('/auctions', array_merge($attributes, $attributes_images))
            ->assertSessionHasNoErrors()
            ->assertStatus(302);

        $this->assertDatabaseHas('auctions', $attributes);

        $auction = Auction::first();

        $auction->medias->each(function ($media) {
            Storage::assertExists($media->path);
        });

    }

    /** @test */
    public function an_authenticated_user_can_update_own_auction()
    {
        $user = $this->signIn();

        $auction = factory(Auction::class)->create(['user_id' => $user->id]);
        $attributes = $auction->toArray();
        $attributes["title"] = "changed";

        $file = UploadedFile::fake()->image('auction.jpg');

        $attributes_images = [];
        $attributes_images["images"][] = $file;
        $attributes_images["images"][] = $file;

        $this->get('/auctions/' . $auction->id . '/edit')->assertStatus(200);

        $this->put('/auctions/' . $auction->id, array_merge($attributes, $attributes_images))
            ->assertStatus(302);

        $this->assertDatabaseHas('auctions', $attributes);

        $auction = Auction::first();

        $auction->medias->each(function ($media) {
            Storage::assertExists($media->path);
        });

    }

    /** @test */
    public function an_authenticated_user_can_destroy_own_auction()
    {

        $user = $this->signIn();
        $auction = factory(Auction::class)->create(["user_id" => $user->id]);

        $this->delete('auctions/' . $auction->id)
            ->assertRedirect('/auctions');

        $this->assertDatabaseMissing('auctions', $auction->only('id'));

    }

    /** @test */
    public function an_authenticated_user_can_view_only_own_auction()
    {

        $user = $this->signIn();

        $auction = factory(Auction::class)->create(["user_id" => $user->id]);

        $this->get('auctions/' . $auction->id)->assertStatus(200);

    }

    /** @test */
    public function an_authenticated_user_can_list_only_own_auctions()
    {

        $user = $this->signIn();

        $auction = factory(Auction::class)->create(["user_id" => $user->id]);

        $this->get('auctions')->assertSeeText($auction["title"]);

    }

    /** @test */
    public function an_authenticated_user_cannot_view_auction_from_others()
    {
        $this->signIn();

        $auction = factory(Auction::class)->create();

        $this->get('auctions/' . $auction->id)->assertStatus(403);

    }

    /** @test */
    public function an_authenticated_user_cannot_list_auctions_from_others()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        factory(Auction::class)->create();

        $this->get('auctions')->assertSeeText("No Auctions available");

    }

    /** @test */
    public function an_authenticated_user_cannot_update_auctions_from_others()
    {
        $this->signIn();

        $auction = factory(Auction::class)->create();
        $attributes = $auction->toArray();

        $this->get('/auctions/' . $auction->id . '/edit')->assertStatus(403);

        $this->put('/auctions/' . $auction->id, $attributes)
            ->assertStatus(403);

        $this->assertDatabaseHas('auctions', $attributes);

    }

    /** @test */
    public function an_authenticated_user_cannot_destroy_auction_form_others()
    {

        $this->signIn();
        $auction = factory(Auction::class)->create();

        $this->delete('auctions/' . $auction->id)->assertStatus(403);

        $this->assertDatabaseHas('auctions', $auction->toArray());

    }

    /** @test */
    public function an_auction_requires_end_date_be_greater_than_start_date()
    {

        $this->signIn();

        $start_date = Carbon::now()->format('Y-m-d');
        $end_date = Carbon::now()->subDay()->format('Y-m-d');

        $attributes = factory(Auction::class)->raw(['start_date' => $start_date, 'end_date' => $end_date]);

        $this->post('/auctions', $attributes)->assertSessionHasErrors('end_date');

    }


}
