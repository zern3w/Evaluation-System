@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                  <div class="panel-body">
                  <div class="row" style="margin-left: 10px; text-align: left;" >

                    <div class="col-md-4">
                    <img src="/img/uploads/{{ Auth::user()->photo }}" class="profile" id="showphoto">
                        <form enctype="multipart/form-data" action="/profile" method="POST">
                          </br>
                          <label>Update Profile Image</label>
                          <input type="file" name="photo" id="inputphoto">
                          @if($errors->has('photo'))
                          <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                          @endif
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </br>
                          <input type="submit" class="pull-left btn btn-sm btn-primary" style="margin-top: -10px; margin-left: 15px; padding: 5px 53px;">
</br>
                  </div>
                  <div class="col-md-offset-1 col-md-6">
                    <h2>  Basic Information</h2>
                    <hr>
                    <div class="col-md-6">
                       <h4><b>Username: </b></h4>
                       <h4><b>Name: </b></h4>
                       <h4><b>Email: </b></h4>
                        <h4><b>Duration of employment: </b></h4>
                    </div>
                    <div class="col-md-6">
                       <h4>{{ Auth::user()->username }}</h4>
                       <h4>{{ Auth::user()->name }}</h4>
                       <h4>{{ Auth::user()->email }}</h4>
                       <h4></br>{{ Auth::user()->created_at->age }} years old</h4>
                    </div>

                  </div>
                  </div>



</div>

            </div>
        </div>
    </div>
</div>
@endsection
