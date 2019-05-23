@extends('layouts.admin')

@section('title')
    Products
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset ("/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css") }}">
    <!-- Custom CSS -->
    <style>
        .box .box-header {
            display: flex;
            align-items: center;
        }
        .box .box-header .box-title {
            flex-grow: 1
        }
        .box-header .fa {
            margin-right: 8px;
        }
        .table th, .table td {
            text-align: center;
        }

        .modal-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 9999;
        }

        .modal-wrapper .overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-wrapper .box {
            position: relative;
            height: auto;
            width: 867px;
            left: calc(50% - 384px);
            top: calc(50% - 364.5px);
        }

        .modal-wrapper .box-body {
            overflow: auto;
            max-height: 578px;
        }
        
        .btn-white {
            background-color: white;
        }
        
        .form-control {
            resize: none;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Product</h3>
                    <button type="button" id="show-modal" class="btn btn-primary"><i class="fa fa-plus"></i>Create Product</button>
                </div>
                <div class="box-body">
                    <table id="products" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Description</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal-wrapper">
        <div class="overlay"></div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Product</h3>
                <button type="button" id="close-modal" class="btn btn-flat btn-white">
                    <i class="fa fa-close"></i>
                    Close
                </button>
            </div>
            <form action="/admin/product/{{ $newProducts[0]->id }}" method="POST">
                @csrf
                @method("PUT")

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Product name" value="{{ $newProducts[0]->product_name }}" />
                    </div>
                    <div class="form-group">
                        <label>Categories</label>
                        <div>
                            @foreach ($categories as $category)
                                <div class="checkbox" style="display: inline-block; margin: 10px;">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, $newProducts[0]->category_id) ? "checked" : "" }} />
                                        {{ $category->category_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" class="form-control" placeholder="Product price" value="{{ $newProducts[0]->price }}" />
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" min="1" id="stock" name="stock" class="form-control" placeholder="Product stock" value="{{ $newProducts[0]->stock }}" />
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (Kg)</label>
                        <input type="text" id="weight" name="weight" class="form-control" placeholder="Product weight" value="{{ $newProducts[0]->weight }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Product description" rows="5">{{ $newProducts[0]->description }}</textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset ("/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset ("/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
    <!-- Custom Script -->
    <script>
        $(window).ready(function(){
            let price = $("input[name='price']").val().replace(/\./g, "");
            price = parseInt(price).toLocaleString(['ban','id']);
            $("input[name='price']").val(price);
        });

        $("#close-modal").click(function(){
            window.location.href = "/admin/product";
        });

        $(".overlay").eq(0).click(function(){
            window.location.href = "/admin/product";
        });

        $("input[name='price']").keydown(function(e){
            let key = e.keyCode;
            if((key < 48 || key > 57) && (key < 96 || key > 105) && (key < 37 || key > 40) && (key !== 8 && key !== 13 && key !== 9 && key !== 116)){
                e.preventDefault();
            }
        });

        $("input[name='price']").keyup(function(){
            if($(this).val().length === 0){
                $(this).val(0);
            } else {
                let price = $(this).val().replace(/\./g, "");
                price = parseInt(price).toLocaleString(['ban','id']);
                $(this).val(price);
            }
        });

        $("input[name='weight']").keydown(function(e){
            let key = e.keyCode;
            
            if((key < 48 || key > 57) && (key < 96 || key > 105) && (key < 37 || key > 40) && (key !== 8 && key !== 13 && key !== 9 && key !== 116 && key !== 190)){
                e.preventDefault();
            }
        });

        $(function() {
            $("#products").DataTable();
        });
    </script>
@endsection