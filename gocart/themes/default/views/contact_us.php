<div class="container">
	<div class="text-center row">
		<h1>CONTACT US</h1>
	</div>
</div>


<div class="text-center row">
	<div class="container">		
		<div class="col-lg-6 col-md-6">
			<div>
				<strong>Thunder Match Technology Sdn. Bhd</strong><br> No 1, Jalan
				8/91 Taman Shamelin Perkasa<br> 56000, Cheras, Kuala Lumpur<br>
			</div>
			</br>

			<p>
				Email : <br> customerservice@thundermatch.com.my
			</p>
			<p>
				Customer Service Hotline : <br> 03 9282 0010
			</p>

		</div>

		<?php echo form_open('cart/contact_us'); ?>
			<div class="col-lg-6 col-md-6">		
				
				<?php if ($this->session->flashdata('message')):?>
				<div class="alert alert-success">
						<a class="close" data-dismiss="alert">X</a>
						<?php echo $this->session->flashdata('message');?>
					</div>
				<?php endif;?>
			
				<?php if ($this->session->flashdata('error')):?>
					<div class="alert alert-danger">
						<a class="close" data-dismiss="alert">X</a>
						<?php echo $this->session->flashdata('error');?>
					</div>
				<?php endif;?>
			
				<?php if (!empty($error)):?>
					<div class="alert alert-danger">
						<a class="close" data-dismiss="alert">X</a>
						<?php echo $error;?>
					</div>
				<?php endif;?>	
				
					<div class="col-lg-3 col-md-3">
						<label>Contact Name*:</label> 
					</div>
				
					<div class="col-lg-9 col-md-9">
						<input name="name" id="name" type="text" required class="form-control" value="<?php echo set_value('name')?>">
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Company name*:</label> 
					</div>
					
					<div class="col-lg-9 col-md-9">
						<input name="company_name" id="company_name" type="text" required class="form-control" value="<?php echo set_value('company_name')?>">
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Email address*:</label> 
					</div>
					
					<div class="col-lg-9 col-md-9">
						<input name="email_address" id="email_address" type="text" required class="form-control" value="<?php echo set_value('email_address')?>">
					</div>
				
					<div class="col-lg-3 col-md-3">
						<label>Telephone number*:</label> 
					</div>
					
					<div class="col-lg-9 col-md-9">
						<input name="telephone_number" id="telephone_number" type="text" required class="form-control" value="<?php echo set_value('telephone_number')?>">
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Facsimile number*:</label> 
					</div>
					
					<div class="col-lg-9 col-md-9">
						<input name="facsimile_number" id="facsimile_number" type="text" required class="form-control" value="<?php echo set_value('facsimile_number')?>">
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Address*:</label> 
					</div>
					
					<div class="col-lg-9 col-md-9">
						<input name="address" id="address" type="text" required class="form-control" value="<?php echo set_value('address')?>">
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Suburb/City*:</label> 
					</div>
					
					<div class="col-lg-9 col-md-9">
						<input name="city" id="city" type="text" required class="form-control" value="<?php echo set_value('city')?>">
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>State*:</label> 
					</div>
					
					<div class="col-lg-3 col-md-3">
						<input name="state" id="state" type="text" required class="form-control" value="<?php echo set_value('state')?>">
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Postcode*:</label> 
					</div>
					
					<div class="col-lg-3 col-md-3">
						<input name="postcode" id="postcode" type="text" required class="form-control" value="<?php echo set_value('postcode')?>">
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Country*:</label> 
					</div>
					
					<div class="col-lg-9 col-md-9">
						<select name="country" id='country' class="form-control">
								<option value="">Choose a Country</option>
								<?php foreach($countries as $country): ?>
								<option value="<?php echo $country->id ?>" <?php echo set_value('country') == $country->id ? 'selected' : ''?>>
									<?php echo $country->name ?>
								</option>
								<?php endforeach;?>
								
								
								
						</select>
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Please enter your enquiry details*:</label> 					
					</div>
					
					<div class="col-lg-9 col-md-9">
						<textarea name="comment" id="comment" class="form-control" required rows="6"><?php echo set_value('comment')?></textarea>					
					</div>
					
					<div class="col-lg-12 col-md-12" id="comment_text">
						<label>* Your comments regarding our website are also appreciated.</label> 
					</div>
					
					<div class="col-lg-3 col-md-3">
						<label>Security Code*:</label> 
					</div>
					
					<div class="col-lg-5 col-md-5">						
						<input name="security_code" id="security_code" type="text" required class="form-control" value="">					
					</div>
					
					<div class="col-lg-3 col-md-3">						
						<?php echo $captcha['image'] ?>					
					</div>
					
	
					<div class="col-sm-12 text-right">
						<button type="submit" class="btn btn-dark btn-lg">Send Message</button>
						<button type="reset" class="btn btn-dark btn-lg">Reset</button>
						<input type="hidden" value="submitted" name="submitted" />
					</div>
	
			</div>
		</form><!--Contact form-->
		
		
	</div>
</div>
