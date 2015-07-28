<?php
//set "code" for searches
if(!$code)
{
	$code = '';
}
else
{
	$code = '/'.$code;
}
function sort_url($lang, $by, $sort, $sorder, $code, $admin_folder)
{
	if ($sort == $by)
	{
		if ($sorder == 'asc')
		{
			$sort	= 'desc';
			$icon	= ' <i class="icon-chevron-up"></i>';
		}
		else
		{
			$sort	= 'asc';
			$icon	= ' <i class="icon-chevron-down"></i>';
		}
	}
	else
	{
		$sort	= 'asc';
		$icon	= '';
	}
			
	$return = site_url($admin_folder.'/leaves/index/'.$by.'/'.$sort.'/'.$code);
	
	echo '<a href="'.$return.'">'.lang($lang).$icon.'</a>';
}
if(!empty($term)):
	$term = json_decode($term);
	if(!empty($term->term)):?>
		<div class="alert alert-info">
			<?php echo sprintf(lang('search_returned'), intval($total));?>
		</div>
	<?php endif;?>
<?php endif;?>


<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_leave');?>');
}
</script>
<style type="text/css">
	.pagination {
		margin:0px;
		margin-top:-3px;
	}
</style>



<div class="row">
  <div class="col-lg-12">
	<div class="wrapper wrapper-content animated fadeInUp">
		 <div class="ibox">
		 
		 
				  <center> <div class="ibox-title">
						
						
		
		<div class="span7">
			<b><?php echo lang('annual_leave_balance')?>:</b> <?php echo isset($annual_left->total) && !empty($annual_left->total) ? $annual_left->total : 0?></br>
			<b><?php echo lang('sick_leave_balance')?>:</b> <?php echo isset($sick_left->total) && !empty($sick_left->total) ? $sick_left->total : 0 ?>
			
			
			</form>
		</div>
	</div></center>

	
	
	
	
	     <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
   

                            <div class="project-list">
							
							
		<?php if($this->auth->check_access('Admin')) : ?> 
			<div class="span8">
				<?php echo form_open($this->config->item('admin_folder').'/leaves/index', 'class="form-inline form-horizontal" style="float:right"');?>
					<fieldset>												
						<input type="text" class="form-control" name="term" placeholder="<?php echo lang('search_term');?>" /> 
						<button class="btn" name="submit" value="search"><?php echo lang('search')?></button>
						<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/leaves/index');?>">Reset</a>
					</fieldset>
				</form>
			</div>
			<?php endif; ?>
	<?php echo form_open($this->config->item('admin_folder').'/leaves/bulk_save', array('id'=>'bulk_form'));?>
                                <table class="table table-hover">
								
								
								<tr>
				<th><?php echo sort_url('firstname', 'firstname', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('lastname', 'lastname', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('application_date', 'application_date', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>				
				<th><?php echo sort_url('day_type', 'day_type', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('leave_type', 'leave_type', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('status', 'status', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>				
				<th>
					<span class="btn-group pull-right">
						<button class="btn" href="#"><i class="icon-ok"></i> <?php echo lang('bulk_save');?></button>
						<?php if(!$this->auth->check_access('Admin')) : ?> 
							<a class="btn" style="font-weight:normal;"href="<?php echo site_url($this->config->item('admin_folder').'/leaves/form');?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_leave');?></a>
						<?php endif; ?>
					</span>
				</th>
			</tr>
						
                                    <tbody>
									<?php echo (count($leaves) < 1)?'<tr><td style="text-align:center;" colspan="7">'.lang('no_leaves').'</td></tr>':''?>
									
									<?php foreach ($leaves as $leave):?>
									
									<tr>
										<td class="project-title"><?php echo $leave->firstname; ?></td>
										<td><?php echo $leave->lastname; ?></td>
										<td><?php echo $leave->application_date; ?></td>
										<td><?php echo $leave->day_type ?></td>
										<td><?php echo $leave->leave_type ?></td>				
										<td>
															
											<?php
												if($this->auth->check_access('Admin') && $leave->status !== "Cancelled") :
													$options = array(
														  'Pending'		=> lang('pending'),
														  'Approved'	=> lang('approved'),
														  'Rejected'	=> lang('rejected'),
														  'Cancelled'	=> lang('cancel')
														);
							
													echo form_dropdown('leave['.$leave->id.'][status]', $options, set_value('status',$leave->status), 'class="span2"');
												else:
													echo $leave->status;						
												endif;						
											?>
											
										</td>
										<td class="project-status">
											<span class="btn-group pull-right">
											<?php if($leave->status !== "Cancelled"): ?>						
													<a class="btn btn-white btn-sm new-type" href="<?php echo  site_url($this->config->item('admin_folder').'/leaves/form/'.$leave->id);?>"><i class="icon-pencil"></i>  <?php echo lang('edit');?></a>													
											<?php endif; ?>
													<a class="btn btn-danger btn-sm " href="<?php echo  site_url($this->config->item('admin_folder').'/leaves/delete/'.$leave->id);?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
											</span>
										</td>
									</tr>



									
									<?php endforeach;?>
									
									
                                   
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

		 
		
  
		</div>
	</div>
  </div>

</div>