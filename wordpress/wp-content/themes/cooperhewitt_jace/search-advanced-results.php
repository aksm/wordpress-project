<?php
/**
 * 
 * Template Name: Advanced Search Page
 * @package jace
 */

//get_header();
wp_head();
block_template_part('header');
?> 
<main class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)">
<div class="wp-block-group">
<?php

if (isset($args['error_message'])) {
  block_template_part('search-advanced-form-error');
}
$status = $args['json_data']['status'];
if ($status == 200) {
  $start = $args['start'];
  $start_offset = $start + 1;
  $results_per_page = 10;
  $row_count = $args['json_data']['response']['rowCount'];
  $last_page_start = $row_count - $results_per_page - 1;
  $base_rest_url = $args['base_rest_url'];
  $pages = ceil($row_count / $results_per_page);
  $json_data = $args['json_data']['response']['rows'];
  $row = 1;
  foreach($json_data as $item) {
    $json_item = json_encode($item, JSON_PRETTY_PRINT);
    echo '<div>'. $row . ': ' . $item['title'] . '</div>';
    $row++;
    //echo '<pre>' . $json_item .'</pre>';
  }
  echo '<a href="' . $base_rest_url . '&start=' . $start . '">1</a>|';
  for($i = 2;$i <= 10;$i++)
  {
     echo '<a href="' . $base_rest_url . '&start=' . $i * 10 - 1 . '">' . $i . '</a>';
     if($i != $pages)
     {
         echo "|";
     }
  }
  echo '<a href="' . $base_rest_url . '&start=' . $last_page_start . '">'.$pages.'</a>';
}

?>
                </div>
                </main>
<?php 
block_template_part('footer');
 ?> 
