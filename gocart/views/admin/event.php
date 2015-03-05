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
		

	$return = site_url($admin_folder.'/event/index/'.$by.'/'.$sort.'/'.$code);
	
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

<?php echo form_open($this->config->item('admin_folder').'/event/bulk_save', array('id'=>'bulk_form'));?>
<table class="table table-striped">
	<thead>
			<tr>
				<th><?php echo sort_url('id', 'id', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('date', 'date', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('date_to', 'date_to', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('time', 'time', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('time_to', 'time_to', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('event', 'event', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('venue', 'venue', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('brands', 'brands', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th><?php echo sort_url('enabled', 'status', $order_by, $sort_order, $code, $this->config->item('admin_folder'));?></th>
				<th>
					<span class="btn-group pull-right">
						<button class="btn" href="#"><i class="icon-ok"></i> <?php echo lang('bulk_save');?></button>
						<a class="btn" style="font-weight:normal;"href="<?php echo site_url($this->config->item('admin_folder').'/event/form');?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_event');?></a>
					</span>
				</th>
			</tr>
	</thead>
	
	
	<?php echo (count($event) < 1)?'<tr><td style="text-align:center;" colspan="10">'.lang('no_event_or_links').'</td></tr>':''?>
	<?php if($event):?>
	<tbody>		
	
	
	
	<?php foreach ($event as $each_event):?>
			<tr>
				
				<td><?php echo $each_event->id ?></td>															
				<td><?php echo form_input(array('name'=>'event['.$each_event->id.'][date]','value'=>set_value('date', date('d-m-Y', strtotime($each_event->date))), 'class'=>'span2'));?></td>				
				<td><?php echo form_input(array('name'=>'event['.$each_event->id.'][date_to]','value'=>set_value('date_to', date('d-m-Y', strtotime($each_event->date_to))), 'class'=>'span2'));?></td>				
				<td><?php echo form_input(array('name'=>'event['.$each_event->id.'][time]','value'=>set_value('time', $each_event->time), 'class'=>'span2'));?></td>
				<td><?php echo form_input(array('name'=>'event['.$each_event->id.'][time_to]','value'=>set_value('time_to', $each_event->time_to), 'class'=>'span2'));?></td>
				<td><?php echo form_input(array('name'=>'event['.$each_event->id.'][event]', 'value'=>set_value('event', $each_event->event), 'class'=>'span4'));?></td>
				<td><?php echo form_input(array('name'=>'event['.$each_event->id.'][venue]', 'value'=>set_value('venue', $each_event->venue), 'class'=>'span2'));?></td>
				<td><?php echo form_input(array('name'=>'event['.$each_event->id.'][brands]', 'value'=>set_value('brands', $each_event->brands), 'class'=>'span2'));?></td>
				<td>
					<?php
					 	$options = array(
			                  '1'	=> lang('enabled'),
			                  '0'	=> lang('disabled')
			                );

						echo form_dropdown('event['.$each_event->id.'][status]', $options, set_value('status',$each_event->status), 'class="span2"');
					?>
				</td>
				<td>
					<span class="btn-group pull-left">
						<a class="btn" href="<?php echo  site_url($this->config->item('admin_folder').'/event/form/'.$each_event->id);?>"><i class="icon-pencil"></i>  <?php echo lang('edit');?></a>
						<a class="btn btn-danger" href="<?php echo  site_url($this->config->item('admin_folder').'/event/delete/'.$each_event->id);?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
					</span>
				</td>
			</tr>
	<?php endforeach; ?>
	</tbody>
	<?php endif;?>
</table>
</form>