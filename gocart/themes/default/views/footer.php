



<div class="copyright navbar-fixed-bottom">
	<div class="row">
		<div class="col-xs-12 text-center">
			<span>&copy; copyright 2015 by <?php echo $this->config->item('company_name');?> | All right reserved.</span>
		</div>
	</div>
</div>	




<!--scripts-->



	<!--scripts-->
	
	<?php echo theme_js('jquery-1.10.2.min.js', true);?>
	<?php echo theme_js('jquery.easing.1.3.min.js', true);?>
	<?php echo theme_js('bootstrap.min.js', true);?>
	<?php echo theme_js('bootstrap-hover-dropdown.min.js', true);?>	 
	<script src="<?php echo theme_url('assets/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>		
	<?php echo theme_js('jquery.flexslider-min.js', true);?>
	<?php echo theme_js('jquery.mixitup.min.js', true);?>
	<?php echo theme_js('app.js', true);?>
	<?php echo theme_js('masonry.min.js', true);?>
	<?php echo theme_js('owl-carousel/owl.carousel.js', true);?>	
	
	<!-- Below is the modal new style with next and previous -->
	<?php echo theme_js('shadowbox.js', true);?>
	<?php echo theme_js('select.min.js', true);?>
	<?php echo theme_js('autosize.min.js', true);?>
	<?php echo theme_js('functions.js', true);?>
	<?php echo theme_js('enscroll.min.js', true);?>

	
	<?php echo theme_js('bootstrap-transition.js', true);?>
	
	<?php echo theme_js('bootstrap-tab.js', true);?>
	
	<?php echo theme_js('google-code-prettify/prettify.js', true);?>
	
	<?php echo theme_js('application.js', true);?>	
		
	
	<?php echo theme_js('jquery.rwdImageMaps.min.js', true);?>
		
	

    <!-- Demo -->

    <style>
    #owl-demo .item{
        margin: 3px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    
    /* laptops */
	@media (max-width: 1023px) and (min-width: 992px) {
	    #owl-demo .item img{
	        display: block;
	        width: 100%;
	        height: 150px;
	    }
	   
	}
	
	/* desktops */
	@media (min-width: 1024px) {
		  #owl-demo .item img{
		        display: block;
		        width: 100%;
		        height: 150px;
		  }  		    
	}
    
    </style>


    <script>
    
      $("#owl-demo").owlCarousel({
        items : 6,
        lazyLoad : true,        
      });
      
   	   //$('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
       //$('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});

       $('#list').click(function(){$('#products .item').addClass('list-group-item');});
  	   $('#grid').click(function(){$('#products .item').removeClass('list-group-item');});

  	   //Masonry for Thumbnails
       $(window).load(function(){
            $('.gallery-container').masonry({
                 columnWidth: 40,
                 itemSelector: '.gallery-thumb',
            });  
       });
    </script>
	<script>
		
			

		function centerModal() {
		    $(this).css('display', 'block');
		    var $dialog = $(this).find(".modal-dialog");
		    var offset = ($(window).height() - $dialog.height()) / 1;
		    // Center modal vertically in window
		    //$dialog.css("margin-top", offset);
		}

		$('.modal').on('show.bs.modal', centerModal);
		$(window).on("resize", function () {
		    $('.modal:visible').each(centerModal);
		});
		
	</script>
	
	  
	
	
         
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	

</body>
</html>