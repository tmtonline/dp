
<div class="row">
	<?php echo form_open($this->config->item('admin_folder').'/profile/' ); ?>
	<div class="span8">
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#product_info" data-toggle="tab"><?php echo lang('details');?></a></li>								
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane active" id="product_info">
				<div class="row">				
					<div class="span8">
						<?php
						$data	= array('placeholder'=>lang('title'), 'name'=>'title', 'value'=>set_value('title', $title), 'class'=>'span8');
						echo form_input($data);
						?>
					</div>
				</div>
				<div class="row">
					<div class="span8">
						
						<?php
						$data	= array('name'=>'content', 'class'=>'redactor', 'value'=>set_value('content', $content));
						echo form_textarea($data);
						?>
						
					</div>
				</div>
				
								
				<div class="row">
					<div class="span8">
						<fieldset>
							<legend><?php echo lang('header_information');?></legend>
							<div class="row" style="padding-top:10px;">
								<div class="span8">
																											
									<label for="seo_title"><?php echo lang('seo_title');?> </label>
									<?php
									$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'span8');
									echo form_input($data);
									?>

									<label for="meta"><?php echo lang('meta');?> <!--i><?php echo lang('meta_example');?></i--></label> 
									<?php
									$data	= array('name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'span8');
									echo form_textarea($data);
									?>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
			

		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
		</div>				
	</div>
	</form>
	
	<div class="span4">
			<div class="form-regist-container">
				<h4>Upload Logo</h4>
				
				<p>
				<a href="#" data-toggle="tooltip" data-placement="right" data-html="true" title="Company Logo">	
					<div id="output">
						<?php if(!empty($image)){?>
								<div class="step-by-inner-img2">										
									<img src="<?php echo base_url($image)?>" alt="Company Logo" class="company-logo" style="width:280px; height:180px;" />
								</div>											
						<?php }else{?>
								<div class="step-by-inner-img2">										
									<img src="<?php echo base_url('assets/img/no_picture.png')?>" alt="Company Logo" class="company-logo" style="width:280px; height:180px;" />
								</div>																					
						<?php }?>
					</div>
					
				</a>	
				</p>
				
				<p>
					Click below to upload a company logo.Choose a file from your computer:Upload JPEG or PNG files up to 2MB
				</p>
				<div class="upload">
				<?php echo form_open_multipart($this->config->item('admin_folder').'/profile/process_upload/'.$id,  'id="MyUploadForm"'); ?>
				
					<div class="form-group">
						<input name="FileInput" id="FileInput" type="file" />					
					</div>
					
					<div class="form-group">					
						<input type="submit"  id="submit-btn" value="Upload" />					
					</div>										
					<img src="<?php echo theme_img('ajax-loader.gif')?>" id="loading-img" style="display:none;" alt="Please Wait"/>
				</form>		
				</div>																
				<div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>	
														
			</div>	
		
	</div>
</div>


