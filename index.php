<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Skinetic
 */

get_header();
?>

<div class="entry-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area <?php skinetic_content_columns(); ?>">
				<main id="main" class="site-main <?php skinetic_blog_style(); ?>">

				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

				</main><!-- #main -->
				<?php skinetic_posts_navigation(); ?>
			</div><!-- #primary -->

			<?php get_sidebar(); ?>
		</div>
	</div>	
</div>

<?php
get_footer();