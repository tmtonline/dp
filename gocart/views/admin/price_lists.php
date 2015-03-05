<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>
<div class="btn-group pull-right">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/price_lists/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_price_lists');?></a>	
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('title');?></th>
			<th><?php echo lang('status');?></th>
			<th></th>
		</tr>
	</thead>

	<?php echo (count($price_lists) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_price_lists_or_links').'</td></tr>':''?>
	<?php if($price_lists):?>
	<tbody>		
		<?php
		$GLOBALS['admin_folder'] = $this->config->item('admin_folder');		
		foreach($price_lists as $price_lists){			
		?>
		<tr class="gc_row">
			<td>
				<?php echo $price_lists['title']; ?>
			</td>
			<td>
				<?php echo $price_lists['status']; ?>
			</td>
			<td>
				<div class="btn-group pull-right">
					<?php if(!empty($price_lists['url'])): ?>
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/price_lists/link_form/'.$price_lists['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
						<a class="btn" href="<?php echo $price_lists['url'];?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('follow_link');?></a>
					<?php else: ?>						
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/price_lists/form/'.$price_lists['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>						
					<?php endif; ?>
					<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/price_lists/delete/'.$price_lists['id']); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
		<?php		
		}
		?>
	</tbody>
	<?php endif;?>
</table>