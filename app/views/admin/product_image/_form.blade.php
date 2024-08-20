@if( isset($image->errors) && $image->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($image->errors->all()) }} errors prohibited this image from being saved:</h4>

    <ul>
      {{ implode('', $image->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif

<div class="form-group">
  {{ Form::label('image[image_path]', 'Image Product', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::file('image[image_path]', array(
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
