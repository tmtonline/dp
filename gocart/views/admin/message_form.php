<?php echo form_open($this->config->item('admin_folder').'/messages/form/'.$id); ?>
	
		<label><?php echo lang('name'); ?> : <?php echo $name; ?> </label>				
		<label><?php echo lang('email_address');?> : <?php echo $email_address; ?></label>
		<label><?php echo lang('company_name');?> : <?php echo $company_name; ?></label>				
		<label><?php echo lang('telephone_number');?> : <?php echo $telephone_number; ?></label>
		<label><?php echo lang('facsimile_number');?> : <?php echo $facsimile_number; ?></label>		
		<label><?php echo lang('address');?> : <?php echo $address; ?></label>
		<label><?php echo lang('city');?> : <?php echo $city; ?></label>
		<label><?php echo lang('state');?> : <?php echo $state; ?></label>
		<label><?php echo lang('postcode');?> : <?php echo $postcode; ?></label>		
		<label><?php echo lang('country');?> : <?php echo $country->name; ?></label>
		<label><?php echo lang('comment');?> : <?php echo $comment; ?></label>
		
		
		<div class="form-actions">
			<a class="btn btn-info"  href="<?php echo site_url($this->config->item('admin_folder').'/messages'); ?>"/><?php echo lang('back_to_listing');?></a>
		</div>
	
		
		<!--div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
		</div-->
	
</form>
