<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package QOD_Starter_Theme
 */

/**
 * Removes Comments from admin menu.
 */
function qod_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'qod_remove_admin_menus' );

/**
 * Removes comments support from Posts and Pages.
 */
function qod_remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
add_action( 'init', 'qod_remove_comment_support', 100 );

/**
 * Removes Comments from admin bar.
 */
function qod_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'qod_admin_bar_render' );

/**
 * Removes Comments-related metaboxes.
 */
 function qod_remove_comments_meta_boxes() {
	remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
	remove_meta_box( 'commentsdiv', 'post', 'normal' );
	remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
}
add_action( 'admin_init', 'qod_remove_comments_meta_boxes' );

//change placeholder title text in wp post admin
function qod_modify_post_title( $input ) {
    global $post_type;

    if( is_admin() && 'post' == $post_type ){
        return "Enter first and last name of quoted person here";
    }


    return $input;
}
add_filter('enter_title_here','qod_modify_post_title');


//filter post archive
function qod_modify_archives( $query ){

    if( (is_home() || is_single() ) && !is_admin() && $query->is_main_query() ) {
      $query->set( 'orderby','rand' );  
      $query->set( 'orderby','ASC' );
      $query->set( 'posts_per_page', 1 );
    }
    if( (is_archive()) && !is_admin() & $query->is_main_query() ){
        $query->set( 'posts_per_page', 5);
    }
}

add_action('pre_get_posts','qod_modify_archives');