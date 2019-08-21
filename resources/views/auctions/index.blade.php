@extends('layouts.app')

@section('content')

    <ul>
        @forelse($auctions as $auction)
            <li>{{ $auction->title }}</li>
        @empty
            <li>No auctions available</li>
        @endforelse
    </ul>

@endsection
