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
                <i class="fa fa-list"></i>
              </div>
              <h5>Listing Testimonial</h5>
            </header>
            <div class="body">
              <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Country</th>
                  <th>Testimonial</th>
                  <th colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($testimonials[0]))
                  @foreach($testimonials as $testimonial)
                    <tr>
                      <td>{{$testimonial->name}}</td>
                      <td>{{$testimonial->email}}</td>
                      <td>{{$testimonial->country}}</td>
                      <td><p class="flow block">{{$testimonial->testimonial}}</div></td>
                      <td><a href="/admin/testimonials/{{$testimonial->id}}">show</a></td>
                      <td>
                        @if($testimonial->is_approved != 0)
                          {{ Form::open(array('action' => array('admin\TestimonialsController@update', $testimonial->id), 'method' => 'patch')) }}
                          {{ Form::submit('Approved', array('class' => 'btn btn-default')); }}
                        {{ Form::close() }}
                        @else
                          {{ Form::open(array('action' => array('admin\TestimonialsController@update', $testimonial->id), 'method' => 'patch')) }}
                          {{ Form::submit('Approve', array('class' => 'btn btn-default')); }}
                        {{ Form::close() }}
                        @endif
                      </td>
                      <td>
                        {{ Form::open(array('action' => array('admin\TestimonialsController@destroy', $testimonial->id), 'method' => 'delete')) }}
                          {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                        {{ Form::close() }}
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="4">No Result</td>
                  </tr>
                @endif
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> <!-- body -->
    </div>
  </div>
</div>
@stop
