$(document).ready(function(){
    /* --------------------------------------------------------
        Bootstrap Components + Form Elements
    -----------------------------------------------------------*/
    (function(){
    	//Popover
    	$('.pover').popover();
    	
    	/* Tab */
        $('.tab a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    	
    	/* Collapse */
    	$('.collapse').collapse();
    	
    	/* Accordion */
    	$('.accordion .panel-heading .panel-title a').click(function(){
    	    $(this).toggleClass('active');
    	});
    	
    	/* Textarea */
        $('.auto-size').autosize();
    	
        /* Select */
        $('.select').selectpicker();
    	
    	/* Modal */
    	$('[data-dismiss="modal"]').on('click', function(){
    	    $(this).closest('.modal').modal('hide');
    	});
    })();
    
   
    /* --------------------------------------------------------
        Image Popup 
    -----------------------------------------------------------*/
    (function(){
        Shadowbox.init();
        $('.img-popup').prepend('<i class="icon-expand"></i>');
    })();
   
});   
