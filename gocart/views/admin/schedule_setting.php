 <?php echo form_open($this->config->item('admin_folder').'/weekend_schedule/form/'.$id, 'class="form-horizontal"'); ?>
 <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Weekend Schedule Setting</h5>
                            
                        </div>
						
                        <div class="ibox-content">

						
                            <!--form method="get" class="form-horizontal"-->
                          
                                
                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('team');?></label>

                                    <div class="col-sm-10">
                                     <?php				
			foreach($teams as $team):
				$options[$team->id] = $team->name;
			endforeach;
						
			echo '<div class="col-sm-10">'.form_dropdown('teamID', $options, set_value('teamID', !empty($weekend_schedules[0]->teamID) ? $weekend_schedules[0]->teamID : '' ), 'class="form-control m-b"').'</div>';
			
		?>
                                        
                                    </div>
                                </div>
                               
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('staff');?></label>

                                    <div class="col-sm-10">
									 <div class="checkbox">
                                        <?php				
											foreach($staffs as $staff):
												$checked = '';				
												if(in_array($staff->id, $staff_list)):
													$checked = 'checked';
												endif;			
										?>				
											<input type="checkbox" name="staffID[]" <?php echo $checked?> value="<?php echo $staff->id ?>">&nbsp;<?php echo $staff->firstname.' '.$staff->lastname ?><br/>
										<?php
											endforeach;									
										?>
                                       </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                               		<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
		</div>
	

<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>