@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">EvaluateAll</div>
                    <div class="panel-body">
                      <table class="table  table-hover table-striped ">
                        <tr>
                            <th >No</th>
                              <th > Name </th>
                              <th > Photo </th>
                              <th > State </th>
                        </tr>
                              <?php $i = 1; ?>
                            @foreach($users as $user)
                              @if($user->id!=Auth::user()->id)
                              <tr>
                                <td>{{$i}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->photo }}</td>
                                <td>
                                    <?php $count=0; $max = count($reviews); ?>
                                    @forelse($reviews as $review)
                                      <?php $count++; ?>
                                      @if($review->user_id==$user->id)
                                        evaluated
                                        <?php $count=$count-1; ?>
                                      @endif
                                      @if($count==$max)
                                        <a href="{{ url('evaluate/'. $user->id) }}">
                                          evaluate
                                        </a>
                                      @endif
                                    @empty
                                    <a href="{{ url('evaluate/'. $user->id) }}">
                                      evaluate
                                    </a>
                                    @endforelse
                                </td>
                              </tr>
                              <?php $i++; ?>
                              @endif
                            @endforeach

                      </table>
                    </div>
              </div>
        </div>
    </div>
  </div>
    @endsection
