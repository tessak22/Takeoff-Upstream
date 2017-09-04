<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Takeoff
 */

if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
	return;
}
?>

<aside class="sidebar col-sm-3">	
	<?php dynamic_sidebar( 'sidebar-blog' ); ?>
</aside>
