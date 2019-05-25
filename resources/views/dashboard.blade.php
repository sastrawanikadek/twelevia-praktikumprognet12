@extends('layouts.admin')

@section('title')
  Dashboard
@endsection

@section('css')
  <!-- Morris charts -->
  <link rel="stylesheet" href="{{ asset("bower_components/morris.js/morris.css") }}">
@endsection

@section('content')
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-xs-12 text-center">
      <div class="col-xs-12 col-md-3">
        <div class="form-group">
          <label for="date">Year</label>
          <input type="date" name="date" id="date" class="form-control" style="width: calc(100% - 50px); display: inline-block; margin-top: 30px;">
        </div>
      </div>

      <div class="col-xs-12">
        <!-- LINE CHART -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Transaction Report</h3>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="line-chart" style="height: 400px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
  <!-- /.row -->
@endsection

@section('script')
    <!-- Morris.js charts -->
    <script src="{{ asset("bower_components/raphael/raphael.min.js") }}"></script>
    <script src="{{ asset("bower_components/morris.js/morris.min.js") }}"></script>
    <script>
      $("#date").change(function(){
        const year = new Date($(this).val()).getFullYear();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/report',
            dataType: 'json',
            data: {
                'year': year
            },
            success: function(result){
              result.map(function(data){
                data.value = parseInt(data.value)
              });

              var line = new Morris.Line({
                element: 'line-chart',
                resize: true,
                data: result,
                xkey: 'y',
                ykeys: ['Value'],
                labels: ['Value'],
                lineColors: ['#1abc9c'],
                hideHover: 'auto',
                parseTime: false
              });
            }
        });
      });
    </script>
@endsection