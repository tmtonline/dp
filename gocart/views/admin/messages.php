<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>

<div style="text-align:right;">
	<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/messages/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_admin');?></a>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo lang('name');?></th>
			<th><?php echo lang('email_address');?></th>
			<th><?php echo lang('company_name');?></th>
			
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($messages as $message):?>
		<tr>
			<td><?php echo $message->name; ?></td>
			<td><a href="mailto:<?php echo $message->email_address;?>"><?php echo $message->email_address; ?></a></td>
			<td><?php echo $message->company_name; ?></td>						
			<td>
				<div class="btn-group" style="float:right;">
					<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/messages/form/'.$message->id);?>"><i class="icon-search"></i> <?php echo lang('view');?></a>	
					<?php					
					$margin			= 30;
					?>
					<a class="btn btn-danger" href="<?php echo site_url($this->config->item('admin_folder').'/messages/delete/'.$message->id); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
					
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>