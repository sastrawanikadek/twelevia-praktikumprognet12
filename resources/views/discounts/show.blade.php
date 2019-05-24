@extends('layouts.admin')

@section('title')
    Discounts
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
                    <h3 class="box-title">List of Product Discounts</h3>
                    <form action="/admin/discount/create" method="GET">
                        <button type="submit" id="create" class="btn btn-primary" name="id" value="{{ $product->id }}"><i class="fa fa-plus"></i>Create Discount</button>
                    </form>
                </div>
                <div class="box-body">
                    <table id="discounts" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Percentage</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($discounts); $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $discounts[$i]->percentage }}</td>
                                    <td>{{ $discounts[$i]->start }}</td>
                                    <td>{{ $discounts[$i]->end }}</td>
                                    <td>
                                        <form action="/admin/discount/{{ $discounts[$i]->id }}/edit" method="GET" class="btn-group">
                                            <button type="submit" class="btn btn-primary" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </form>
                                        <form action="/admin/discount/{{ $discounts[$i]->id }}" method="POST" class="btn-group">
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
            $("#discounts").DataTable();
        });
    </script>
@endsection