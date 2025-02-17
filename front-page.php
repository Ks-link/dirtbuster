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
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<section>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</section>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );?>
				<section class="home-work">
				  <h2><?php esc_html_e("Recent News",'school');?></h2>
					<div class="featured-work">
					<?php	
						$args = array(
							'post_type'      => 'post',
							'posts_per_page' => 4,
						);
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
								<article>
									<a href="<?php the_permalink()?>">
										<?php the_post_thumbnail('medium');?>
										<h3><?php the_title()?></h3>
									</a>
								</article>
						<?php
							}
							wp_reset_postdata();
						} 
					?>
				</div>
			</section>
			<?php
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
