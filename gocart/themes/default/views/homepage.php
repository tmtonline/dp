<div class="container">
<div class="row">
	<div class="col-sm-4 col-md-3 sidebar">
	    <div class="mini-submenu">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	    </div>
	    <div class="list-group">	        
	        <a href="<?php echo base_url() ?>" class="list-group-item">
	            <i class="fa fa-picture"></i> What's News <!--span class="badge">14</span-->
	        </a>	        
	    </div>        
	</div>
	
	<div class="col-sm-8">
				
                <div class="shadowed p-album">
	                <div class="gallery-container">
	                
	                <?php foreach($rs_gallery as $gallery):					
						$id_title = 'promotion_'.$gallery['id'].'_modal';
						$target = '#'.$id_title;
					?>															
						<article class="gallery-thumb">
                              <a href="<?php echo base_url('/uploads/gallery/full/'.$gallery['image']) ?>" data-rel="shadowbox[album]" class="img-popup" title="<?php echo $gallery['title']?>">
                                   <i class="icon-expand"></i>
                                   <img class="block thumbnail" src="<?php echo base_url('/uploads/gallery/small/'.$gallery['image']) ?>" alt="<?php echo $gallery['title']?>">                                   
                              </a>                                                            
                         </article>
                         
					<?php endforeach;?>		
	                
	                </div>
                </div>	
				<!--col-md-12-->
			
	</div>

</div>
</div>
	

			




