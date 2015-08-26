<?php $countries = config_item('country_list');  ?>
<link href="<?php echo base_url('assets/css/pdf.css') ?>" rel="stylesheet"/>
<style>
table {
	border-collapse: collapse;
	border-spacing: 0;
	width:100%;
}
.table-title{
	padding:0;	
}
.table-bordered td, .table-bordered th{
	border: 1px solid #ddd;
	padding: 8px;
	border-collapse: collapse;	
}
.table-bordered th{
	color: #000;
}
body {
	font-size: 75%;
}
</style>

<?php 
	//$logo = get_siteconfig('logo');
	//$name = get_siteconfig('name');
	
?>

<div class="row">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px">				
			<img src="<?php echo theme_img('tmt.png') ?>" width="35%"/>								
		</td>
	</tr>					
	</table>
	</div>	
</div>
<hr/>
<div class="row">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td colspan=2 align="center"><h1>Leave Application</h1></td>
	</tr>		
	</table>
	</div>
</div>
<div class="row">
<div class="col-lg-12">
<h2>Leave Applications</h2>
<table class="table table-bordered">	
	<thead>
		<tr class="table_header">
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('name');?></th>						
			<th><?php echo lang('application_date');?></th>			
			<th><?php echo lang('day_type');?></th>
			<th><?php echo lang('leave_type');?></th>
			<th><?php echo lang('status');?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo (count($leaves) < 1)?'<tr><td style="text-align:center;" colspan="7">'.lang('no_leaves').'</td></tr>':''?>		
		<?php 
				foreach ($leaves as $leave):					
		?>
		<tr>
			<td class="project-title"><?php echo $leave->title; ?></td>
			<td><?php echo $leave->application_date; ?></td>
			<td><?php echo $leave->day_type ?></td>
			<td><?php echo $leave->leave_type ?></td>
			<td><?php echo $leave->status ?></td>					
		</tr>
		<?php endforeach;?>		
	</tbody>
</table>
		
</div>
</div>

