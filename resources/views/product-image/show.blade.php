@extends('layouts.admin')

@section('title')
    Product Images
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
                        <tbody>
                            @for ($i = 0; $i < count($products); $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $products[$i]->product_name }}</td>
                                    <td>{{ $products[$i]->price }}</td>
                                    <td>{{ $products[$i]->stock }}</td>
                                    <td>{{ $products[$i]->weight }}</td>
                                    <td>{{ $products[$i]->product_rate }}</td>
                                    <td>{{ str_limit($products[$i]->description, 50, " ...") }}</td>
                                    <td>
                                        <form action="/admin/product-image/{{ $products[$i]->id }}" method="GET" class="btn-group">
                                            <button type="submit" class="btn btn-primary" title="View">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </form>
                                        <form action="/admin/product-image/create" method="GET" class="btn-group">
                                            <button type="submit" name="id" value="{{ $products[$i]->id }}" class="btn btn-primary" title="Create">
                                                <i class="fa fa-plus"></i>
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

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Product Image</h3>
                </div>
                <div class="box-body">
                    <table id="images" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($images); $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    @foreach ($products as $product)
                                        @if ($product->id == $images[$i]->product_id)
                                            <td>{{ $product->product_name }}</td>
                                        @endif
                                    @endforeach
                                    <td><img src="{{ $images[$i]->image_name }}" alt="{{ $product->product_name }}" height="80" /></td>
                                    <td>
                                        <form action="/admin/product-image/{{ $images[$i]->id }}/edit" method="GET" class="btn-group">
                                            <button type="submit" class="btn btn-primary" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </form>
                                        <form action="/admin/product-image/{{ $images[$i]->id }}" method="POST" class="btn-group">
                                            @csrf
                                            @method("DELETE")

                                            <button type="submit" class="btn btn-primary" title="Delete">
                                                <i class="fa fa-trash"></i>
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
        $(function() {
            $("#products").DataTable();
            $("#images").DataTable();
        });
    </script>
@endsection