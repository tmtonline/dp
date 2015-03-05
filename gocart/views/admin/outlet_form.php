<?php echo form_open_multipart($this->config->item('admin_folder').'/outlet/form/'.$id); ?>

<div class="tabbable">
	
	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('content');?></a></li>
		
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
			
		
			<fieldset>
				<label><?php echo lang('state');?></label>
												
				<select name="zone_id" class="span12">
				<?php 				
						foreach($state as $id=>$z):?>
						
							<option value="<?php echo $z->id;?>" <?php echo $z->id == $zone_id ? 'selected' : '' ?>><?php echo $z->name;?></option>
						
						<?php endforeach;				
				?>
				</select>			
				<label for="outlet"><?php echo lang('outlet');?></label>
				<?php
				$data	= array('name'=>'outlet', 'value'=>set_value('outlet', $outlet), 'class'=>'span12');
				echo form_input($data);
				?>
				
				<label for="address"><?php echo lang('address');?></label>
				<?php
				$data	= array('name'=>'address','value'=>set_value('address', $address), 'class'=>'span12');
				echo form_textarea($data);
				?>
				
				<label for="contact"><?php echo lang('contact');?></label>
				<?php
				$data	= array('name'=>'contact' ,'value'=>set_value('contact', $contact), 'class'=>'span12');
				echo form_input($data);
				?>																
			
				<label for="status"><?php echo lang('status');?> </label>
				<?php
			 	$options = array(	 'Enable'		=> lang('enable')
									,'Disable'		=> lang('disable')
									);
				echo form_dropdown('status', $options, set_value('status',$status), 'class = "span12"');
				?>
			</fieldset>
		</div>

				
	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>	
</form>