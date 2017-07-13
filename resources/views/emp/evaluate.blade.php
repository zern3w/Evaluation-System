@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Evaluate</h2></div>

                <form class="" action="{{route('emp.eval')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="userId" value="{{$user->id}}" >
                    <input type="hidden" name="reviewerId" value="{{Auth::user()->id}}" >
                    <div class="panel-body">
                        <center>
                          <img src="/img/uploads/{{ $user->photo}}" class="profile" id="showphoto">
                        <h4>Employee name: {{ $user->name }}</h4>
                        </center>
                        <hr>

                        <input type="hidden" name="reviewerId" value="{{ Auth::user()->id }}">
                        <h3>How I like them:   </h3>
                           <div class="row">
                             <center>
                                   <div class="eval-selector">
                                     <input id="five" type="radio" name="rating" value="5" />
                                     <label class="eval-scale level-five" for="five"></label>

                                     <input id="four" type="radio" name="rating" value="4" />
                                     <label class="eval-scale level-four"for="four"></label>

                                     <input id="three" type="radio" name="rating" value="3" checked="checked" />
                                     <label class="eval-scale level-three"for="three"></label>

                                     <input id="two" type="radio" name="rating" value="2" />
                                     <label class="eval-scale level-two"for="two"></label>

                                     <input id="one" type="radio" name="rating" value="1" />
                                     <label class="eval-scale level-one"for="one"></label>
                                   </div>
                                 </center>
    </div>
    <h3>Comment (optional)</h3>
    <textarea class="pull-right form-control" name="comment" placeholder="Enter comment..."></textarea>
    </br>
    <hr>
    <button type="submit" class="btn btn-primary form-control">Submit</button>
                            </div>

                    </div>
            </div>
        </div>
    </div>
    @endsection
