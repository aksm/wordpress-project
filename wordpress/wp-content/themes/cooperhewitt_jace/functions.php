<?php
/**
 * Cooper Hewitt Jace theme
 * 
 */


function cooperhewitt_scripts() {
  wp_enqueue_script( 'cooperhewitt-script-js', get_stylesheet_directory_uri() . '/assets/javascript/searchform.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'cooperhewitt_scripts' );

/**
 * Endpoint for API.
 */

// Create a custom endpoint
add_action( 'rest_api_init', 'register_my_custom_api_route' );
function register_my_custom_api_route() {
  register_rest_route( 'ch/v1', '/search', array(
      'methods'   => 'GET',
      'callback'  => 'search_external_api',
      'permission_callback' => '__return_true'
  ) );
}

// Function to handle API request and return results
function search_external_api( $request ) {
  // Get search term from request
  $search_term = $request->get_param( 'q' ) ?? '';
  $sort = $request->get_param('sort') ?? 'relevancy';
  $rows = $request->get_param('rows') ?? 10;
  $start = $request->get_param('start') ?? 0;
  $base_rest_url = '/wp-json/ch/v1/search?q=' . $search_term;

  // Make API call
  $ch = curl_init();
  $api_key = SIOA_API_KEY;
  curl_setopt($ch, CURLOPT_URL, 'https://api.si.edu/openaccess/api/v1.0/search?api_key=' . $api_key . '&q=' . urlencode($search_term) . '&sort=' . urlencode($sort));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  if($response === false)
  {
    $error_message = curl_error($ch);
    $args = array(
      'error_message' => $error_message,
    );
    curl_close($ch);
  } else {
    curl_close($ch);
    // Parse response and format data
    $data = json_decode($response, true);
    $args = array(
      'json_data' => $data,
      'start' => $start,
      'base_rest_url' => $base_rest_url,
    );
  }

  ob_start();
  get_template_part('search-advanced-results', null, $args);
  header('Content-Type: text/html');
  echo ob_get_clean();
  exit();
}


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );
