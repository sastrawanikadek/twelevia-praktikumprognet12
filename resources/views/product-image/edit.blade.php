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
                </div>
                <div class="box-body">
                    <table id="products" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Weight</th>
                                <th>Rate</th>
                                <th>Description</th>
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
                <h3 class="box-title">Edit Product Image</h3>
                <button type="button" id="close-modal" class="btn btn-flat btn-white">
                    <i class="fa fa-close"></i>
                    Close
                </button>
            </div>
            <form action="/admin/product-image/{{ $id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="box-body">
                    <div class="form-group">
                        <label for="id">Product ID</label>
                        <input type="text" id="id" name="id" class="form-control" placeholder="Product ID" value="{{ $product->id }}" readonly />
                    </div>
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Product name" value="{{ $product->product_name }}" readonly />
                    </div>
                    <div class="form-group">
                        <label for="image-label" id="image-click-label">Image</label>
                        <label for="image" id="image-label" class="form-control" style="font-weight: normal">Click to select the image</label>
                        <input type="file" name="image" id="image" accept="image/*" style="display: none" />
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
        $("#close-modal").click(function(){
            window.location.href = "/admin/product-image";
        });

        $(".overlay").eq(0).click(function(){
            window.location.href = "/admin/product-image";
        });

        $("#image-click-label").click(function(){
            $("#image-label").click();
        });

        $("#image").change(function(){
            const fileName = $(this).val().split("\\");

            if(fileName.length > 1){
                $("#image-label").html(fileName[fileName.length - 1]);
            } else {
                $("#image-label").html("Click to select the image");
            }
        });

        $(function() {
            $("#products").DataTable();
        });
    </script>
@endsection