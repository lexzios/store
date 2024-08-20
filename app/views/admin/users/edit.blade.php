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
                <i class="fa fa-edit"></i>
              </div>
              <h5>Edit Admin</h5>
            </header>
            <div class="body">
              {{ Form::open(array('action' => array('admin\UsersController@update', $user->id), 'method' => 'patch', 'class' => 'form-horizontal')) }}
                @include('admin.users._form', array('user' => $user))
              {{ Form::close() }}

              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/users">Cancel</a>
                </div>
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
