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
                        <button class="btn">
                            <h6><i class="fa fa-credit-card"></i></h6>
                            <h6>Not Pay</h5>
                        </button>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn">
                            <h6><i class="fa fa-circle-o-notch"></i></h6>
                            <h6>Unverified</h5>
                        </button>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn">
                            <h6><i class="fa fa-check-square-o"></i></h6>
                            <h6>Verified</h5>
                        </button>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn">
                            <h6><i class="fa fa-home"></i></h6>
                            <h6>Delivered</h5>
                        </button>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn">
                            <h6><i class="fa fa-clock-o"></i></h6>
                            <h6>Expired</h5>
                        </button>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn">
                            <h6><i class="fa fa-times-circle-o"></i></h6>
                            <h6>Cancel</h5>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="single-product">
                            <div class="pull-left">
                                <div class="product-image">
                                    <img src="https://mm-imgs.s3.amazonaws.com/p/2017/08/18/08/ladies-fashion-dress-bunga-2f-gaun-wanita-2f-dress-flower-brukat-2f-baju-dress-2f-ho_4153200_1_20671.jpg" alt="">
                                </div>
                            </div>
                            <div class="pull-left">
                                <h5>Nama Produk</h5>
                                <h5>Harga Produk</h5>
                                <h5>Expire In: Date</h5>

                                <button class="btn btn-primary">Upload Payment Proof</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- /.row -->
@endsection
