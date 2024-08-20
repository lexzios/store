@if( isset($markup->errors) && $markup->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($markup->errors->all()) }} errors prohibited this markup from being saved:</h4>

    <ul>
      {{ implode('', $markup->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif
<div class="form-group">
  {{ Form::label('markup[name]', 'Formula', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('markup[name]', $markup->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Formula Name'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('markup[float_fee]', 'Persen', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('markup[float_fee]', $markup->float_fee, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Persentage'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('markup[fixed_fee]', 'Rupiah', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('markup[fixed_fee]', $markup->fixed_fee, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Fixed Fee'
    )) }}
  </div>
</div>

<div class="form-group">
  <div class="col-lg-4"></div>
  <div class="col-lg-3">
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
  </div>
</div>
