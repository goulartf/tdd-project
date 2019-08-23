@extends('layouts.app')

@section('content')

    <div class="col-md-12">

        <div class="d-flex align-content-center justify-content-between">
            <h4>Your Auctions</h4>
            <a class="btn btn-primary" href="/auctions/create" role="button">Add</a>
        </div>
        <div class="clearfix"></div>
    </div>

    @if(count($auctions) > 0)

        @foreach($auctions as $index => $auction)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="https://picsum.photos/id/{{ $index }}/200/200"
                         alt="{{ $auction->title }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $auction->title }}</h4>
                        <p class="card-text">{{ $auction->description }}</p>
                        <p class="card-text">$ {{ $auction->price_start }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <form action="/auctions/{{ $auction->id }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger mr-4">Delete</button>
                        </form>
                        <a class="btn btn-outline-primary" href="/auctions/{{ $auction->id }}/edit" role="button">
                            Edit
                        </a>
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
