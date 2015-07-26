<?php echo form_open($this->config->item('admin_folder').'/team/form/'.$id, 'class="form-horizontal"'); ?>

<div class="row">
	<div class="col-lg-12">
         <div class="ibox float-e-margins">
		  <div class="ibox-title">
                            <h5>Team Setting</h5>
                            
							</div>



<div class="ibox-content">
      
		 

		 
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('name');?> :</label>
		
		<?php
		$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
		echo'<div class="col-sm-10">'. form_input($data).'</div>';
		?>
		</div>
		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('weekend_type');?> :</label>
	
		<?php
		$options = array(	'1'		=> 'Odd Saturday',
							'2'		=> 'Even Saturday',
							'3'		=> 'Full Work Weekend',
							'4'		=> 'No Work Weekend'
		                );
										
		echo '<div class="col-sm-10">'.form_dropdown('weekendID', $options, set_value('weekendID', $weekendID), 'class="form-control m-b"').'</div>';
		?>
	
		</div>

		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('desc');?> :</label>
		<?php
		$data	= array('rows'=>'3', 'name'=>'desc', 'value'=>set_value('meta', html_entity_decode($desc)), 'class'=>'form-control');
		echo '<div class="col-sm-10">'.form_textarea($data).'</div>';
		?>				
		</div>
		
		
		
		<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
		</div>
	
	
	
	
	</div>
</div>
</div>
</div>

	
</form>
<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>