<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>
<div class="btn-group pull-right">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/news/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new');?></a>	
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('title');?></th>
			<th></th>
		</tr>
	</thead>
	
	<?php echo (count($news) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_news_or_links').'</td></tr>':''?>
	<?php if($news):?>
	<tbody>		
		<?php
		$GLOBALS['admin_folder'] = $this->config->item('admin_folder');		
		foreach($news as $new)
		{?>
		<tr class="gc_row">
			<td>
				<?php echo $new->title; ?>
			</td>
			<td>
				<div class="btn-group pull-right">
					<?php if(!empty($new->url)): ?>
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/news/link_form/'.$new->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
						<a class="btn" href="<?php echo $new->url;?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('follow_link');?></a>
					<?php else: ?>
						<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/news/form/'.$new->id); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
						<a class="btn" href="<?php echo site_url($new->slug); ?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('go_to_new');?></a>
					<?php endif; ?>
					<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/news/delete/'.$new->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
				</div>
			</td>
		</tr>
		<?php		
		}
		?>
	</tbody>
	<?php endif;?>
</table>