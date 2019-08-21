@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Auction</h4>
            <form action="/auctions" method="post">

                @if($errors->any())

                    <ul class="list-group-item-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                @endif

                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Type your title"
                           aria-describedby="title">
                    <small id="helpId" class="text-muted"></small>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="start_date">Start</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                               placeholder="Start Date"
                               aria-describedby="start_date">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="end_date">End</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" placeholder="End Date"
                               aria-describedby="end_date">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="price_estimate">Price Estimate</label>
                        <input type="text" name="price_estimate" id="price_estimate" class="form-control"
                               placeholder="$1.000,00"
                               aria-describedby="price">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="price_start">Price Start</label>
                        <input type="text" name="price_start" id="price_start" class="form-control"
                               placeholder="$500,00"
                               aria-describedby="price_start">
                    </div>

                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" id="description" class="form-control" placeholder=""
                              aria-describedby=""></textarea>
                </div>

                <button type="submit" class="btn btn-success float-right">Save</button>

            </form>
        </div>
    </div>



@endsection
