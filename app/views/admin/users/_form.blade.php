@if( isset($user->errors) && $user->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($user->errors->all()) }} errors prohibited this user from being saved:</h4>

    <ul>
      {{ implode('', $user->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif

<div class="form-group">
  {{ Form::label('user[first_name]', 'First Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('user[first_name]', $user->first_name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter first name'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('user[last_name]', 'Last Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('user[last_name]', $user->last_name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter last name'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('user[email]', 'Email', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::email('user[email]', $user->email, array(
      'class' => 'form-control',
      'placeholder' => 'Enter email'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('user[password]', 'Password', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::password('user[password]', array(
      'class' => 'form-control',
      'placeholder' => 'Enter password'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('user[password_confirmation]', 'Password Confirmation', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::password('user[password_confirmation]', array(
      'class' => 'form-control',
      'placeholder' => 'Confirm password'
    )) }}
  </div>
</div>

<div class="form-group">
  <div class="col-lg-4"></div>
  <div class="col-lg-3">
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
  </div>
</div>
