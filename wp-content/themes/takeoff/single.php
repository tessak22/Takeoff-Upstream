<?php
/**
 * attachment
 * custom post type
 * blog post
 *
 * @package Takeoff
 */

// get the section title in case this is a blog post
$posts_section_title = takeoff_get_posts_section_title();

get_header(); ?>

<div class="document-header">
    <div class="container-fluid">
        <div class="row">
            <div class="page-title col-sm-10 col-sm-offset-1">
                <h1 class="title"><?php echo ($posts_section_title) ? $posts_section_title : get_the_title(); ?></h1>
            </div>
        </div>
    </div>
</div>

<main class="site-main">
    <div class="container">
        <div class="row">
            <div class="content col-sm-8 col-sm-offset-1" role="main">

                <?php
                    while (have_posts()) {
                        the_post();
                        get_template_part('content');
                    }
                ?>

                <?php if ('post' == get_post_type()) : ?>
                    <footer class="article-footer">
                        <?php get_template_part('nav', 'posts'); ?>
                    </footer>
                <?php endif; ?>

            </div>
            <?php get_sidebar('blog'); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
