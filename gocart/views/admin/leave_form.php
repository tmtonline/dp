<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>DETAILS</h5>
                            
                        </div>

						
                        <div class="ibox-content">
						
						
						
						
						<?php echo form_open($this->config->item('admin_folder').'/leaves/form/'.$id, "id='application_form' class='form-horizontal' "); ?>
                            
							
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('name')?> :</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $firstname ?> <?php echo $lastname ?></p></div>
                                </div>
								
								
								
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('email')?> :</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo $email ?></p></div>
                                </div>
								
								
								
								   <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('application_date')?> :</label>

                                    <div class="col-lg-10"><p class="form-control-static"> <?php echo date("d-m-Y") ?></p></div>
                                </div>
					
                              
							 <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('leave_type')?> :<br/></label>

                                    <div class="col-sm-10">
                                        <div class="radio i-checks"><label> <input type="radio" value="Annual Leave" name="leave_type"> <i></i> <?php echo lang('annual_leave')?> </label></div>
                                        <div class="radio i-checks"><label> <input type="radio" checked="" value="Sick Leave" name="leave_type"> <i></i>  <?php echo lang('sick_leave')?></label></div>
                                        <div class="radio i-checks"><label> <input type="radio" checked="" value="Emergency Leave" name="leave_type"> <i></i> <?php echo lang('emergency_leave')?></label></div>
                                    </div>
                                </div>
							 
							
							  <div class="hr-line-dashed"></div>
							   <div class="form-group" id="select_date">
							   
                                <!--div class="form-group"><label class="col-lg-2 control-label"><?php echo lang('datefrom');?> :</label>

                                 
									<div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" value="05/14/2014"/>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="end" value="05/22/2014" />
                                </div>
                                </div-->
								
								 <div class="form-group"><label class="col-sm-2 control-label" for="start_date"><?php echo lang('datefrom');?> :</label>
									<?php
									$data	= array('name'=>'datefrom', 'id'=>'datepicker1', 'value'=>set_value('datefrom'), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								 </div>
								 
								 <div class="form-group"><label class="col-sm-2 control-label" for="start_date"><?php echo lang('dateto');?></label>
									<?php
									$data	= array('name'=>'dateto', 'id'=>'datepicker2', 'value'=>set_value('dateto'), 'class'=>'form-control');
									echo '<div class="col-sm-10">'.form_input($data).'</div>'; ?>
								 </div>
								
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
                          
						  
                          
                        
						
                                
								 <div class="form-group"><label class="col-sm-2 control-label" for="reason"><?php echo lang('reason');?> :</label>
								
								 </div>	
								 
								 <textarea class="input-block-level" id="summernote" name="reason" rows="5">
										<?php echo set_value('reason', html_entity_decode($reason)) ?>
									</textarea>
									
                                <div class="hr-line-dashed"></div>
								<div class="form-actions">
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                       <button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>		
										
										
				
	</div>
										
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			
			
			