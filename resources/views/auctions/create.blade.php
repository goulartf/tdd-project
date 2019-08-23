@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Auction</h4>
                <form action="/auctions" method="post" enctype="multipart/form-data">
                    @include('auctions.form', ["auction" => new \App\Auction])
                </form>
            </div>
        </div>
    </div>
@endsection
