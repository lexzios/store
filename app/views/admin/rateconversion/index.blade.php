@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12" style="margin:10px">
          <a href="/admin/rateconversion/new">
            <div class="icons" style="float:left">
              <i class="fa fa-plus"></i>
            </div>
            &nbsp New Conversion Rates
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
              <h5>Listing Conversion Rates</h5>
            </header>
            <div class="body">
              <table class="table" style ="text-align:right">
              <thead>
                <tr>
                  <th>From</th>
                  <th style ="text-align:center">To</th>
                  <th style ="text-align:right">Rate</th>
                  <th colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($conversions[0]))
                  @foreach($conversions as $conversion)
                    <tr>
                    <td style ="text-align:left">{{ $conversion->from_currency_code }}</td>
                    <td style ="text-align:center">{{ $conversion->to_currency_code }}</td>
                    <td>{{ $conversion->rate }}</td>
                    <td style ="text-align:center"><a href="/admin/rateconversion/{{$conversion->id}}">Show</a></td>
                    <td style ="text-align:center"><a href="/admin/rateconversion/{{$conversion->id}}/edit">Edit</a></td>
                    <!-- <td>
                      {{ Form::open(array('action' => array('admin\RateConversionController@destroy', $conversion->id), 'method' => 'delete')) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                      {{ Form::close() }}
                    </td> -->
                  </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5" style ="text-align:left">No Result</td>
                  </tr>
                @endif
                <!-- <tr>
                    <td>US</td>
                    <td>IDR</td>
                    <td>11800</td>
                    <td><a href="/admin/rateconversion/1">Show</a></td>
                    <td><a href="/admin/rateconversion/1/edit">Edit</a></td>
                    <td>
                      {{ Form::open(array('action' => array('admin\RateConversionController@destroy', 1), 'method' => 'delete')) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                      {{ Form::close() }}
                    </td>
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
