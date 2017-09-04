<?php
/**
 * Template Name: Display Children
 *
 * @package Takeoff
 */
$mypages = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => $post->ID,
    'nopaging' => true,
    'orderby' => 'menu_order title',
    'order' => 'asc'
));

?>

<?php while ($mypages->have_posts()) : $mypages->the_post(); ?>
    <div class="child-item row">
        <?php if (has_post_thumbnail()) : ?>
            <div class="col-md-3">
                <div class="circle">
                    <?php the_post_thumbnail('thumbnail'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-<?php echo (has_post_thumbnail()) ? '9' : '12'; ?>">
            <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
        </div>
    </div>
<?php endwhile; wp_reset_postdata(); ?>
