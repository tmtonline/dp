<?php echo form_open($this->config->item('admin_folder').'/pages/form/'.$id); ?>

<div class="tabbable">
	
	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('content');?></a></li>
		<li><a href="#attributes_tab" data-toggle="tab"><?php echo lang('attributes');?></a></li>
		<li><a href="#seo_tab" data-toggle="tab"><?php echo lang('seo');?></a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
			<fieldset>
				<label for="title"><?php echo lang('title');?></label>
				<?php
				$data	= array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'span12');
				echo form_input($data);
				?>
				
				<label for="content"><?php echo lang('content');?></label>
				<?php
				$data	= array('name'=>'content', 'class'=>'redactor', 'value'=>set_value('content', $content));
				echo form_textarea($data);
				?>
				
				</br>
				<i><?php echo lang('for_metro')?>: </i>
				<label for="content"><?php echo lang('colour');?></label>
								
				<div id="ColorPicker">
					<!--span class="ColorBlotch" style="background-color: transparent;">?</span-->
					<span class="ColorBlotch" style="background-color: #85af5d;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #29aae3;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #035792;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #c53238;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #8b2767;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #f87c68;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #f17225;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #272625;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #6e6e6e;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #ffb606;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #06a78b;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #96529f;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #ef8201;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #5fcdcc;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #6e6db6;">&nbsp;</span>					
					<span class="ColorBlotch" style="background-color: #82615D;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #AA2E7A;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #A8D66B;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #55F2EA;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #A8FBB7;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #6C2742;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #CB4468;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #365E7D;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #11B3D3;">&nbsp;</span>
					<span class="ColorBlotch" style="background-color: #061945;">&nbsp;</span>					
				</div>
				<?php
					$data	= array('name'=>'colour', 'id'=>'colour', 'value'=>set_value('colour', $colour), 'class'=>'span12', 'readonly'=>'readonly');
					echo form_input($data);
				?>
				
				
				
				
			</fieldset>
		</div>

		<div class="tab-pane" id="attributes_tab">
			<fieldset>
				<label for="menu_title"><?php echo lang('menu_title');?></label>
				<?php
				$data	= array('name'=>'menu_title', 'value'=>set_value('menu_title', $menu_title), 'class'=>'span3');
				echo form_input($data);
				?>
			
				<label for="slug"><?php echo lang('slug');?></label>
				<?php
				$data	= array('name'=>'slug', 'value'=>set_value('slug', $slug), 'class'=>'span3');
				echo form_input($data);
				?>
			
				<label for="sequence"><?php echo lang('parent_id');?></label>
				<?php
				$options	= array();
				$options[0]	= lang('top_level');
				/* function page_loop($pages, $dash = '', $id=0)
				{
					$options	= array();
					foreach($pages as $page)
					{
						//this is to stop the whole tree of a particular link from showing up while editing it
						if($id != $page->id)
						{
							$options[$page->id]	= $dash.' '.$page->title;
							$options			= $options + page_loop($page->children, $dash.'-', $id);
						}
					}
					return $options;
				}
				$options	= $options + page_loop($pages, '', $id); */
				echo form_dropdown('parent_id', $options,  set_value('parent_id', $parent_id));
				?>
			
				<label for="sequence"><?php echo lang('sequence');?></label>
				<?php
				$data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'span3');
				echo form_input($data);
				?>
			</fieldset>
		</div>
	
		<div class="tab-pane" id="seo_tab">
			<fieldset>
				<label for="code"><?php echo lang('seo_title');?></label>
				<?php
				$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'span12');
				echo form_input($data);
				?>
			
				<label><?php echo lang('meta');?></label>
				<?php
				$data	= array('rows'=>'3', 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'span12');
				echo form_textarea($data);
				?>
				
				<!--p class="help-block"><?php echo lang('meta_data_description');?></p-->
			</fieldset>
		</div>
	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>	
</form>