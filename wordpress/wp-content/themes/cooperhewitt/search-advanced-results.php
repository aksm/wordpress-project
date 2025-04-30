<?php
/**
 * 
 * Template Name: Advanced Search Page
 * @package bootstrap-basic
 */

get_header();
?> 
                <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
                    <main id="main" class="site-main" role="main">
<?php

$json_data =  $args['json_data']['response']['rows'];
foreach($json_data as $item) {
echo $item['title'];
}

?>
                    </main>
                </div>
<?php get_footer(); ?> 
