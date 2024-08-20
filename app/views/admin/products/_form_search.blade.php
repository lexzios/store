<div class="form-group">
  <div class="col-lg-3">
    {{ Form::select('category', $category, $category_choosen, array(
    'class' => 'form-control', 'data-placeholder' => 'Enter Product Category')) }}
  </div>
  <div class="col-lg-3">
    {{ Form::text('search', $search, array(
      'class' => 'form-control',
      'placeholder' => 'Enter product name'
    )) }}
  </div>
  <div class="col-lg-2">
    {{ Form::submit('Search', array('class' => 'btn btn-default')); }}
  </div>
  <div class="col-lg-2 custom-align-right">
    {{ Form::submit('Export to CSV', array(
    'class' => 'btn btn-default',
    'name' => 'is_csv'
    ));
  }}
  </div>
  <div class="col-lg-2 custom-align-right">
    {{ Form::submit('Import CSV', array(
    'class' => 'btn btn-default',
    'name' => 'is_csv_upload'
    ));
  }}
  </div>
</div>
