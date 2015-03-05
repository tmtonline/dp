<?php

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
		

	$return = site_url($admin_folder.'/outlet/index/'.$by.'/'.$sort.'/'.$code);
	
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
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>
<div class="row">
	<div class="span12" style="border-bottom:1px solid #f5f5f5;">
		<div class="row">
			<div class="span4">
				<?php echo $this->pagination->create_links();?>	&nbsp;
			</div>
		</div>
	</div>
</div>
<div class="btn-group pull-right">
</div>

<?php echo form_open($this->config->item('admin_folder').'/outlet/bulk_save', array('id'=>'bulk_form'));?>
<table class="table table-striped">
	<thead>
			<tr>
				<th><?php echo sort_url('id', 'id', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('state', 'zone_id', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('outlet', 'outlet', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('address', 'address', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('contact', 'contact', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('enabled', 'status', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th>
					<span class="btn-group pull-right">
						<button class="btn" href="#"><i class="icon-ok"></i> <?php echo lang('bulk_save');?></button>
						<a class="btn" style="font-weight:normal;"href="<?php echo site_url($this->config->item('admin_folder').'/outlet/form');?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_outlet');?></a>
					</span>
				</th>
			</tr>
	</thead>
	
	
	<?php echo (count($outlets) < 1)?'<tr><td style="text-align:center;" colspan="2">'.lang('no_outlet_or_links').'</td></tr>':''?>
	<?php if($outlets):?>
	<tbody>		
	<?php foreach ($outlets as $outlet):?>
			<tr>
				<td><?php echo $outlet->id ?></td>											
				
				<?php 
					foreach($state as $id=>$z):										
						$zone[$z->id] = $z->name;																				
					endforeach;																	
				?>
				
				
				
				<td>
					<?php
						echo form_dropdown('outlet['.$outlet->id.'][zone_id]', $zone, set_value('zone_id',$outlet->zone_id), 'class="span2"');
					?>
				</td>
				<td><?php echo form_input(array('name'=>'outlet['.$outlet->id.'][outlet]','value'=>form_decode($outlet->outlet), 'class'=>'span2'));?></td>
				<td><?php echo form_input(array('name'=>'outlet['.$outlet->id.'][address]', 'value'=>set_value('address', $outlet->address), 'class'=>'span4'));?></td>
				<td><?php echo form_input(array('name'=>'outlet['.$outlet->id.'][contact]', 'value'=>set_value('contact', $outlet->contact), 'class'=>'span2'));?></td>
				<td>
					<?php
					 	$options = array(
			                  '1'	=> lang('enabled'),
			                  '0'	=> lang('disabled')
			                );

						echo form_dropdown('outlet['.$outlet->id.'][status]', $options, set_value('status',$outlet->status), 'class="span2"');
					?>
				</td>
				<td>
					<span class="btn-group pull-left">
						<a class="btn" href="<?php echo  site_url($this->config->item('admin_folder').'/outlet/form/'.$outlet->id);?>"><i class="icon-pencil"></i>  <?php echo lang('edit');?></a>
						<a class="btn btn-danger" href="<?php echo  site_url($this->config->item('admin_folder').'/outlet/delete/'.$outlet->id);?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
					</span>
				</td>
			</tr>
	<?php endforeach; ?>
	</tbody>
	<?php endif;?>
</table>
</form>