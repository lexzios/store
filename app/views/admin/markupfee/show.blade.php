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
              <h5>Show Formula</h5>
            </header>
            <div class="body">
              <div class="form-horizontal">
                @include('admin.markupfee._form_disable', array('markup' => $markup))
              </div>
             <!--  <div class="row">
                <div class="col-lg-4">
                  <strong>Formula Name:</strong>
                </div>
                <div class="col-lg-3">
                  {{ $markup->name }}
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <strong>Persentage:</strong>
                </div>
                <div class="col-lg-3">
                  {{ (int)$markup->float_fee }} %
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <strong>Rupiah:</strong>
                </div>
                <div class="col-lg-3">
                  {{ number_format((int)$markup->fixed_fee,2,",",".") }}
                </div>
              </div> -->
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/markupfee/{{$markup->id}}/edit">Edit</a> |
                  <a href="/admin/markupfee">Back to Mark Up Fee List</a>
                </div>
              </div>
            </div>
          </div> <!-- box inverse -->
        </div>
      </div>
    </div>
  </div>
</div>
@stop

