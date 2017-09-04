<?php
/**
 * content output, list
 *
 * @package Takeoff
 */
?>

<article <?php post_class('list-article'); ?> id="post-<?php the_ID(); ?>">
    <header class="article-header">
        <h2><?php the_title(); ?></h2>
        <?php
        if ('post' == get_post_type()) {
            get_template_part('nav', 'article-meta');
        }
        ?>
    </header>
    <?php the_excerpt(); ?>
    <p class="call-to-action"><a href="<?php the_permalink(); ?>">Read More</a></p>
</article>
