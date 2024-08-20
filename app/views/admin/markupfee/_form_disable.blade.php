<div class="form-group">
  {{ Form::label('markup[name]', 'Formula', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('markup[name]', $markup->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Formula Name',
      'disabled'
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
      'placeholder' => 'Enter Persentage',
      'disabled'
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
      'placeholder' => 'Enter Fixed Fee',
      'disabled'
    )) }}
  </div>
</div>