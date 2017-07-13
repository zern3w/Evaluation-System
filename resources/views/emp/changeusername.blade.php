@extends('layouts.app')

@section('content')
@include('alert')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change username</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('emp.chageUsername') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">


                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">New Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" required>
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('confirmpassword') ? ' has-error' : '' }}">
                            <label for="confirmpassword" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" required>

                                @if ($errors->has('confirmpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirmpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary form-control">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
