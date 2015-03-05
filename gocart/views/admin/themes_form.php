<?php echo form_open($this->config->item('admin_folder').'/themes/'); ?>

<div class="tabbable">
	
	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('themes');?></a></li>		
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
					
			<fieldset>
				<label for="date"><?php echo lang('theme_type');?>:</label>			
				
				<?php if(isset($themes)):?>
					<?php foreach($themes as $theme):?>												
						<input type="radio" name="theme" value="<?php echo $theme->themes ?>" <?php echo $current_theme['setting'] == $theme->themes ? 'checked' : '' ?>  ><img class="radio_img" src="<?php echo base_url('assets/img/'.$theme->theme_img);?>" alt="" width="200px;"/>
					<?php endforeach;?>				
				<?php endif;?>

			</fieldset>
		</div>

				
	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>
<input type="hidden" name="submit" value="submit">

</form>



	