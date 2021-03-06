<?php get_header(); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
        	<?php

			  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

			  echo'<h2>'.$term->name.' Videos</h2>';

			  $paged = 1;
			  if ( get_query_var('paged') ) $paged = get_query_var('paged');
			  if ( get_query_var('page') ) $paged = get_query_var('page');

	          $args = array(
			   'paged' => $paged,
			   'performer' => $term->slug	
	          );

	          $wp_query = new WP_Query($args); 

	          if ( $wp_query ->have_posts() ) {

	            $i=0; $postCount = 0; while (have_posts()) : the_post(); $i++; $postCount++;
	                if($i==1){echo'<!--start row--><div class="row">';} 
	                get_template_part( 'preview', get_post_format() );
	                
	                if($i==4 || $postCount == $wp_query->post_count){$i=0;echo'</div><!--/ row-->';}
	            endwhile;

	          }

            if ( function_exists( 'wp_paginate' ) ) : wp_paginate();  else : ?>
            <ul class="pager">
              <li class="previous">
              <?php previous_posts_link() ?>
              </li>
              <li class="next">
              <?php next_posts_link() ?>
              </li>
            </ul>
            <?php endif; 	          

	          wp_reset_postdata(); 

	          ?>

        </div><!-- .col-md-12 -->
    
      </div><!-- .row -->
      <?php get_sidebar(); ?>
    </div><!-- .container -->
    <?php get_footer(); ?>  