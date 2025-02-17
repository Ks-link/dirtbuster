<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

        // Check if repeater field 'schedule' has rows of data
        if( have_rows('schedule') ): ?>
            <table>
                <caption>Weekly Course Schedule</caption>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Course</th>
                        <th>Instructor</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while( have_rows('schedule') ) : the_row();
                    // Load sub field values
                    $date = get_sub_field('date');
                    $course = get_sub_field('course');
                    $instructor = get_sub_field('instructor');
                    ?>
                    <tr>
                        <td><?php echo esc_html($date); ?></td>
                        <td><?php echo esc_html($course); ?></td>
                        <td><?php echo esc_html($instructor); ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php
        else :
            echo '<p>No schedule available.</p>';
        endif;
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
