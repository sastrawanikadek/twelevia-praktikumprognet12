@extends('layouts.admin')

@section('title')
    Transactions
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
                    <h3 class="box-title">List of Transactions</h3>
                </div>
                <div class="box-body">
                    <table id="products" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Address</th>
                                <th>Regency</th>
                                <th>Province</th>
                                <th>Sub Total</th>
                                <th>Shipping Cost</th>
                                <th>Courier</th>
                                <th>Proof</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($transactions); $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $transactions[$i]->address }}</td>
                                    <td>{{ $transactions[$i]->regency }}</td>
                                    <td>{{ $transactions[$i]->province }}</td>
                                    <td>{{ $transactions[$i]->sub_total }}</td>
                                    <td>{{ $transactions[$i]->shipping_cost }}</td>
                                    <td>{{ $transactions[$i]->courier }}</td>
                                    <td>{!! isset($transactions[$i]->proof_of_payment) ? "<img src='{$transactions[$i]->proof_of_payment}' alt='Proof' height='80'>" : '' !!}</td>
                                    <td>
                                        <form action="/admin/transactions/{{ $transactions[$i]->id }}/verified" method="POST">
                                            @csrf
                                            
                                            <button class="btn btn-primary" {{ isset($transactions[$i]->proof_of_payment) && $transactions[$i]->status == 'unverified' ? '' : 'disabled'}}>Verified</button>
                                        </form>
                                        <form action="/admin/transactions/{{ $transactions[$i]->id }}/delivered" method="POST">
                                            @csrf

                                            <button class="btn btn-primary" {{ $transactions[$i]->status == 'verified'  ? '' : 'disabled'}}>Delivered</button>
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
        });
    </script>
@endsection