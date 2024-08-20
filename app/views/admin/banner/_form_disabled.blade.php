<div class="form-group">
  {{ Form::label('banner[name]', 'Name', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    {{ Form::text('banner[name]', $banner->name, array(
      'class' => 'form-control',
      'placeholder' => 'Enter Banner Name',
      'disabled'
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
      'placeholder' => '-',
      'disabled'
    )) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('banner[image_path]', 'Image', array(
    'class' => 'control-label col-lg-4'
  )) }}
  <div class="col-lg-3">
    <img src="{{$banner['image_path']}}" class="img-responsive">
  </div>
</div>