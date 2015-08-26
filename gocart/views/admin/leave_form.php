<?php $GLOBALS['option_value_count'] = 0;?>

<?php if($status == 'Approved' || $status == 'Rejected' || $status == 'Cancelled'):?>

<?php echo form_open($this->config->item('admin_folder').'/leaves/admin_form/'.$id, "class='form-horizontal' "); ?>

<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('details');?></h5>
                            
                        </div>

						
                        <div class="ibox-content">
						
						
						
							
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('name')?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $firstname ?> <?php echo $lastname ?></p></div>
                                </div>
								
								
								
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('email')?> :</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $email ?></p></div>
                                </div>
								
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('application_date')?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo date("d-m-Y") ?></p></div>
                                </div>
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('leave_type')?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $leave_type ?></p></div>
                                </div>
								
								
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('no_of_day');?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $qty ?></p></div>
                                </div>
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('datefrom');?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $datefrom ?></p></div>
                                </div>
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('dateto');?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $dateto ?></p></div>
                                </div>
								
								<div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('day_leave_type')?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo $day_type ?></p></div>
                                </div>
								
								  <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('reason');?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo $reason?></p></div>
                                </div>
								
								
								
								  <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('current_status')?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo $status?></p></div>
                                </div>
								
								
								  <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('update_status')?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static">
									<?php		
								if($this->auth->check_access('Admin')) :
								
									if($status == 'Approved'):
										$options['Rejected'] = lang('rejected');
									elseif($status == 'Rejected'):									
										$options['Approved'] = lang('approved');
									else:
										$options['Rejected'] = lang('rejected');
										$options['Approved'] = lang('approved');
									endif;																					
																			 	
									echo form_dropdown('status', $options, set_value('status',$status), 'class="span2"');								
								else:
									echo '<b>'.$status.'</b>';
								endif;
							?>			
									</p></div>
                                </div>
								
								
									
									
									
                                <div class="hr-line-dashed"></div>
								<div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                      
                                       <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>		
										
										
				
	</div>
										  </form>
                                    </div>
                                </div>
                          
                        </div>
                    </div>
                </div>
            </div>
<?php else:?>
			
			
<?php  if($this->auth->check_access('Admin')) : ?>			
<?php echo form_open($this->config->item('admin_folder').'/leaves/admin_form/'.$id," class='form-horizontal' "); ?>

<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('details');?></h5>
                            
                        </div>

						
                        <div class="ibox-content">
						
						
						
							
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('name')?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $firstname ?> &nbsp; <?php echo $lastname ?></p></div>
                                </div>
								
								
								
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('email')?> :</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $email ?></p></div>
                                </div>
								
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('application_date')?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo date("d-m-Y") ?></p></div>
                                </div>
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('leave_type')?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $leave_type ?></p></div>
                                </div>
								
								
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('no_of_day');?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $qty ?></p></div>
                                </div>
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('datefrom');?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $datefrom ?></p></div>
                                </div>
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('dateto');?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $dateto ?></p></div>
                                </div>
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('day_leave_type')?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo $day_type ?></p></div>
                                </div>
								
								  <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('reason');?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo $reason?></p></div>
                                </div>
								

								  <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('status')?>:</label>

                                   
									<?php			
									if($status == 'Approved'):
										$options['Rejected'] = lang('rejected');
									elseif($status == 'Rejected'):									
										$options['Approved'] = lang('approved');
									else:
										$options['Rejected'] = lang('rejected');
										$options['Approved'] = lang('approved');
									endif;														 	
			
									echo'<div class="col-sm-10">'. form_dropdown('status', $options, set_value('status',$status), 'class="form-control m-b"').'</div>';								
							?>		
									</p>
                                </div>
								
								
									
									
									
                                <div class="hr-line-dashed"></div>
								<div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                      
                                       <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>		
										
										
				
	</div>
										 </form>
                                    </div>
                                </div>
                           
                        </div>
                    </div>
                </div>
            </div>
				<?php else:?>
				

				
				
	<?php echo form_open($this->config->item('admin_folder').'/leaves/form/'.$id, "id='application_form' class='form-horizontal' "); ?>

