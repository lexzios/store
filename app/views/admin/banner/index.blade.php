@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        @if( isset($message) )
          <div style="padding-left:20px;padding-right:20px;padding-top:5px">
            <div class="alert alert-success" role="alert">
              <strong>Well done!</strong>
              {{ $message }}
            </div>
          </div>
        @endif
        <div class="col-lg-12" style="margin:10px">
          <a href="/admin/banner/new">
            <div class="icons" style="float:left">
              <i class="fa fa-plus"></i>
            </div>
            &nbsp New Banner
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="fa fa-list"></i>
              </div>
              <h5>Listing Banner</h5>
            </header>
            <div class="body">
              <table class="table">
              <thead>
                <tr>
                  <th>Banner</th>
                  <th>Name</th>
                  <th>Action URL</th>
                  <th colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($banners[0]))
                  @foreach($banners as $banner)
                    <tr>
                      <td class="col-md-4 col-sm-4 col-xs-4">
                        <img class="col-md-12 col-sm-12 col-xs-12" src="{{$banner->image_path}}"></img>
                      </td>
                      <td>{{$banner->name}}</td>
                      @if($banner->action_url != "")
                        <td><a href="{{$banner->action_url}}">Link</a></td>
                      @else
                        <td>No Link</td>
                      @endif
                      <td><a href="/admin/banner/{{$banner->id}}">Show</a></td>
                      <td><a href="/admin/banner/{{$banner->id}}/edit">Edit</a></td>
                      <td>
                        {{ Form::open(array('action' => array('admin\BannerController@destroy', $banner->id), 'method' => 'delete')) }}
                          {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                        {{ Form::close() }}
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5">
                      No Result
                    </td>
                  </tr>
                @endif
                <!-- <tr>
                  <td class="col-md-3 col-sm-4 col-xs-4"><img class="col-md-12 col-sm-12 col-xs-12" src="http://www.tokocentralpc.com/wp-content/uploads/2014/06/620x320xlss-620x320.jpg.pagespeed.ic.a4cknNnryN.jpg?1408524770004"></img></td>
                  <td>Banner A</td>
                  <td><a href="http://www.tokocentralpc.com/2014/jasa-service-upgrade-instalasi-laptop-central-pc#.U_RiLbySxup">Link</a></td>
                  <td><a href="/admin/banner/1/edit">Edit</a></td>
                  <td>
                    {{ Form::open(array('action' => array('admin\BannerController@destroy', 1), 'method' => 'delete')) }}
                      {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                    {{ Form::close() }}
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td class="col-md-3 col-sm-4 col-xs-4"><img class="col-md-12 col-sm-12 col-xs-12" src="http://image.shutterstock.com/display_pic_with_logo/1196897/111799865/stock-vector-big-sale-square-sticker-with-sale-up-to-percent-text-on-square-background-eps-vector-111799865.jpg"></img></td>
                  <td>Banner B</td>
                  <td><a href="http://www.shutterstock.com/pic-111799865/stock-vector-big-sale-square-sticker-with-sale-up-to-percent-text-on-square-background-eps-vector.html">Link</a></td>
                  <td><a href="/admin/banner/1/edit">Edit</a></td>
                  <td>
                    {{ Form::open(array('action' => array('admin\BannerController@destroy', 1), 'method' => 'delete')) }}
                      {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                    {{ Form::close() }}
                  </td>
                  <td></td>
                </tr> -->
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
