@extends('layouts.app') @section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">EvaluateAll</div>
        <div class="panel-body">

          @if($users->isEmpty())
          <div class="alert alert-warning">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <em> No data in the database.</em>
          </div>
          @endif

          <div class="row">
            @foreach($users as $user)

            <div class="col-md-4">
              <div class="thumbnail" style="border-radius: 10px;">
                <img src="/img/users/{{ $user->photo }}" class="img img-rounded">
                <div class="caption text-center">
                  <h4><b>{{$user->name}}</b></h4>


                  <a href="{{ url('evaluate/'. $user->id) }}" class="btn btn-success form-control"
                    style="margin-right: 10px">
                    <i class="glyphicon glyphicon-edit"></i> Evaluate</a>

                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
