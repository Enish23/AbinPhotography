<div id="footer">
        	<div id="footerwrap" class="container">
            <div class="row">
            <div class="footer-widgets">
            	<div class="footerwidgets col-md-3">
                	<?php dynamic_sidebar('footer-1');?>
                    </div>
                    
                    <div class="footerwidgets col-md-3">
                 <?php dynamic_sidebar('footer-2');?>
                    </div>
                    
                    <div class="footerwidgets col-md-3">
                    <?php dynamic_sidebar('footer-3');?>
                    </div>
                    
                    <div class="footerwidgets col-md-3">
                    	<?php dynamic_sidebar('footer-4');?>
                    </div>
                <div class="clear"></div>
                </div>
           
           <div class="footer-copyright">
                <div id="footer-navigation">
                	<ul>
                    <?php
					 $footer_social_icons = singlepage_option('footer_social_icons');
					 if(is_array($footer_social_icons)):
					   foreach($footer_social_icons as $item):
					   
						 $icon  = str_replace('fa-','',$item['icon']);
			  			 $icon  = str_replace('fa ','',$icon);
			 			 if( $icon !='' )
							echo '<li><a href="'.esc_url($item['link']).'" target="'.esc_attr($item['target']).'" data-toggle="tooltip" title="'.esc_attr($item['title']).'"><i class="fa fa-'.esc_attr(trim($icon)).'"></i></a></li>';
					  endforeach;
					endif;
					?>
                    </ul>
                </div>
                
                <div>
                	<span id="copyright"><?php echo do_shortcode(wp_kses_post(singlepage_option('copyright')));?> <?php printf(__('Designed by <a href="%s">HooThemes</a>.','singlepage'),esc_url('http://www.hoothemes.com/'));?></span>
                </div>
                </div>
                
                </div>
            </div><!--END footerwrap-->
            <div class="clear"></div>
        </div>
       <?php wp_footer();?>
</body>
</html>