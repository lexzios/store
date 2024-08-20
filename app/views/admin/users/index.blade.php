@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12" style="margin:10px">
          <a href="/admin/users/new">
            <div class="icons" style="float:left">
              <i class="fa fa-plus"></i>
            </div>
            &nbsp New Admin
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
              <h5>Listing Administrators</h5>
            </header>
            <div class="body">
              <table class="table">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @foreach( $users as $user )
                  <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="/admin/users/{{$user->id}}">Show</a></td>
                    <td><a href="/admin/users/{{$user->id}}/edit">Edit</a></td>
                    <td>
                      {{ Form::open(array('action' => array('admin\UsersController@destroy', $user->id), 'method' => 'delete')) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-default')); }}
                      {{ Form::close() }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
              </table>
<!-- 
              <div class="row">
                <div class="col-lg-12">
                  <a href="/admin/users/new">New User</a>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
