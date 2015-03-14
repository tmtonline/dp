<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>

<div style="text-align:right;">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/weekend_schedule/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_weekend_schedule');?></a>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('team');?></th>
			<th><?php echo lang('name');?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($schedules) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_weekend_schedule_or_links').'</td></tr>':''?>
	<?php if($schedules):?>	
		<?php foreach ($schedules as $schedule):?>
			<tr>
				<td><?php echo $schedule->teamName; ?></td>
				<td><?php echo $schedule->staffID; ?></td>
				<td>
					<div class="btn-group" style="float:right;">					
						<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/weekend_schedule/form/'.$schedule->teamID);?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>	
						<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/weekend_schedule/delete/'.$schedule->teamID); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>					
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
</table>