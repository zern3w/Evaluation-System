@extends('layouts.app') @section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Report</div>
        {!! Charts::assets() !!}
        <div class="row" style="margin-left: 10px;">
          <center>
            <img src="/img/uploads/{{ Auth::user()->photo }}" class="profile" style="margin-top: 20px;" id="showphoto">
          </center>
          <div class="panel-body text-center">
            <h2>Name: {{ Auth::user()->name }}</br></h2>
          </div>
          <hr>

          <div class="panel-body">
            <div class="row">
              <div class="col-md-11">
                <center>
                  {!! $chart->render() !!}
                </br>
                </center>
              </div>
            </div>

            @if ($count != 0)
            <center>
              @if ($count > 1)
            <h4><b>Total is</b> {{ $count }} peoples</h4>
            @elseif ($count == 1 )
            <h4><b>Total is</b> {{ $count }} people</h4>
            @endif

            <h5><b>My average is</b> {{ $avg }}</h5>
            </center>
            @endif
            <hr>
            <h3>Comment</h3>

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
  </div>
</div>
@endsection
