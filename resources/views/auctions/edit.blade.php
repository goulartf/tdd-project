@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Auction</h4>
            <form action="/auctions/{{ $auction->id }}" method="post">
                @method('PUT')
                @include('auctions.form', ['auction' => $auction])
            </form>
        </div>
    </div>



@endsection
