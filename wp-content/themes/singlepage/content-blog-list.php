<div id="main-content">
  <div class="page-main " role="main">
    <div class="container">
    <div class="breadcrumb-box">
    <?php singlepage_breadcrumbs(array("before"=>"","show_browse"=>false));?>
  </div>
      <div class="row">
        <div class="post-entry text-left right col-md-9">
          <div class="entry-main">
            <?php 
							
							if ( have_posts() ) :
							?>
            <div class="pageing">
              <?php while ( have_posts() ) : the_post(); 
					    get_template_part("content","article");
					 endwhile;
					 
 ?>
            </div>
            <?php endif;?>
          </div>
          
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
  
        </div>  
    <side class="left col-md-3">
    <?php get_sidebar("blog");?>
    </side>
    
      </div>
    </div>
  </div>
  
  <div class="clear"></div>
</div>