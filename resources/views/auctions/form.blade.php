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
    <input type="text" name="title" id="title" class="form-control"
           value="{{ old('title', $auction->title) }}"
           aria-describedby="title">
    <small id="helpId" class="text-muted"></small>
</div>

<div class="form-row">

    <div class="form-group col-md-3">
        <label for="start_date">Start</label>
        <input type="date" name="start_date" id="start_date" class="form-control"
               value="{{ old('start_date',  $auction->start_date ? $auction->start_date->format('Y-m-d') : '') }}"
               aria-describedby="start_date">
    </div>

    <div class="form-group col-md-3">
        <label for="end_date">End</label>
        <input type="date" name="end_date" id="end_date" class="form-control"
               value="{{ old('end_date', $auction->end_date ? $auction->end_date->format('Y-m-d') : '') }}"
               aria-describedby="end_date">
    </div>

</div>

<div class="form-row">

    <div class="form-group col-md-3">
        <label for="price_estimate">Price Estimate</label>
        <input type="text" name="price_estimate" id="price_estimate" class="form-control"
               value="{{ old('price_estimate', $auction->price_estimate) }}"
               aria-describedby="price">
    </div>

    <div class="form-group col-md-3">
        <label for="price_start">Price Start</label>
        <input type="text" name="price_start" id="price_start" class="form-control"
               value="{{ old('price_start', $auction->price_start) }}"
               aria-describedby="price_start">
    </div>

</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" name="description" id="description" class="form-control" placeholder=""
              aria-describedby="">{{ old('description', $auction->description) }}</textarea>
</div>

<button type="submit" class="btn btn-success float-right">Save</button>

