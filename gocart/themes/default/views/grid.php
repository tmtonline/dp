<style>
.image-item {
  width:  300px;
  height: 200px;
  float: left;
  border: 1px solid;
}

#basic .image-item.w2 { width: 20% }
#basic .image-item.w3 { width: 30% }
#basic .image-item.w4 { width: 40% }

#basic .image-item.h2 { height: 15% }
#basic .image-item.h3 { height: 20% }
#basic .image-item.h4 { height: 25% }
#basic .image-item.h5 { height: 30% }

#basic .grid-sizer { width: 20%; }
#basic .image-item { width: 20%; }

</style>

<div id="basic" class="image-grid-container">
    <div class="image-item"><img src="<?php echo theme_img('owl1.jpg')?>"/> </div>
    <div class="image-item h4"><img src="<?php echo theme_img('owl2.jpg')?>"/></div>
    <div class="image-item w2 h2"><img src="<?php echo theme_img('owl3.jpg')?>"/></div>
    <div class="image-item w2"><img src="<?php echo theme_img('owl4.jpg')?>"/></div>
    <div class="image-item h3"><img src="<?php echo theme_img('owl5.jpg')?>"/></div>
    <div class="image-item w3"><img src="<?php echo theme_img('owl6.jpg')?>"/></div>
    <div class="image-item"><img src="<?php echo theme_img('owl7.jpg')?>"/></div>
    <div class="image-item h4"><img src="<?php echo theme_img('owl8.jpg')?>"/></div>
    <div class="image-item"></div>
    <div class="image-item w2 h4"></div>
    <div class="image-item w2"></div>
    <div class="image-item h5"></div>
    <div class="image-item w3"></div>
    <div class="image-item"></div>
    <div class="image-item h4"></div>
    <div class="image-item"></div>
    <div class="image-item w2 h5"></div>
    <div class="image-item w2"></div>
    <div class="image-item h3"></div>
    <div class="image-item w3"></div>
    <div class="image-item"></div>
  </div>
  
