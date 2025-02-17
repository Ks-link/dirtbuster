<?php
/**
 * The template for displaying student taxonomy posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1><?php single_term_title( '<h1 class="page-title">', '</h1>' ); ?> Students</h1>
				<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
                ?>

                <article class='taxonomy-single-student'>
                    <a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
					<?php 
					the_post_thumbnail( '200x300' ); 
					the_content();
					?>
                </article>

                <?php
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #primary -->

<?php
get_footer();
