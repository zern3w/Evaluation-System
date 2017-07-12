@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                  <div class="row" style="margin-left: 10px; text-align: left;" >
                    <img src="/uploads/avatars/{{ Auth::user()->photo }}" class="img-avatar" id="showphoto">
                        <form enctype="multipart/form-data" action="/profile" method="POST">
                          <label>Update Profile Image</label>
                          <input type="file" name="photo" id="inputphoto">
                          @if($errors->has('photo'))
                          <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                          @endif
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </br>
                          <input type="submit" class="pull-left btn btn-primary" style="margin-top: -10px; margin-left: 15px; padding: 5px 53px;">
                  </div>
                  <div class="panel-body">
                       Name: {{ Auth::user()->name }}</br>
                       Email: {{ Auth::user()->email }} </br>
                       Password: {{ (Auth::user()->password) }} </br>
                       DOB: {{ Auth::user()->created_at->age }} years old
                  </div>
                    <img class="img-responsive" src="pie.jpg" alt="">
                  <div class="panel-body">
                    <h3>Comment</h3>
                      <!-- <?php $i=1; ?>
                      @foreach($reviews as $review)
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">Comment <?=$i?></h3>
                          </div>
                          <div class="panel-body">
                            {{ $review->comment }}
                          </div>
                        </div>
                        <?php $i++ ?>
                      @endforeach -->
                  </div>

                          <div class="wrapper">
                              <ul id="results"><!-- results appear here --></ul>
                              <div class="ajax-loading"><img src="{{ asset('img/loading-icon.gif') }}" /></div>
                          </div>
                          <script>
                          var page = 1; //track user scroll as page number, right now page number is 1
                          load_more(page); //initial content load
                          $(window).scroll(function() { //detect page scroll
                              if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
                                  page++; //page number increment
                                  load_more(page); //load content
                              }
                          });
                          function load_more(page){
                            $.ajax(
                                  {
                                      url: '?page=' + page,
                                      type: "get",
                                      datatype: "html",
                                      beforeSend: function()
                                      {
                                          $('.ajax-loading').show();
                                      }
                                  })
                                  .done(function(data)
                                  {
                                      if(data.length == 0){
                                      console.log(data.length);

                                          //notify user if nothing to load
                                          $('.ajax-loading').html("No more comment!");
                                          return;
                                      }
                                      $('.ajax-loading').hide(); //hide loading animation once data is received
                                      $("#results").append(data); //append data into #results element
                                  })
                                  .fail(function(jqXHR, ajaxOptions, thrownError)
                                  {
                                        alert('No response from server');
                                  });
                           }
                          </script>
            </div>
        </div>
    </div>
</div>
@endsection
