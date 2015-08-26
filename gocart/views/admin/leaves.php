<div class="row">
	<div class="col-sm-5">
		<h3><?php echo lang('leaves');?></h3>
	</div>
	<div class="col-sm-12">
		<form class="form-inline pull-right">
			<input class="form-control m-b"  type="text" name="start" id="datepicker1" placeholder="<?php echo lang('from');?>"/>			
			<input class="form-control m-b"  type="text" name="end" id="datepicker2" placeholder="<?php echo lang('to');?>"/>									
			<select class="form-control m-b" name="applicants" id="applicants">			
				<option value="">==<?php echo lang('applicants')?>==</option>
				<?php				
					foreach($staffs as $staff):					
				?>				
					<option value="<?php echo $staff->id?>"><?php echo $staff->lastname.' '.$staff->firstname ?></option>
				<?php
					endforeach;									
				?>
			</select>			
			
			<?php
		 	$options = array(	 
		 						 ''=> lang('leave_type')
		 						,'Annual Leave'	=> lang('annual_leave')
								,'Sick Leave'	=> lang('sick_leave')
								,'Emergency Leave'	=> lang('emergency_leave')
								);
			echo form_dropdown('leave_type', $options, set_value('leave_type'), 'class="form-control m-b"');
			?>
									
			<?php
		 	$options = array(	 
		 						''=>lang('day_type')
		 						,'Full Day Leave'	=> lang('full_day')
								,'First Half Leave'	=> lang('first_half')
								,'Second Half Leave'	=> lang('second_half')
								);
			echo form_dropdown('day_type', $options, set_value('day_type'), 'class="form-control m-b"');
			?>
			
			
			<?php
		 	$options = array(
		 					''=> lang('status'),
						  'Pending'		=> lang('pending'),
						  'Approved'	=> lang('approved'),
						  'Rejected'	=> lang('rejected'),
						  'Cancelled'	=> lang('cancel')
						);
			echo form_dropdown('status', $options, set_value('status'), 'class="form-control m-b"');						
			?>						
			
			<input class="btn btn-primary m-b" type="button" value="<?php echo lang('search');?>" onclick="get_leaves()"/>
		</form>
	</div>
</div>

 <div class="row">
		<div class="col-sm-12">
			<div class="ibox">
 				<div class="ibox-content">
	<div class="span12" id="leaves"></div>
</div></div></div></div>



<script type="text/javascript">

function get_leaves()
{
	show_animation();
	$.post('<?php echo site_url($this->config->item('admin_folder').'/leaves/leave_listing');?>',{start:$('#datepicker1').val(), end:$('#datepicker2').val(), applicants:$('#applicants').val(), leave_type:$('#leave_type').val(), day_type:$('#day_type').val(), status:$('#status').val()}, function(data){
		$('#leaves').html(data);
		setTimeout('hide_animation()', 500);
	});
}

function show_animation()
{
	$('#saving_container').css('display', 'block');
	$('#saving').css('opacity', '.8');
}

function hide_animation()
{
	$('#saving_container').fadeOut();
}

</script>

<div id="saving_container" style="display:none;">
	<div id="saving" style="background-color:#000; position:fixed; width:100%; height:100%; top:0px; left:0px;z-index:100000"></div>
	<img id="saving_animation" src="<?php echo base_url('assets/img/storing_animation.gif');?>" alt="saving" style="z-index:100001; margin-left:-32px; margin-top:-32px; position:fixed; left:50%; top:50%"/>
	<div id="saving_text" style="text-align:center; width:100%; position:fixed; left:0px; top:50%; margin-top:40px; color:#fff; z-index:100001"><?php echo lang('loading');?></div>
</div>