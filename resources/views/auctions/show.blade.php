@extends('layouts.app')

@section('content')

    <h1>{{ $auction->title }}</h1>
    <h1>{{ $auction->description }}</h1>
    <h1>{{ $auction->price_start }}</h1>
    <h1>{{ $auction->price_estimate }}</h1>
    <h1>{{ $auction->start_date }}</h1>
    <h1>{{ $auction->end_date }}</h1>

@endsection
