<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>
<div class="btn-group pull-right">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/memberships/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_memberships');?></a>	
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('title');?></th>
			<th><?php echo lang('status');?></th>
			<th></th>
		</tr>
	</thead>
	
	
	<?php echo (count($memberships) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_memberships_or_links').'</td></tr>':''?>
	<?php if($memberships):?>
	<tbody>		
		<?php
		$GLOBALS['admin_folder'] = $this->config->item('admin_folder');		
		foreach($memberships as $memberships){			
		?>
		<tr class="gc_row">
			<td>
				<?php echo $memberships['title']; ?>
			</td>
			<td>
				<?php echo $memberships['status']; ?>
			</td>
			<td>
				<div class="btn-group pull-right">
					<?php if(!empty($memberships['url'])): ?>
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/memberships/link_form/'.$memberships['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
						<a class="btn" href="<?php echo $memberships['url'];?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('follow_link');?></a>
					<?php else: ?>						
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/memberships/form/'.$memberships['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>						
					<?php endif; ?>
					<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/memberships/delete/'.$memberships['id']); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
		<?php		
		}
		?>
	</tbody>
	<?php endif;?>
</table>