@extends('layouts.admin')

@section('title')
  Dashboard
@endsection

@section('css')
    <style>
        .box-tab {
            border-bottom: 1px solid #f4f4f4;
        }

        .box-tab .col-xs-2 {
            padding: 0 10px;
        }

        .box-tab .btn {
            width: 100%;
            height: 100%;
            background-color: transparent;
            border-radius: 0;
        }

        .box-tab .btn:focus, .box-tab .btn:active {
            outline: none;
            box-shadow: none;
        }

        .box-tab .btn.active {
            border-bottom: 2px solid #1abc9c;
        }

        .box-tab .btn .fa {
            color: #1abc9c;
        }

        .box-tab .btn h6 {
            line-height: 21px;
        }

        
        .product-image {
            width: 150px;
            max-height: 150px;
        }

        .product-image img {
            height: 150px;
            width: 100%;
            object-fit: contain;
        }

        @media (min-width: 968px){
            .box-tab .btn h6 {
                font-size: 18px;
            }

            .single-product {
                padding: 16px;
            }
        }

        @media (max-width: 967px){
            .box-tab .btn {
                padding: 6px 0;
            }

            .box-tab .btn .fa {
                font-size: 16px;
            }

            .single-product {
                padding: 8px;
            }
        }
    </style>
@endsection

@section('content')
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">My Order</h3>
            </div>
            <div class="box-body">
                <div class="row box-tab">
                    <div class="col-xs-2">
                        <a href="/home/not-pay" class="btn {{ Request::is('home') || Request::is('home/not-pay') ? 'active' : '' }}">
                            <h6><i class="fa fa-credit-card"></i></h6>
                            <h6>Not Pay</h5>
                        </a>
                    </div>
                    <div class="col-xs-2">
                        <a href="/home/unverified" class="btn {{ Request::is('home/unverified') ? 'active' : '' }}">
                            <h6><i class="fa fa-circle-o-notch"></i></h6>
                            <h6>Unverified</h5>
                        </a>
                    </div>
                    <div class="col-xs-2">
                        <a href="/home/verified" class="btn {{ Request::is('home/verified') ? 'active' : '' }}">
                            <h6><i class="fa fa-check-square-o"></i></h6>
                            <h6>Verified</h5>
                        </a>
                    </div>
                    <div class="col-xs-2">
                        <a href="/home/delivered" class="btn {{ Request::is('home/delivered') ? 'active' : '' }}">
                            <h6><i class="fa fa-home"></i></h6>
                            <h6>Delivered</h5>
                        </a>
                    </div>
                    <div class="col-xs-2">
                        <a href="/home/expired" class="btn {{ Request::is('home/expired') ? 'active' : '' }}">
                            <h6><i class="fa fa-clock-o"></i></h6>
                            <h6>Expired</h5>
                        </a>
                    </div>
                    <div class="col-xs-2">
                        <a href="/home/cancel" class="btn {{ Request::is('home/cancel') ? 'active' : '' }}">
                            <h6><i class="fa fa-times-circle-o"></i></h6>
                            <h6>Cancel</h5>
                        </a>
                    </div>
                </div>
                <div class="row">
                    @foreach ($transactions as $transaction) 
                        <div class="col-xs-12">
                            <div class="single-product">
                                <div class="col-xs-12 col-md-6">
                                    <h5><span style="margin-right: 16px;">Province</span><span>{{ $transaction->province }}</span></h5>
                                    <h5><span style="margin-right: 16px;">Regency</span><span>{{ $transaction->regency }}</span></h5>
                                    <h5><span style="margin-right: 16px;">Address</span><span>{{ $transaction->address }}</span></h5>
                                    <h5><span style="margin-right: 16px;">Expire In</span><span>{{ $transaction->timeout }}</span></h5>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <h5><span style="margin-right: 16px;">Sub Total</span><span class="price">{{ $transaction->sub_total }}</span></h5>
                                    <h5><span style="margin-right: 16px;">Shipping Cost</span><span class="price">{{ $transaction->shipping_cost }}</span></h5>
                                    <h5><span style="margin-right: 16px;">Total</span><span class="price">{{ $transaction->total }}</span></h5>
                                </div>
                                <div class="col-xs-12">
                                    @if ($transaction->status == "notyetpayed")
                                        <form action="/transactions/{{ $transaction->id }}" method="GET">
                                            <button type="submit" class="btn btn-primary">Upload Payment Proof</button>
                                        </form>
                                        <form action="/transactions/{{ $transaction->id }}" method="POST">
                                            @csrf
                                            @method("DELETE")

                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
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
