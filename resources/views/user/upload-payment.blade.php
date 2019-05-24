@extends('layouts.admin')

@section('title')
  Upload Payment Proof
@endsection

@section('css')
    <style>
        .add-image-box {
            width: 150px;
            height: 150px;
            background-color: gainsboro;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .add-image-box .fa {
            font-size: 32px;
        }
    </style>
@endsection

@section('content')
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-xs-12">
        <form action="/transactions/{{ $id }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload Payment Proof</h3>
                </div>
                <div class="box-body">
                    <div class="form-group row">
                        <label for="profile-image" class="col-md-12 col-form-label">{{ __('Payment Proof') }}</label>
    
                        <div class="col-md-12">
                            <label for="profile-image-input" id="profile-image" class="add-image-box">
                                <i class="fa fa-plus"></i>
    
                                <img id="image" style="display: none; height: 150px; width: 150px;">
                            </label>
                            <input type="file" accept="image/*" name="profile_image" id="profile-image-input" style="display: none">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="/home" class="btn btn-danger">Back</a>
                    <button type="submit" class="btn btn-primary">Upload Proof</button>
                </div>
            </div>
        </form>
    </div>
  </div>
  <!-- /.row -->
@endsection

@section('script')
    <script>
        $('#profile-image-input').change(function(e){
            const files = e.target.files;

            if(files.length > 0){
                $("#profile-image").css({
                    "background-color": "white"
                });

                $("#profile-image .fa").eq(0).css({
                    "display": "none"
                });

                $("#image").attr("src", window.URL.createObjectURL(files[0]));

                $("#image").css({
                    "display": "block"
                });
            } else {
                $("#profile-image").css({
                    "background-color": "gainsboro"
                });

                $("#profile-image .fa").eq(0).css({
                    "display": "block"
                });

                $("#image").css({
                    "display": "none"
                });
            }
        });
    </script>
@endsection
