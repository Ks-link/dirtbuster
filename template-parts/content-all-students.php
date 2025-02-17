<?php
    $args = array(
        'post_type' 		=> 'school-student',
        'posts_per_page' 	=> -1,
        'orderby' 			=> 'title',
        'order' 			=> 'ASC',
    );
    $query = New WP_Query( $args );
    if ( $query -> have_posts() ) :

        while ( $query->have_posts() ) :
            $query->the_post();
            
            ?>
            <article>
                <a href="<?php the_permalink(); ?>">
                    <!-- This is the student name -->
                    <h3><?php the_title(); ?></h3>
                </a>
                <?php the_post_thumbnail( '300x200' ); ?>
                <?php the_excerpt(); 

                // display the taxonomy term of the student
                the_terms( $post->ID, 'school-student-category', 'Specialty: ', ' / ' ); ?>

            </article>

            <?php
        endwhile;
        wp_reset_postdata();

    endif;
