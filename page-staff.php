<?php

/**
 * The template for displaying all staff posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main site-main-staff-page">

	<?php
	
	while ( have_posts() ) :
			
		the_post();
		get_template_part( 'template-parts/content', 'page' );

		$args = array(
			'post_type'      	=> 'school-staff',
			'posts_per_page' 	=> -1,
			'orderby' 			=> 'title',
			'order' 			=> 'ASC',
		);

		$query = new WP_Query($args);

		if ($query->have_posts()) :

			$terms = get_terms(
				array(
					'taxonomy' => 'school-staff-category',
				)
			);

			if ($terms && ! is_wp_error($terms)) :
				foreach ($terms as $term) :

					$args = array(
						'post_type'      	=> 'school-staff',
						'posts_per_page' 	=> -1,
						'orderby' 			=> 'title',
						'order' 			=> 'ASC',
						'tax_query' 		=> array(
							array(
								'taxonomy' 	=> 'school-staff-category',
								'field' 	=> 'slug',
								'terms' 	=> $term->slug,
							),
						),
					);
					$query = new WP_Query($args);

					?>
					<section class='staff-category-content'>
					<h2><?php echo esc_html($term->name); ?></h2>
					<?php

					while ($query->have_posts()) :
						$query->the_post();
						?>

						<section class='single-staff-content'>
						<h3 id='<?php esc_attr(the_id()) ?>'><?php the_title(); ?></h3>
						<?php
						//display ACF text area field
						if (function_exists('get_field')) :

							if (get_field('staff_biography')) :
							?>
								<p><?php the_field('staff_biography'); ?></p>
							<?php
							endif;

						endif;

						if (function_exists('get_field')) :

							if (get_field('courses')) :
							?>
								<p><?php the_field('courses'); ?></p>
							<?php
							endif;

						endif;

						if (function_exists('get_field')) :

							if (get_field('instructor_website')) :
							?>
								<p><a href=<?php the_field('instructor_website');?>>Instructor Website</p></a>
							<?php
							endif;

						endif;
						?>
						<!-- end single staff section -->
						</section> 
						<?php

					endwhile;
					?>
					<!-- end staff catefory section -->
					</section> 
					<?php

				endforeach;

			endif;

			wp_reset_postdata();
		endif;

	endwhile; // End of the loop.

	?>

</main><!-- #primary -->

<?php
get_footer();
