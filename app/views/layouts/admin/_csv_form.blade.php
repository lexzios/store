@if( isset($errors) && $errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
  <h4>{{ count($errors->all()) }} errors prohibited this product from being uploaded:</h4>

    <ul>
      {{ implode('', $errors->all('<li>:message</li>')) }}
    </ul>
  </div>
  @endif

  <div class="form-group">
    {{ Form::label('file_label', 'File', array(
      'class' => 'control-label col-lg-4'
    )) }}
  <div class="col-lg-3">
    {{ Form::file('csv_file', array(
      'class' => 'form-control',
      'accept' => 'file_extension/*'
    )) }}
  </div>
</div>

<div class="form-group">
  <div class="col-lg-4"></div>
  <div class="col-lg-3">
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
  </div>
</div>
