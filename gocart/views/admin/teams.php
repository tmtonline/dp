<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>

<div style="text-align:right;">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/team/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_team');?></a>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('name');?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php echo (count($teams) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_team_or_links').'</td></tr>':''?>
	<?php if($teams):?>	
		<?php foreach ($teams as $team):?>
			<tr>
				<td><?php echo $team->name; ?></td>
				<td>
					<div class="btn-group" style="float:right;">					
						<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/team/form/'.$team->id);?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>	
						<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/team/delete/'.$team->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>					
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
</table>