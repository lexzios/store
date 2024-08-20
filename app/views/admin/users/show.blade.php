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
              <h5>Show Admin</h5>
            </header>
            <div class="body">
              <div class="form-horizontal">
                @include('admin.users._form_disabled', array('user' => $user))
              </div>
              <!-- <div class="row">
                <div class="col-lg-4">
                  <strong>First Name:</strong>
                </div>
                <div class="col-lg-3">
                  {{ $user->first_name }}
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <strong>Last Name:</strong>
                </div>
                <div class="col-lg-3">
                  {{ $user->last_name }}
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <strong>Email:</strong>
                </div>
                <div class="col-lg-3">
                  {{ $user->email }}
                </div>
              </div> -->
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/users/{{$user->id}}/edit">Edit</a> |
                  <a href="/admin/users">Back to User List</a>
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

