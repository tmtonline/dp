
<?php echo $id?>
<?php echo form_open($this->config->item('admin_folder').'/admin/form/'.$id, 'class="form-horizontal"'); ?>


<div class="row">
	<div class="col-lg-12">
         <div class="ibox float-e-margins">
		  <div class="ibox-title">
                            <h5>Administrator Form</h5>
                            
							</div>
							
							
		 <div class="ibox-content">
         <!--form method="get" class="form-horizontal"-->
		
		 
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('firstname');?> :</label>

		<?php
		$data	= array('name'=>'firstname', 'value'=>set_value('firstname', $firstname), 'class'=>'form-control');
		echo '<div class="col-sm-10">'.form_input($data).'</div>';
		?>
		</div>
		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('lastname');?> :</label>
		
		<?php
		$data	= array('name'=>'lastname', 'value'=>set_value('lastname', $lastname), 'class'=>'form-control');
		echo '<div class="col-sm-10">'. form_input($data).'</div>';
		?>
		</div>
		

		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('username');?> :</label>
	
		<?php
		$data	= array('name'=>'username', 'value'=>set_value('username', $username), 'class'=>'form-control');
		echo '<div class="col-sm-10">'.form_input($data).'</div>';
		?>
		</div>
		
		
        
		
		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('email');?> :</label>
	
		<?php
		$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'form-control');
		echo'<div class="col-sm-10">'. form_input($data).'</div>';
		?>
		</div>
		

		 <div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('access');?> :</label>
		
		<?php
		$options = array(	'Admin'		=> 'Admin',
							'Staff'		=> 'Staff'
		                );
		echo '<div class="col-sm-10">'.form_dropdown('access', $options, set_value('phone', $access), 'class="form-control m-b"').'</div>';
		?>
		</div>
		
		
		 
		
		
		
		

		<div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('password');?> :</label>
		
		<?php
		$data	= array('name'=>'password');
		echo form_password($data);
		?>
		</div>
		
		

			<div class="hr-line-dashed"></div>
		 <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('confirm_password');?> :</label>
		
		<?php
		$data	= array('name'=>'confirm');
		echo form_password($data);
		?>
		</div>
		
		<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
		</div>
		
		

	
</form>

</div>
</div>
</div>
</div>

<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>