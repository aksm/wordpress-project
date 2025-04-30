<?php
/**
 * Bootstrap Basic theme
 * 
 * @package bootstrap-basic
 */


// Add Cooper Hewitt custom styles and scripts.
wp_enqueue_style( 
	'cooperhewitt-style-min',
	get_stylesheet_directory_uri() . '/assets/stylesheets/styles.min.css',
	array(),
	'1.1.21',
	'all'
);
wp_enqueue_style( 
	'cooperhewitt-style',
	get_stylesheet_directory_uri() . '/assets/stylesheets/styles.css',
	array(),
	'1.1.21',
	'all'
);

function cooperhewitt_scripts() {
  wp_enqueue_script( 'cooperhewitt-script-js', get_stylesheet_directory_uri() . '/assets/javascript/script.min.js', array( 'jquery' ), '1.1.21', true );
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
  $search_term = $request->get_param( 'q' );
  //$search_term = sanitize_text_field($_POST['q']);

  // Make API call
  $ch = curl_init();
  $api_key = SIOA_API_KEY;
  curl_setopt($ch, CURLOPT_URL, 'https://api.si.edu/openaccess/api/v1.0/search?api_key=' . $api_key . '&q=' . urlencode($search_term));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  // Parse response and format data
  $data = json_decode($response, true);
  $args = array(
          'json_data' => $data,
  );


  ob_start();
  include('search-advanced-results.php');
  header('Content-Type: text/html');
  echo ob_get_clean();
  exit();

  // ... (process data, potentially storing in a custom post type)

  // Return results as JSON
  //return wp_send_json( $data, 200 );
  //header('Content-Type: text/html');
  //echo '<div>Results here.</div>';
  //exit();
}

// Add block template support
add_action( 'after_setup_theme', function() {
  add_theme_support( 'block-templates' );
  add_theme_support( 'block-template-parts' );
} );

//add_action('admin_post_nopriv_get_api_data', 'search_external_api');
