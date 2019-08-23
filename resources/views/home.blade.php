@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        @if(count($auctions) > 0)
            <div class="card-columns">
                @foreach($auctions as $index => $auction)
                    <div class="card">
                        <a href="/auctions/{{ $auction->id }}/details">
                            <img class="card-img-top" src="https://picsum.photos/id/{{ $auction->id }}/200/200"
                                 alt="{{ $auction->title }}">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">{{ $auction->title }}</h4>
                            <p class="card-text">{{ $auction->description }}</p>
                            <p class="card-text">Estimate Price $ {{ $auction->price_start }}</p>
                            <p class="card-text">Start Price  $ {{ $auction->price_start }}</p>
                            <p class="card-text">Last  Bid $ {{ $auction->getLastBid()->value ?? "No bid available"  }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card w-100">
                <div class="card-body text-center">
                    <h4 class="card-title">No Auctions available</h4>
                </div>
            </div>
        @endif
    </div>
@endsection
