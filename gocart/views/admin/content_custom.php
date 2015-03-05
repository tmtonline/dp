<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>
<div class="btn-group pull-right">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/content_custom/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_content_custom');?></a>	
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('title');?></th>
			
			<th></th>
		</tr>
	</thead>
	
	
	<?php echo (count($content_customs) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_content_custom_or_links').'</td></tr>':''?>
	<?php if($content_customs):?>
	<tbody>		
		<?php
		$GLOBALS['admin_folder'] = $this->config->item('admin_folder');		
		foreach($content_customs as $content_custom){			
		?>
		<tr class="gc_row">
			<td>
				<?php echo $content_custom['title']; ?>
			</td>
			
			<td>
				<div class="btn-group pull-right">
					<?php if(!empty($content_custom['url'])): ?>
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/content_custom/link_form/'.$content_custom['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
						<a class="btn" href="<?php echo $content_custom['url'];?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('follow_link');?></a>
					<?php else: ?>						
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/content_custom/form/'.$content_custom['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>						
					<?php endif; ?>
					<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/content_custom/delete/'.$content_custom['id']); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
		<?php		
		}
		?>
	</tbody>
	<?php endif;?>
</table>