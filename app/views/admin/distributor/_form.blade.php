@if( isset($distributor->errors) && $distributor->errors->any() )
  <div id="error_explanation" class="alert alert-danger" role="alert">
    <h4>{{ count($distributor->errors->all()) }} errors prohibited this distributor from being saved:</h4>

    <ul>
      {{ implode('', $distributor->errors->all('<li>:message</li>')) }}
    </ul>
  </div>
@endif

<div class="form-group">
  {{ Form::label('distributor[name]', 'Distributor Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('distributor[name]', $distributor->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor name'
    )) }}
  </div>
</div>

<div class="form-group">
  {{ Form::label('distributor[address]', 'Distributor Address', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::textarea('distributor[address]', $distributor->address, array(
      'class' => 'form-control',
      'placeholder' => 'Enter distributor address',
      'rows' => '3'
    )) }}
  </div>
</div>

<div class="form-group">
  <div class="col-lg-4"></div>
  <div class="col-lg-3">
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
  </div>
</div>
