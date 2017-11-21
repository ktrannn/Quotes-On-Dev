<?php
/**
 * Customize the post endpoint for WP API and add support for filter parameter back in.
 *
 * Endpoint: http://HOME_URL.COM/wp-json/wp/v2/posts?filter[orderby]=rand&filter[posts_per_page]=1
 *
 * @link https://github.com/WP-API/rest-filter
 */

/**
 * Add the necessary filter to each post type
 */
add_action( 'rest_api_init', function() {
  foreach ( get_post_types( array( 'show_in_rest' => true ), 'objects' ) as $post_type ) {
    add_filter( 'rest_' . $post_type->name . '_query', 'qod_rest_api_filter_add_filter_param', 10, 2 );
  }
});

/**
 * Add the filter parameter
 *
 * @param  array           $args    The query arguments.
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 */
function qod_rest_api_filter_add_filter_param( $args, $request ) {
  // Bail out if no filter parameter is set.
  if ( empty( $request['filter'] ) || ! is_array( $request['filter'] ) ) {
    return $args;
  }
  
  $filter = $request['filter'];
  
  if ( isset( $filter['posts_per_page'] ) && ( (int) $filter['posts_per_page'] >= 1 && (int) $filter['posts_per_page'] <= 100 ) ) {
    $args['posts_per_page'] = $filter['posts_per_page'];
  }
  
  global $wp;
  $vars = apply_filters( 'query_vars', $wp->public_query_vars );
  
  foreach ( $vars as $var ) {
    if ( isset( $filter[ $var ] ) ) {
      $args[ $var ] = $filter[ $var ];
    }
  }
  return $args;
}

/**
 * Add post status, source, and source URL fields to API request
 */
add_action( 'rest_api_init', function() {
  register_rest_field( 
    'post',
    'post_status',
    array(
      'get_callback'    => 'qod_get_post_status',
      'update_callback' => 'qod_update_post_status',
      'schema'          => null,
    )
  );
    
  register_rest_field( 
    'post',
    '_qod_quote_source',
    array(
      'get_callback'    => 'qod_get_quote_meta_fields',
      'update_callback' => 'qod_update_quote_meta_fields',
      'schema'          => null,
    )
  );
    
  register_rest_field( 
    'post',
    '_qod_quote_source_url',
    array(
      'get_callback'    => 'qod_get_quote_meta_fields',
      'update_callback' => 'qod_update_quote_meta_fields',
      'schema'          => null,
    )
  );
});
      
/**
 * Handler for fetching the post status.
 *
 * @param array           $object     Details of current post.
 * @param string          $field_name Name of field to add to response.
 * @param WP_REST_Request $request    Current request.
 *
 * @return mixed
 */
function qod_get_post_status( $object, $field_name, $request ) {
  $post = get_post( $object['id'] );
  return $post->post_status;
}
      
/**
 * Handler for updating post status.
 *
 * @since 0.1.0
 *
 * @param mixed  $value      The value of the field.
 * @param object $object     The object from the response.
 * @param string $field_name Name of field.
 *
 * @return bool|int
 */
function qod_update_post_status( $value, $object, $field_name ) {
  if ( ! $value || ! is_string( $value ) ) {
    return;
  }
  
  $post = get_post( $object->ID );
  $post->post_status = $value;
  return wp_update_post( $post );
}
      
/**
 * Handler for fetching post meta fields.
 *
 * @param array           $object     Details of current post.
 * @param string          $field_name Name of field to add to response.
 * @param WP_REST_Request $request    Current request.
 * 
 * @return mixed
 */
function qod_get_quote_meta_fields( $object, $field_name, $request ) {
  return get_post_meta( $object['id'], $field_name, true );
}
      
/**
 * Handler for updating custom field data.
 *
 * @since 0.1.0
 *
 * @param mixed  $value      The value of the field.
 * @param object $object     The object from the response.
 * @param string $field_name Name of field.
 *
 * @return bool|int
 */
function qod_update_quote_meta_fields( $value, $object, $field_name ) {
  if ( ! $value || ! is_string( $value ) ) {
    return;
  }
  
  return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
}
