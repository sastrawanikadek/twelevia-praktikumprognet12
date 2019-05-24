@extends('layouts.admin')

@section('title')
    Categories
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
                    <h3 class="box-title">List of Category</h3>
                    <button type="button" id="show-modal" class="btn btn-primary"><i class="fa fa-plus"></i>Create Category</button>
                </div>
                <div class="box-body">
                    <table id="categories" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
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
                <h3 class="box-title">Edit Category</h3>
                <button type="button" id="close-modal" class="btn btn-flat btn-white">
                    <i class="fa fa-close"></i>
                    Close
                </button>
            </div>
            <form action="/admin/category/{{ $category->id }}" method="POST">
                @csrf
                @method("PUT")

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Category name" value="{{ $category->category_name }}" />
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">None</option>
                            <option value="1" {{ $category->category_type == '1' ? 'selected' : '' }}>Women</option>
                            <option value="2" {{ $category->category_type == '2' ? 'selected' : '' }}>Men</option>
                            <option value="3" {{ $category->category_type == '3' ? 'selected' : '' }}>Kid</option>
                        </select>
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
            window.location.href = "/admin/category";
        });

        $(".overlay").eq(0).click(function(){
            window.location.href = "/admin/category";
        });

        $(function() {
            $("#categories").DataTable();
        });
    </script>
@endsection