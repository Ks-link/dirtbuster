<?php
/**
 * The template for displaying all single student posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main single-student-main">

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
            

            // log the title of the post so we can skip displaying it later on in the 'see other ...' section
            $postTitle = get_the_title();

            // output all other students in same taxonomy term category
            // code pulled from https://developer.wordpress.org/reference/functions/wp_get_post_terms/
            $terms = wp_get_post_terms( $post->ID, 'school-student-category',  array( 'fields' => 'all' ) ); 
            
            if (  $terms && ! is_wp_error( $terms ) ) :
                foreach ( $terms as $term ) :

                    ?>
                    <h2 class='other-students-text'>Meet the other <?php echo $term->name; ?> students:</h2>
                    <?php        

                    $args = array(
                        'post_type'      	=> 'school-student',
                        'posts_per_page' 	=> -1,
                        'orderby' 			=> 'title',
                        'order' 			=> 'ASC',
                        'tax_query' 		=> array(
                                array(
                                    'taxonomy' 	=> 'school-student-category',
                                    'field' 	=> 'slug',
                                    'terms' 	=> $term->slug,
                                ),
                            ),
                    );
                    $query = new WP_Query( $args );

                    while ( $query -> have_posts() ) :
                        
                        $query -> the_post();

                        // make sure not to output the current student
                        if ( get_the_title() !== $postTitle ) :
                            ?>
                            <a href="<?php the_permalink(); ?>">
                                <p><?php the_title(); ?></p>
                            </a>
                            <?php
                        endif;

                    endwhile;

                    wp_reset_postdata();

                endforeach;
            endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_footer();
