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
              <h5>Show Conversion Rates</h5>
            </header>
            <div class="body">
              <div class="form-horizontal">

                @include('admin.rateconversion._form_disable', array('conversion' => $conversion, 'currency' => $currency))
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/rateconversion/{{$conversion->id}}/edit">Edit</a> |
                  <a href="/admin/rateconversion">Back To Conversion Rates List</a>
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

