<?php
/**
 * Takeoff functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Takeoff
 */

if ( ! function_exists( 'takeoff_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function takeoff_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Takeoff, use a find and replace
		 * to change 'takeoff' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'takeoff', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu' => esc_html__( 'Main Menu', 'takeoff' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'takeoff_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'takeoff_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function takeoff_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'takeoff_content_width', 640 );
}
add_action( 'after_setup_theme', 'takeoff_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function takeoff_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'takeoff' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'takeoff' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'takeoff' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here.', 'takeoff' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'takeoff_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function takeoff_scripts() {
	wp_enqueue_style( 'takeoff-style', get_stylesheet_uri() );

    wp_enqueue_style( 'takeoff-responsive', get_template_directory_uri() . '/css/style-responsive.css', array(), '1.0.0', true );

	wp_enqueue_script( 'takeoff-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'takeoff-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'takeoff_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/* Custom Functions for Takeoff theme */

// Register Custom Navigation Walker
require_once get_template_directory() . '/wp-bootstrap-navwalker.php';

/**
 * Determine if posts should use alternate title as the document title, e.g. "Blog" for a blog section
 *
 * @return string Title or empty string
 */
function takeoff_get_posts_section_title()
{
    $ret = '';
    if ('post' == get_post_type()) {
        $section_title = get_the_title(get_option('page_for_posts', true));
        if ('' != $section_title) {
            $ret = $section_title;
        }
    }
    return $ret;
}

// Hide the admin bar on front end
show_admin_bar( false );

// Custom MCE editor blockformats
add_filter('tiny_mce_before_init', 'takeoff_editor_items');
function takeoff_editor_items($init)
{
    // Add block format elements you want to show in dropdown
    $init['block_formats'] = 'Paragraph=p; Heading (h2)=h2; Sub-heading (h3)=h3';
    // Disable unnecessary items and buttons
    $init['toolbar1'] = 'bold,italic,alignleft,aligncenter,alignright,bullist,numlist,outdent,indent,link,unlink'; // 'template,|,bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv',
    $init['toolbar2'] = 'formatselect,pastetext,removeformat,charmap,undo,redo,wp_help,styleselect'; // 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
    // Display the kitchen sink by default
    $init['wordpress_adv_hidden'] = false;
    // [optional] Add elements not included in standard tinyMCE dropdown
    //$init['extended_valid_elements'] = 'code[*]';
    return $init;
}

// Add page id column to Admin views
add_action('admin_head', 'takeoff_admin_id_column_style');
function takeoff_admin_id_column_style()
{
    echo "
        <style>
            .fixed .column-pid { width: 10%; }
        </style>
    ";
}
add_action('admin_init', 'takeoff_admin_id_column');
function takeoff_admin_id_column()
{
    // page
    add_filter('manage_pages_columns', 'takeoff_pid_column');
    add_action('manage_pages_custom_column', 'takeoff_pid_value', 10, 2);
    // post
    add_filter('manage_posts_columns', 'takeoff_pid_column');
    add_action('manage_posts_custom_column', 'takeoff_pid_value', 10, 2);
    // users
    add_filter('manage_users_columns', 'takeoff_pid_column');
    add_action('manage_users_custom_column', 'takeoff_pid_return_value', 10, 3);
    // taxonomy
    foreach(get_taxonomies() as $tax) {
        add_action('manage_edit-' . $tax . '_columns', 'takeoff_pid_column');
        add_filter('manage_' . $tax . '_custom_column', 'takeoff_pid_return_value', 10, 3);
    }
}
function takeoff_pid_column($cols)
{
    $cols['pid'] = 'ID';
    return $cols;
}
function takeoff_pid_value($column, $id)
{
    if ($column == 'pid') {
        echo $id;
    }
}
function takeoff_pid_return_value($value, $column, $id)
{
    if($column == 'pid') {
        $value = $id;
    }
    return $value;
}

// Filter title for trademarks
// Replaces reg and tm with html superscript element and html chars
if (!is_admin()) {
    // does not filter in the admin area
    add_filter('the_title', 'takeoff_title_trademarks');
}
function takeoff_title_trademarks($title)
{
    $title = str_replace('&copy;', '<sup>&copy;</sup>', $title);
    $title = preg_replace('/\x{00A9}/u', '<sup>&copy;</sup>', $title);
    $title = str_replace('&reg;', '<sup>&reg;</sup>', $title);
    $title = preg_replace('/\x{00AE}/u', '<sup>&reg;</sup>', $title);
    $title = str_replace('&trade;', '<sup>&trade;</sup>', $title);
    $title = preg_replace('/\x{2122}/u', '<sup>&trade;</sup>', $title);
    $title = str_replace('&#8480;', '<sup>&#8480;</sup>', $title); // service mark
    $title = preg_replace('/\x{2120}/u', '<sup>&#8480;</sup>', $title); // service mark
    return $title;
}

// Filter body class
add_filter('body_class', 'takeoff_body_class');
function takeoff_body_class($classes)
{
    $root_parent = false;
    if (is_front_page()) {
        $root_parent = 'front-page';
    } elseif (is_home()) {
        $root_parent = 'home';
    } elseif (is_category()) {
        $root_parent = 'category';
    } elseif (is_tag()) {
        $root_parent = 'tag';
    } elseif (is_author()) {
        $root_parent = 'author';
    } elseif (is_day() || is_month() || is_year()) {
        $root_parent = 'date';
    } elseif (is_search()) {
        $root_parent = 'search';
    } elseif ('post' == get_post_type()) {
        $root_parent = 'post';
    } elseif ('page' == get_post_type()) {
        $root_parent = takeoff_get_the_root_parent();
    }
    if ($root_parent) {
        $classes[] = 'root-parent-' . $root_parent;
    }
    return $classes;
}

// Get the root parent
// @param int $id Post id
// @return int Post id of the root-most parent
function takeoff_get_the_root_parent($id = false)
{
    $root = 0;
    if (!$id) {
        global $post;
        $id = isset($post->ID) ? $post->ID : 0;
    }
    $ancestors = get_post_ancestors($id);
    if (!empty($ancestors)) {
        $root = end($ancestors);
    } else {
        $root = $id;
    }
    return $root;
}
function takeoff_the_root_parent($id = false)
{
    echo takeoff_get_the_root_parent($id);
}

// Nav child pages shortcode
// @param mixed $atts Array with optional string 'exclude' or optional string 'parent'
// @return string HTML output child nav
// Usage: [child_pages parent="25" exclude="58,74"] ... returns children of 25 excluding 58 and 74
add_shortcode('child_pages', 'takeoff_child_pages_shortcode');
function takeoff_child_pages_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        'exclude' => '',
        'parent' => get_the_ID(),
    ), $atts));
    $args = array(
        'exclude' => $exclude,
        'child_of' => $parent,
        'depth' => 1,
        'sort_column' => 'menu_order, title',
        'title_li' => '',
        'echo' => 0
    );
    $child_pages = wp_list_pages($args);
    return "\n<ul class='nav-child-pages-shortcode'>\n" . $child_pages . "</ul>\n\n" . do_shortcode($content);
}

