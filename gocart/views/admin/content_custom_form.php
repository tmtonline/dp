<?php echo form_open($this->config->item('admin_folder').'/content_custom/form/'.$id); ?>

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
				$data	= array('name'=>'content', 'class'=>'redactor' ,'value'=>set_value('content', $content));
				echo form_textarea($data);
				?>
				
			
			</fieldset>
		</div>

		<div class="tab-pane" id="attributes_tab">
			<fieldset>							
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