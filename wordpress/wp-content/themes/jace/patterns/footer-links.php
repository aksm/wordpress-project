<?php
/**
 * Title: Footer links
 * Slug: jace/footer-links
 * Inserter: no
 *
 * @package jace
 * @since 1.0.0
 */

?>
<!-- wp:group {"layout":{"type":"flex","allowOrientation":false,"justifyContent":"space-between"}} -->
<div class="wp-block-group">
<!-- wp:group {"layout":{"type":"flex","allowOrientation":false}} --><div class="wp-block-group">
<!-- wp:paragraph {"fontSize":"extra-small"} --><p class="has-extra-small-font-size"><?php echo __( 'Copyright', 'jace' ) . ' ' . date_i18n( _x( 'Y', 'copyright date format', 'jace' ) ); ?></p><!-- /wp:paragraph -->
<!-- wp:site-title {"level":0, "fontSize":"extra-small"} /-->
<?php
if ( get_the_privacy_policy_link() ) {
	echo '<!-- wp:paragraph {"fontSize":"extra-small"} --><p class="has-extra-small-font-size">' . get_the_privacy_policy_link() . '</p><!-- /wp:paragraph -->';
}
?>
<!-- wp:social-links {"iconColor":"primary","iconColorValue":"var(--wp--preset--color--primary)","className":"is-style-logos-only"} -->
<!-- /wp:social-links -->
</div><!-- /wp:group -->
<!-- wp:pattern {"slug":"jace/footer-buttons"} /-->
</div><!-- /wp:group -->
