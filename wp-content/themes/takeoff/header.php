<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Takeoff
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<!-- Bootstrap CSS-->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- FontAwesome CSS -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<?php
/**
 * title element
 * if front page, display the blog name (usually the company name)
 * otherwise render the wp_title() and append the blog name
 */
?>
<title><?php is_front_page() ? bloginfo('name') : wp_title(' - ' . get_bloginfo('name'), true, 'right'); ?></title>
<?php
 /**
  * legacy IE responsive support
  * recommended by Bootstrap, legacy IE8 support for HTML5 elements and media queries
  */
?>
<!--[if lte IE 8]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv-printshiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="site-header" role="banner">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?php echo home_url(); ?>">
			<img class="img-responsive" src="">
		</a>
 		<?php
            wp_nav_menu( array(
                'menu'              => 'menu',
                'theme_location'    => 'menu',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
            );
        ?>
	</div>
</header>