<?php
/**
 * The template for displaying all pages.
 * 
 * Template Name: All posts by Food
 *
 * @package Sela
 */

get_header(); ?>

          <?php while ( have_posts() ) : the_post(); ?>

               <?php get_template_part( 'content', 'hero' ); ?>

          <?php endwhile; ?>

          <?php rewind_posts(); ?>

          <div class="content-wrapper <?php echo sela_additional_class(); ?>">
               <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                         <?php
                         //for each category, show all posts
                         $cat_args=array(
                           'orderby' => 'name',
                           'order' => 'ASC'
                            );
                         $categories=get_categories($cat_args);
                           foreach($categories as $category) {
                             $args=array(
                               'showposts' => -1,
                               'category__in' => array($category->term_id),
                               'caller_get_posts'=>1
                             );
                           // if (strcmp(($category->name), "Dinners") == 0){}
                           // elseif (strcmp(($category->name), "Breakfasts") == 0){}
                           // elseif (strcmp(($category->name), "Snacks") == 0){}
                           // else {
                             $posts=get_posts($args);
                               if ($posts) {
                                 echo '<p><h2><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </h2></p> ';
                                 foreach($posts as $post) {
                                   setup_postdata($post); ?>
                                   <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php the_title(); ?></a></p>
                                   <?php
                                 } // foreach($posts
                               } // if ($posts
                             //}// if ($categories
                             } // foreach($categories
                         ?>
                    </main><!-- #main -->
               </div><!-- #primary -->
               <?php get_sidebar(); ?>
          </div><!-- .content-wrapper -->
<?php get_footer(); ?>