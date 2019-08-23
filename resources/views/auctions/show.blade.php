@extends('layouts.app')

@section('content')

    <div class="col-sm">
        <div class="card">
            <div class="card-body">
                @foreach($auction->medias as $media)
                    <img src="{{ asset('storage/'.$media->path) }}" alt="{{ $auction->title }}"
                         width="100"
                         height="100"/>
                @endforeach
                <h4 class="card-title">{{ $auction->title }}</h4>
                <p class="card-text">{{ $auction->description }}</p>
                <p class="card-text">$ {{ $auction->price_start }}</p>
            </div>
        </div>
    </div>

@endsection
