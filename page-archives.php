<?php
/**
 * The template for displaying archive pages.
 * Template Name: Page Archives
 * @package QOD_Starter_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <section class="browse-archives">
            <header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="post-archives clearfix">
                <h2>Quote Authors</h2>
                <ul>
					<?php
					$posts = get_posts( 'posts_per_page=-1' );
					foreach( $posts as $post ) : setup_postdata( $post );
						?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach; wp_reset_postdata(); ?>
                </ul>
            </div>

            <div class="category-archives clearfix">
                <h2>Categories</h2>
                <ul>
                    

					<?php wp_list_categories('title_li='); ?>
                    
                </ul>
            </div>

            <div class="tag-archives clearfix">
                <h2>Tags</h2>
				<?php wp_tag_cloud( array(
					'smallest' => 1,
					'largest' => 1,
					'unit' => 'rem',
					'format' => 'list'
				) ); ?>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
