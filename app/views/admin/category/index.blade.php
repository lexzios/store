@extends('layouts.admin.application')

@section('content')
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="row">
        <div class="col-lg-12">
          <div class="box inverse">
            <header>
              <div class="icons">
                <i class="fa fa-edit"></i>
              </div>
              <h5>Category</h5>
            </header>
            <div class="body">
              <ul class="nav nav-list primary push-bottom">
				<?php
					for($i=0; $i<count($categories); $i++) 
					{
						if($categories[$i]->parent_id == 0 ) 
						{
							$hasChild = 0;
							for($z=0; $z<count($categories); $z++)
							{
								if($categories[$i]->id == $categories[$z]->parent_id )
								{
									$hasChild = 1;
									break;
								}
							}
							if($hasChild == 1)
							{
				?>
								<li><a href="/admin/category/{{ $categories[$i]->id }}" class="blue-border">{{ $categories[$i]->name }}</a></li>
					   			<div id="{{ $categories[$i]->id }}" class ="panel-collapse">
					   				<ul class="nav nav-list col-md-offset-1">
				<?php
										for($j=0; $j<count($categories); $j++)
										{
											if($categories[$i]->id == $categories[$j]->parent_id )
											{
												$hasChild = 0;
												for($z=0; $z<count($categories); $z++)
												{
													if($categories[$j]->id == $categories[$z]->parent_id )
													{
														$hasChild = 1;
														break;
													}
												}
												if($hasChild == 1)
												{
				?>
													<li><a href="/admin/category/{{ $categories[$j]->id }}" class="blue-border">{{ $categories[$j]->name }}</a></li>
										   			<div id="{{ $categories[$j]->id }}" class ="panel-collapse">
										   				<ul class="nav nav-list col-md-offset-1">
				<?php
															for($k=0; $k<count($categories); $k++)
															{
																if($categories[$j]->id == $categories[$k]->parent_id )
																{
																	$hasChild = 0;
																	for($z=0; $z<count($categories); $z++)
																	{
																		if($categories[$k]->id == $categories[$z]->parent_id )
																		{
																			$hasChild = 1;
																			break;
																		}
																	}
																	if($hasChild == 1)
																	{
				?>
																		<li><a href="/admin/category/{{ $categories[$k]->id }}" class="blue-border">{{ $categories[$k]->name }}</a></li>
															   			<div id="{{ $categories[$k]->id }}" class ="panel-collapse">
															   				<ul class="nav nav-list col-md-offset-1">
				<?php
														   					for($l=0; $l<count($categories); $l++)
																			{
																				if($categories[$k]->id == $categories[$l]->parent_id  )
																				{
				?>
																					<li><a href="/admin/category/{{ $categories[$l]->id }}" class="blue-border">{{ $categories[$l]->name }}</a></li>
				<?php
																				}
																			}
				?>
														   				</ul>
														   			</div>
				<?php
																	}
																	else 
																	{
				?>
																		<li><a href="/admin/category/{{ $categories[$k]->id }}" class="blue-border">{{ $categories[$k]->name }}</a></li>
				<?php
																	}
																}
															}
				?>
										   				</ul>
										   			</div>
				<?php
												}
												else 
												{
				?>
													<li><a href="/admin/category/{{ $categories[$j]->id }}" class="blue-border">{{ $categories[$j]->name }}</a></li>
				<?php
												}
											}
										}
				?>
					   				</ul>
					   			</div>
				<?php
							} else 
							{
				?>
							<li><a href="/admin/category/{{ $categories[$i]->id }}" class="blue-border">{{ $categories[$i]->name }}</a></li>
				<?php
							}
						}
					}
				?>
				</ul>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
