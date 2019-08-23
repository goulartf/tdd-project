@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Auction</h4>
                <form action="/auctions/{{ $auction->id }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @include('auctions.form', ['auction' => $auction])
                </form>
            </div>
        </div>
    </div>
@endsection
