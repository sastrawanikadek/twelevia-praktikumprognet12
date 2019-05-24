@extends('layouts.admin')

@section('title')
  Review Products
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
        <form action="/transactions/{{ $id }}/review" method="POST">
            @csrf

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Review</h3>
                </div>
                <div class="box-body">
                    @foreach ($transactions as $transaction)
                        <div class="row single-product">
                            <div class="col-xs-12 col-md-3">
                                <img src="{{ $transaction->image_name }}" alt="{{ $transaction->product_name }}" class="img-responsive">
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <div class="form-group">
                                    <label>Name</label>
                                    <h4>{{ $transaction->product_name }}</h4>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <h4>{!! $transaction->discount > 0 ? "<span class='price' style='text-decoration: line-through; margin-right: 8px;'>{$transaction->real_price}</span>" : "" !!}<span class="price">{{ $transaction->selling_price }}</span></h4>
                                </div>
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select name="rating[]" class="form-control">
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="content">Description</label>
                                    <textarea name="content[]" rows="3" class="form-control" style="resize: none"></textarea>
                                </div>
                                <input type="hidden" name="product_id[]" value="{{ $transaction->id }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
  </div>
  <!-- /.row -->
@endsection

@section('script')
    <script>
        $('.price').each(function(index, element){
            const price = parseInt(element.innerText);

            element.innerText = 'Rp' + price.toLocaleString(['ban','id']);
        });
    </script>
@endsection