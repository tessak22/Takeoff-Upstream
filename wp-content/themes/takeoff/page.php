<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
    <div class="container">
        <div class="row">
            <div class="content col-sm-9" role="main">
            	<?php get_template_part('variant', 'before-content'); ?>

                <?php
                while (have_posts()) {
                    the_post();
                    get_template_part('content');
                }
                ?>

                <?php get_template_part('variant', 'after-content'); ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>