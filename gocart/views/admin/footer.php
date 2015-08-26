<div class="footer">
    <div class="pull-right">
        10GB of <strong>250GB</strong> Free.
    </div>
    <div>
        <strong>Copyright</strong> Example Company &copy; 2014-2015
    </div>
</div>

</div>
</div>



<!-- Mainly scripts -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/fullcalendar/moment.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>


<!-- Custom and plugin javascript -->
<script type="text/javascript" src="<?php echo base_url('assets/js/inspinia.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/pace/pace.min.js');?>"></script>
<!-- jQuery UI custom -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.custom.min.js');?>"></script>
<!--script type="text/javascript" src="<?php echo base_url('assets/js/redactor.min.js');?>"></script-->

<!-- iCheck -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js');?>"></script>
<!-- Full Calendar -->
<script type="text/javascript" src="<?php echo base_url('assets/js/fullcalendar.min.js');?>"></script>
<!--script type="text/javascript" src="<?php echo base_url('assets/js/plugins/fullcalendar/fullcalendar.min.js');?>"></script-->

<!-- SUMMERNOTE -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/summernote/summernote.min.js');?>"></script>

<!-- Data picker -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datapicker/bootstrap-datepicker.js');?>"></script>

<script type="text/javascript">
var applicant = new Array();
$('#calendar').fullCalendar({
	header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month'
	},
	defaultDate: '<?php echo date('Y-m-d')?>',
	editable: false,
	eventLimit: true, // allow "more" link when too many events
	events: {
		url: '<?php echo site_url($this->config->item('admin_folder')) ?>/dashboard/ajax_get_leaves',
		error: function() {
			$('#script-warning').show();
		}		     			
	}
});

	<?php if(isset($colour)):?>
		var color = '<?php echo $colour ?>';
		//var templateColor = $( ".ColorBlotch" ).css( "background-color" );
		$(".ColorBlotch").each( function (index) {
		  if(color == $(this).css('background-color')){
			  $( this ).addClass(" FocusColor");
		  }
		  
		 });
			
	<?php endif;?>
	
	

	
</script>

	</style>
	
	
	
	<script type="text/javascript">
$(document).ready(function(){
	
	$('#summernote').summernote({
        height: 500
	});
    
});
</script>




<script>
var site_url = "<?php echo site_url() ?>";
var base_url = "<?php echo $this->config->item('admin_folder')?>";
var recordID = "<?php echo (!empty($id) && isset($id)) ? $id : '' ?>";
//$('#select_datefrom').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});
//$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});
$("#cancel").click(function(){ 
		var r = confirm("Confirm to Cancel your leave application?");
		if (r == true) {			
			document.getElementById('application_form').action = site_url + base_url + "/" + "leaves/cancel_form/" + recordID;
			$('#application_form').submit();			
		}
});


$('#datepicker1').datepicker({
	format: 'dd-mm-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('#datepicker2').datepicker({
	format: 'dd-mm-yyyy',
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});
</script>