// Bootstrap support for comments
add_filter('comment_form_default_fields', 'bootstrap3_comment_form_fields');
function bootstrap3_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req) ? " aria-required='true'" : '';
    $html5 = (current_theme_supports('html5', 'comment-form')) ? true : false;
    $rand = rand(1000, 9999); // for element ids
    $fields = array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author' . $rand . '">' . __('Name') . ($req ? ' <span class="required">*</span>' : '') . '</label> '
                    . '<input class="form-control" id="author' . $rand . '" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email' . $rand . '">' . __('Email') . ($req ? ' <span class="required">*</span>' : '') . '</label> '
                    . '<input class="form-control" id="email' . $rand . '" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email'])
                    . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url' . $rand . '">' . __('Website') . '</label> ' . '<input class="form-control" id="url' . $rand . '" name="url" '
                    . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div>',
    );
    return $fields;
}
add_filter('comment_form_defaults', 'bootstrap3_comment_form');
function bootstrap3_comment_form($args)
{
    $rand = rand(1000, 9999); // for element ids
    $args['comment_field'] = '<div class="form-group comment-form-comment">'
                           . '<label for="comment' . $rand . '">' . _x( 'Comment', 'noun' ) . '</label>'
                           . '<textarea class="form-control" id="comment' . $rand . '" name="comment" cols="45" rows="8" aria-required="true"></textarea>'
                           . '</div>';
    return $args;
}
add_action('comment_form', 'bootstrap3_comment_button');
function bootstrap3_comment_button()
{
    echo '<button class="btn btn-default" type="submit">' . __('Submit') . '</button>';
}

// Register custom mce styles: http://codex.wordpress.org/TinyMCE_Custom_Styles
add_filter('tiny_mce_before_init', 'add_style_formats');
function add_style_formats($init)
{
    $style_formats = array(
        array(
            'title' => 'Callout',
            'selector' => 'p',
            'classes' => 'callout',
        ),
        array(
            'title' => 'Footnote',
            'selector' => 'p',
            'classes' => 'footnote',
        ),
        array(
            'title' => 'Call-to-Action',
            'selector' => 'p',
            'classes' => 'call-to-action',
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init['style_formats'] = json_encode($style_formats);
    return $init;
}

// Custom mce editor styles
//add_action('init', 'do_add_editor_styles');
function do_add_editor_styles()
{
    add_editor_style('css/style-editor-01.css'); // cached, update revision as needed
}

// Custom Post Types
//add_action('init', 'wd_register_custom_post_types', 0);
function wd_register_custom_post_types()
{
    $arr_custom_post_type_options = array(
        /*
         array(
            'label' => 'lowercase_name' // ** 20 char max, no spaces or caps
            'singlar' => 'Human-Readable Item' // singular name
            'plural' => 'Human-Readable Items' // plural name
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats')
         ),
         */
        array(
            'label' => 'name',
            'singular' => 'Name',
            'plural' => 'Name',
            'supports' => array('title', 'custom-fields', 'page-attributes'),
            'icon' => 'dashicons-megaphone',
        ),
    );
    foreach ($arr_custom_post_type_options as $cpt_opts) {
        $label = $cpt_opts['label'];
        $labels = array(
            'name'                => $cpt_opts['plural'],
            'singular_name'       => $cpt_opts['singular'],
            'menu_name'           => $cpt_opts['plural'],
            'parent_item_colon'   => 'Parent:',
            'all_items'           => $cpt_opts['plural'],
            'view_item'           => 'View',
            'add_new_item'        => 'Add New',
            'add_new'             => 'Add New',
            'edit_item'           => 'Edit',
            'update_item'         => 'Update',
            'search_items'        => 'Search ' . $cpt_opts['plural'],
            'not_found'           => 'None found',
            'not_found_in_trash'  => 'None found in Trash',
        );
        $args = array(
            'label'               => $label,
            'description'         => 'Custom Post Type: ' . $cpt_opts['plural'],
            'labels'              => $labels,
            'supports'            => $cpt_opts['supports'],
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => true,
            'menu_position'       => 25.3,
            'menu_icon'           => $cpt_opts['icon'],
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => false,
            'capability_type'     => 'page',
        );
        register_post_type($label, $args);
    }
}

// Define page id constants
define('PAGE_NAME', 1);


