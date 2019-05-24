@extends('layouts.admin')

@section('title')
  Profile
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
        <form action="/profile" method="POST">
            @csrf

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Profile</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ Auth::user()->name }}" />
                    </div>
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}" />
                    </div>
                    <div class="form-group">
                        <label for="profile-image">Profile Image</label>
    
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
                    <button type="submit" class="btn btn-primary">Submit</button>
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