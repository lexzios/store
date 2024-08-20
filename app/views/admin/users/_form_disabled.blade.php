<div class="form-group">
  {{ Form::label('user[first_name]', 'First Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('user[first_name]', $user->first_name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter first name',
      'disabled'
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
      'placeholder' => 'Enter last name',
      'disabled'
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
      'placeholder' => 'Enter email',
      'disabled'
    )) }}
  </div>
</div>