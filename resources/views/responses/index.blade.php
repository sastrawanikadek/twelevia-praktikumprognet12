@extends('layouts.admin')

@section('title')
  Review Responses
@endsection

@section('css')
    <style>
        .single-product {
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-xs-12">
        <form action="/admin/responses" method="POST">
            @csrf

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Review</h3>
                </div>
                <div class="box-body">
                    @foreach ($reviews as $review)
                        <div class="row single-product">
                            <div class="col-xs-12 col-md-4">
                                <img src="{{ $review->image_name }}" alt="{{ $review->product_name }}" class="img-responsive">
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <div class="form-group">
                                    <img src="{{ $review->profile_image }}" alt="{{ $review->name }}" height="150">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <h4>{{ $review->name }}</h4>
                                </div>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <h4>{{ $review->product_name }}</h4>
                                </div>
                                <div class="form-group">
                                    <label>Rating</label>
                                    <h4>{{ $review->rate }}</h4>
                                </div>
                                <div class="form-group">
                                    <label>Review Content</label>
                                    <h4>{{ $review->content }}</h4>
                                </div>
                                <div class="form-group">
                                    <label for="content">Response</label>
                                    <textarea name="content[]" id="content" rows="3" style="resize: none" class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="review_id[]" value="{{ $review->review_id }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" {{ count($reviews) > 0 ? '' : 'disabled' }}>Submit</button>
                </div>
            </div>
        </form>
    </div>
  </div>
  <!-- /.row -->
@endsection