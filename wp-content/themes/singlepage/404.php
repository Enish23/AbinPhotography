<?php
/**
 * The Template for displaying 404 Page not Found .
 *
 * @since singlepage 1.3.9
 */

   get_header(); 

?>

<div id="main-content">
  <div class="page-main " role="main">
    <div class="container">
      <div class="breadcrumb-box">
        <?php singlepage_breadcrumbs(array("before"=>"","show_browse"=>false));?>
      </div>
      <div class="blog-main text-center" role="main">
        <div class="row">
          <article class="post-entry text-left right col-md-9">
            <div class="entry-content">
              <?php 
										global $allowedposttags;
                                   
									$page_404_content = singlepage_option('page_404_content');
									
									echo  wp_kses( $page_404_content , $allowedposttags ); ;
									?>
            </div>
          </article>
          <side class="left col-md-3">
            <?php get_sidebar("blog");?>
          </side>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
