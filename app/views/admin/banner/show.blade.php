@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="fa fa-user"></i>
              </div>
              <h5>Show Banner</h5>
            </header>
            <div class="body">
              <div class="form-horizontal">
                @include('admin.banner._form_disabled', array('banner' => $banner))
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/banner/{{$banner->id}}/edit">Edit</a> |
                  <a href="/admin/banner">Back to Banner List</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

