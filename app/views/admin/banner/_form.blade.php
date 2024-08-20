@if( isset($banner->errors) && $banner->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($banner->errors->all()) }} errors prohibited this banner from being saved:</h4>

    <ul>
      {{ implode('', $banner->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif

<div class="form-group">
  {{ Form::label('banner[name]', 'Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('banner[name]', $banner->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Banner Name'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('banner[action_url]', 'URL', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('banner[action_url]', $banner->action_url, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Action URL'
    )) }} *Optional
  </div>
</div>
<div class="form-group">
  {{ Form::label('banner[image_path]', 'Image', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::file('banner[image_path]', array(
      'class' => 'form-control',
      'accept' => 'image/*'
    )) }}
  </div>
</div>

<div class="form-group">
  <div class="col-lg-4"></div>
  <div class="col-lg-3">
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
  </div>
</div>
