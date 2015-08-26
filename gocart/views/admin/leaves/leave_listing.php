<div class="row">
	<div class="col-sm-10">
		<h2><?php echo lang('leaves') ?></h2>
	</div>

	<div class="col-sm-2">
	
	<?php if($this->auth->check_access('Admin')) : ?>	
		<a href="<?php echo site_url($this->config->item('admin_folder').'/leaves/viewleavespdf/'.$start.'/'.$end.'/'.$applicants.'/'.$leave_type.'/'.$day_type.'/'.$status);?>" class="btn btn-warning btn-md">Download PDF</a>	
	<?php endif; ?>
	</div>

</div>

<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('name');?></th>						
			<th><?php echo lang('from');?></th>			
			<th><?php echo lang('to');?></th>			
			<th><?php echo lang('day_type');?></th>
			<th><?php echo lang('leave_type');?></th>
			<th><?php echo lang('status');?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo (count($leaves) < 1)?'<tr><td style="text-align:center;" colspan="7">'.lang('no_leaves').'</td></tr>':''?>
				
		<?php foreach ($leaves as $leave):?>
		
		<tr>
			<td class="project-title"><?php echo $leave->title; ?></td>
			<td><?php echo $leave->datefrom; ?></td>
			<td><?php echo $leave->dateto; ?></td>
			<td><?php echo $leave->day_type ?></td>
			<td><?php echo $leave->leave_type ?></td>				
			<!--td>
								
				<?php
					if($this->auth->check_access('Admin') && $leave->status !== "Cancelled") :
						$options = array(
							  'Pending'		=> lang('pending'),
							  'Approved'	=> lang('approved'),
							  'Rejected'	=> lang('rejected'),
							  'Cancelled'	=> lang('cancel')
							);

						echo form_dropdown('leave['.$leave->id.'][status]', $options, set_value('status',$leave->status), 'class="form-control"');
					else:
						echo $leave->status;						
					endif;						
				?>
				
			</td-->
			<td><?php echo $leave->status ?></td>
			<td class="project-status">
				<span class="btn-group pull-right">
				<?php if($leave->status !== "Cancelled"): ?>						
						<a class="btn btn-white btn new-type" href="<?php echo  site_url($this->config->item('admin_folder').'/leaves/form/'.$leave->id);?>"><i class="icon-pencil"></i>  <?php echo lang('edit');?></a>													
				<?php endif; ?>
						<a class="btn btn-danger btn " href="<?php echo  site_url($this->config->item('admin_folder').'/leaves/delete/'.$leave->id);?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</span>
			</td>
		</tr>
		
		<?php endforeach;?>
	</tbody>
</table>

