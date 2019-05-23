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
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Product</h3>
                    <button type="button" id="create" class="btn btn-primary"><i class="fa fa-plus"></i>Create Product</button>
                </div>
                <div class="box-body">
                    <table id="products" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Categories</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Weight</th>
                                <th>Rate</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($newProducts); $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $newProducts[$i]->product_name }}</td>
                                    <td>{{ $newProducts[$i]->category_name }}</td>
                                    <td>{{ $newProducts[$i]->price }}</td>
                                    <td>{{ $newProducts[$i]->stock }}</td>
                                    <td>{{ $newProducts[$i]->weight }}</td>
                                    <td>{{ $newProducts[$i]->product_rate }}</td>
                                    <td>{{ str_limit($newProducts[$i]->description, 50, " ...") }}</td>
                                    <td>
                                        <form action="/admin/product/{{ $newProducts[$i]->id }}/edit" method="GET" class="btn-group">
                                            <button type="submit" class="btn btn-warning" title="Edit">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </button>
                                        </form>
                                        <form action="/admin/product/{{ $newProducts[$i]->id }}" method="POST" class="btn-group">
                                            @csrf
                                            @method("DELETE")

                                            <button type="submit" class="btn btn-danger" title="Delete">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset ("/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset ("/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
    <!-- Custom Script -->
    <script>
        $("#create").click(function(){
            window.location.href = "/admin/product/create";
        });

        $(function() {
            $("#products").DataTable();
        });
    </script>
@endsection