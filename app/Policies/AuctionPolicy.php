<?php

namespace App\Policies;

use App\User;
use App\Auction;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuctionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any auctions.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the auction.
     *
     * @param \App\User $user
     * @param \App\Auction $auction
     * @return mixed
     */
    public function view(User $user, Auction $auction)
    {
        return $user->id == $auction->user_id;
    }

    /**
     * Determine whether the user can create auctions.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the auction.
     *
     * @param \App\User $user
     * @param \App\Auction $auction
     * @return mixed
     */
    public function update(User $user, Auction $auction)
    {
        return $user->id == $auction->user_id;
    }

    /**
     * Determine whether the user can delete the auction.
     *
     * @param \App\User $user
     * @param \App\Auction $auction
     * @return mixed
     */
    public function delete(User $user, Auction $auction)
    {
        return $user->id == $auction->user_id;
    }

    /**
     * Determine whether the user can restore the auction.
     *
     * @param \App\User $user
     * @param \App\Auction $auction
     * @return mixed
     */
    public function restore(User $user, Auction $auction)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the auction.
     *
     * @param \App\User $user
     * @param \App\Auction $auction
     * @return mixed
     */
    public function forceDelete(User $user, Auction $auction)
    {
        //
    }
}
