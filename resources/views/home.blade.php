@extends('layouts.app')

@section('content')
    @if(count($auctions) > 0)
        @foreach($auctions as $index => $auction)
            <div class="col-md-4">
                <div class="card">

                    @if($auction->medias->count() > 0)
                    <div id="carouselExampleInterval{{ $index }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($auction->medias as $media)
                                <div class="carousel-item {{ $loop->first ? "active" : ''  }}" data-interval="1000">
                                    <img src="{{ asset('/storage/'.$media->path) }}" class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleInterval{{ $index }}" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleInterval{{ $index }}" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    @else
                        <img src="https://via.placeholder.com/200/c0c0c0?Text=Digital.com" class="card-img-top" alt="...">
                    @endif

                    <div class="card-body">
                        <h4 class="card-title">{{ $auction->title }}</h4>
                        <p class="card-text">{{ $auction->description }}</p>
                        <p class="card-text">Estimate Price $ {{ $auction->price_start }}</p>
                        <p class="card-text">Start Price $ {{ $auction->price_start }}</p>
                        <p class="card-text">Last Bid
                            $ {{ $auction->getLastBid()->value ?? "No bid available"  }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="card w-100">
            <div class="card-body text-center">
                <h4 class="card-title">No Auctions available</h4>
            </div>
        </div>
    @endif





@endsection
