@extends('layouts.app')

@section('content')

    <div class="col-sm">
        <div class="card">
            <img class="card-img-top" src="https://picsum.photos/id/{{ $auction->id }}/800/800"
                 alt="{{ $auction->title }}">
            <div class="card-body">
                <h4 class="card-title">{{ $auction->title }}</h4>
                <p class="card-text">{{ $auction->description }}</p>
                <p class="card-text">$ {{ $auction->price_start }}</p>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <form class="form-inline" method="post" action="{{ "/auctions/".$auction->id ."/bid" }}">
            @csrf
            <div class="form-group">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="text" name="value" class="form-control {{ $errors->has('value') ? "is-invalid" : "" }}"
                           id="value" placeholder="bid here">
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-auto ">Submit</button>
            </div>
        </form>
        <ul class="list-group">
            @forelse($auction->bids as $bid)
                <li class="list-group-item d-flex justify-content-between align-items-center {{ $loop->first ? "active" : "" }}">
                    {{ $bid->user->name }}
                    <span class="badge badge-secondary badge-pill">{{ $bid->value }}</span>
                </li>
            @empty
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p> No bids available</p>
                </li>
            @endforelse
        </ul>
    </div>

@endsection