<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo lang('details');?></h5>
                            
                        </div>

						
                        <div class="ibox-content">
						
						
						
							
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('name')?>: </label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $firstname ?> &nbsp; <?php echo $lastname ?></p></div>
                                </div>
								
								
								
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('email')?> :</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $email ?></p></div>
                                </div>
								
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('application_date')?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo date("d-m-Y") ?></p></div>
                                </div>
								
								<?php if($id):?>
								 <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('status')?>:</label>

                                    <div class="col-lg-10"><p class="form-control-static"><?php echo $status ?></p></div>
                                </div>
								<?php endif;?>
								
								
								<div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('leave_type')?> :<br/></label>

                                    <div class="col-sm-10">
                                        <div class="radio i-checks"><label> <input type="radio" value="Annual Leave" name="leave_type"> <i></i> <?php echo lang('annual_leave')?> </label></div>
                                        <div class="radio i-checks"><label> <input type="radio" checked="" value="Sick Leave" name="leave_type"> <i></i>  <?php echo lang('sick_leave')?></label></div>
                                        <div class="radio i-checks"><label> <input type="radio" checked="" value="Emergency Leave" name="leave_type"> <i></i> <?php echo lang('emergency_leave')?></label></div>
                                    </div>
                                </div>
								
								
								  <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label" for="start_date"><?php echo lang('datefrom');?></label>

                                   
									<?php
									$data	= array('name'=>'datefrom', 'id'=>'datepicker1', 'value'=>set_value('datefrom'), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								<input id="date_alt" type="hidden" name="start_date" />
							
									</p>
                                </div>

								  <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label" for="end_date"><?php echo lang('dateto');?> </label>

                               
								<?php
									$data	= array('name'=>'dateto', 'id'=>'datepicker2', 'value'=>set_value('dateto'), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
					
								<input id="date_to_alt" type="hidden" name="end_date" />
							
									</p>
                                </div>
								
								
								 <div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('day_leave_type')?>:</label>
		
								<?php
							 	$options = array(	 'Full Day Leave'	=> lang('full_day')
													,'First Half Leave'	=> lang('first_half')
													,'Second Half Leave'	=> lang('second_half')
													);
								echo'<div class="col-sm-10">'. form_dropdown('day_type', $options, set_value('day_type',$day_type), 'class="form-control m-b"').'</div>';
								?>
		
								</div>
								
								 <div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-2 control-label" for="reason"><?php echo lang('reason');?> :</label>
								<textarea class="input-block-level" id="summernote" name="reason" rows="5">
		                        		<?php echo set_value('reason', $reason) ?>
		                        </textarea>
							 </div>
							 

                        
                        
                            <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('day_leave_type')?> :</label>

                                    <div class="col-sm-10"><select class="form-control m-b" name="day_type">
                                        <option><?php echo lang('full_day')?></option>
                                        <option><?php echo lang('first_half')?></option>
                                        <option><?php echo lang('second_half')?></option>
                                        
                                    </select>

                                    </div>
                                </div>  
                          
		
								 <div class="hr-line-dashed"></div>	
                                <div class="hr-line-dashed"></div>
								<div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                      
                                       <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
										<?php if($id):?>
											<a id="cancel" class="btn btn-primary"><?php echo lang('cancel');?></a>
										<?php endif;?>
										
										
				
	</div>
										</form>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
				<?php endif;?>
			
<?php endif;?>



<script>

var site_url = "<?php echo site_url() ?>";
var base_url = "<?php echo $this->config->item('admin_folder')?>";
var recordID = "<?php echo $id ?>";

$('#select_datefrom').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

$("#cancel").click(function(){ 
		var r = confirm("Confirm to Cancel your leave application?");
		if (r == true) {			
			document.getElementById('application_form').action = site_url + base_url + "/" + "leaves/cancel_form/" + recordID;
			$('#application_form').submit();			
		}
});


</script>
				
				

		
				
				


				
				
				
				
				

			
			
			
			