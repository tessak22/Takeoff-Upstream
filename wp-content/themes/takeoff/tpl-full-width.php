<?php
/**
 * Template Name: Full Width (no sidebar)
 *
 * @package Takeoff
 */

get_header(); ?>

<div class="document-header">
    <div class="container">
        <div class="row">
            <div class="page-title col-md-12">
                <h1 class="title"><?php the_field('hero_title'); ?></h1>
            </div>
        </div>
    </div>
</div>

<main class="site-main">
    <div class="container-fluid">
        <div class="row">
            <div class="content col-sm-12" role="main">
                <?php get_template_part('variant', 'before-content'); ?>

                <?php
                while (have_posts()) {
                    the_post();
                    get_template_part('content');
                }
                ?>

                <?php get_template_part('variant', 'after-content'); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>