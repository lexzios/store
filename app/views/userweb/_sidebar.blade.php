<h4>Categories</h4>
<aside id="accordion" class="sidebar">
	<ul class="nav nav-list primary push-bottom">
	<?php
	setCategoryView($categories, -1);
	?>
	</ul>
</aside>




<?php
	function setCategoryView($categories, $value) {
		for($i = 0 ; $i<count($categories); $i++) 
		{
			if($value == -1) {
				if($categories[$i]->parent_id == 0  && $categories[$i]->is_header != 1  ) 
				{
					$hasChild = 0;
					for($z=0; $z<count($categories); $z++)
					{
						if($categories[$i]->id == $categories[$z]->parent_id  && $categories[$i]->is_header != 1 )
						{
							$hasChild = 1;
							break;
						}
					}
					if($hasChild == 1)
					{
		?>
						<li><a data-toggle="collapse" data-parent="accordion-1" href="#{{ $categories[$i]->permalink }}">{{ $categories[$i]->name }}</a></li>
			   			<div id="{{ $categories[$i]->permalink }}" class ="panel-collapse collapse">
			   				<ul class="nav nav-list col-md-offset-1">
		<?php
								setCategoryView($categories, $i);
		?>
							</ul>
						</div>
		<?php
					} 
					else 
					{
		?>
					<li><a href="/product/{{ $categories[$i]->permalink }}#page-title">{{ $categories[$i]->name }}</a></li>
		<?php
					}
				}
		?>
		<?php
			} else {
				if($categories[$value]->id == $categories[$i]->parent_id  && $categories[$value]->is_header != 1  ) 
				{
					$hasChild = 0;
					for($z=0; $z<count($categories); $z++)
					{
						if($categories[$i]->id == $categories[$z]->parent_id  && $categories[$i]->is_header != 1 )
						{
							$hasChild = 1;
							break;
						}
					}
					if($hasChild == 1)
					{
		?>
						<li><a data-toggle="collapse" data-parent="accordion-1" href="#{{ $categories[$i]->permalink }}">{{ $categories[$i]->name }}</a></li>
			   			<div id="{{ $categories[$i]->permalink }}" class ="panel-collapse collapse">
			   				<ul class="nav nav-list col-md-offset-1">
		<?php
								setCategoryView($categories, $i);
		?>
							</ul>
						</div>
		<?php
					} 
					else 
					{
		?>
					<li><a href="/product/{{ $categories[$i]->permalink }}#page-title">{{ $categories[$i]->name }}</a></li>
		<?php
					}
				}

			}
		}
	}
	?>