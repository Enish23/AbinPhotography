<?php
/**
* The page template file.
*
*/
   get_header(); 

?>

<div id="main-content">
  <div class="page-main " role="main">
    <div class="container">
      <div id="page-<?php the_ID(); ?>" <?php post_class("clear"); ?>>
        <div class="post-entry text-left right col-md-9">
          <?php 
							
							if ( have_posts() ) :
							 while ( have_posts() ) : the_post(); 
							   
							?>
          <div class="pageing">
            <?php get_template_part("content","article");?>
          </div>
          <?php endwhile; endif;?>
          <nav class="post-list-pagination" role="navigation">
		 <?php
                   the_posts_pagination( array(
                   'mid_size' => 3,
                      'prev_text' => '<i class="fa fa-angle-double-left"></i><span class="screen-reader-text">' . __( 'Previous page', 'singlepage' ) . '</span>',
                      'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'singlepage' ) . '</span><i class="fa fa-angle-double-right"></i>' ,
                      'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'singlepage' ) . ' </span>',
                  ) );
              
          ?>
      </nav>
          <div class="clear"></div>
        </div>
      </div>
      <side class="left col-md-3">
        <?php get_sidebar("blog");?>
      </side>
    </div>
  </div>
</div>
</div>
<?php get_footer(); ?>
