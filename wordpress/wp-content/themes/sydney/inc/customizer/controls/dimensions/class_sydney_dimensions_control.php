<?php
/**
 * Dimensions control
 *
 * @package Sydney
 */

class Sydney_Dimensions_Control extends WP_Customize_Control {
	public $type = 'sydney-dimensions-control';
    public $units = array();
    public $sides = array();
    public $link_values_toggle;
    public $is_responsive;

	/**
	 * Render the control in the customizer
	 */
	public function render_content(){
        $value = array(
            'desktop' => $this->value( 'desktop' ) ? json_decode( $this->value( 'desktop' ) ) : '',
            'tablet'  => $this->value( 'tablet' ) ? json_decode( $this->value( 'tablet' ) ) : '',
            'mobile'  => $this->value( 'mobile' ) ? json_decode( $this->value( 'mobile' ) ) : '',
        );

        // Responsive identifier
        $responsive = '';
		if ( !$this->is_responsive ) {
			$responsive = 'noresponsive';
		}
        
        ?>
		<div class="sydney-control-wrapper">
            <div class="sydney-dimensions-control">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if( !empty( $this->description ) ) { ?>
                    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php } ?>
                <div class="sydney-dimensions-wrapper">
                    <div class="sydney-dimensions-header">
                        <div class="sydney-dimensions-units responsive-control-desktop active" data-device-type="desktop">
                            <select class="sydney-dimensions-unit">
                            <?php foreach( $this->units as $unit ) : ?>
                                <option value="<?php echo esc_attr( $unit ); ?>" <?php selected( $unit, $value[ 'desktop' ]->unit, true ); ?>><?php echo esc_html( $unit ); ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if( $this->link_values_toggle ) : ?>
                            <div class="sydney-dimensions-link-values <?php echo ( $value[ 'desktop' ]->linked ? 'linked ' : '' ); ?>responsive-control-desktop active" data-device-type="desktop">
                                <button type="button" class="sydney-dimensions-link-btn" title="<?php esc_attr_e( 'Link values together', 'sydney' ); ?>">
                                    <i class="sydney-dimensions-icon sydney-dimensions-icon-link dashicons dashicons-admin-links"></i>
                                    <i class="sydney-dimensions-icon sydney-dimensions-icon-unlink dashicons dashicons-editor-unlink"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if ( $this->is_responsive ) : ?>
                            <div class="sydney-dimensions-units responsive-control-tablet" data-device-type="tablet">
                                <select class="sydney-dimensions-unit">
                                <?php foreach( $this->units as $unit ) : ?>
                                    <option value="<?php echo esc_attr( $unit ); ?>" <?php selected( $unit, $value[ 'tablet' ]->unit, true ); ?>><?php echo esc_html( $unit ); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if( $this->link_values_toggle ) : ?>
                                <div class="sydney-dimensions-link-values <?php echo ( $value[ 'tablet' ]->linked ? 'linked ' : '' ); ?>responsive-control-tablet" data-device-type="tablet">
                                    <button type="button" class="sydney-dimensions-link-btn" title="<?php esc_attr_e( 'Link values together', 'sydney' ); ?>">
                                        <i class="sydney-dimensions-icon sydney-dimensions-icon-link dashicons dashicons-admin-links"></i>
                                        <i class="sydney-dimensions-icon sydney-dimensions-icon-unlink dashicons dashicons-editor-unlink"></i>   
                                    </button>
                                </div>
                            <?php endif; ?>
                            <div class="sydney-dimensions-units responsive-control-mobile" data-device-type="mobile">
                                <select class="sydney-dimensions-unit">
                                <?php foreach( $this->units as $unit ) : ?>
                                    <option value="<?php echo esc_attr( $unit ); ?>" <?php selected( $unit, $value[ 'mobile' ]->unit, true ); ?>><?php echo esc_html( $unit ); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if( $this->link_values_toggle ) : ?>
                                <div class="sydney-dimensions-link-values <?php echo ( $value[ 'mobile' ]->linked ? 'linked ' : '' ); ?>responsive-control-mobile" data-device-type="mobile">
                                    <button type="button" class="sydney-dimensions-link-btn" title="<?php esc_attr_e( 'Link values together', 'sydney' ); ?>">
                                        <i class="sydney-dimensions-icon sydney-dimensions-icon-link dashicons dashicons-admin-links"></i>
                                        <i class="sydney-dimensions-icon sydney-dimensions-icon-unlink dashicons dashicons-editor-unlink"></i>    
                                    </button>
                                </div>
                            <?php endif; ?>
                            <ul class="sydney-devices-preview">
                                <li class="desktop"><button type="button" class="preview-desktop active" data-device="desktop"><i class="dashicons dashicons-desktop"></i></button></li>
                                <li class="tablet"><button type="button" class="preview-tablet" data-device="tablet"><i class="dashicons dashicons-tablet"></i></button></li>
                                <li class="mobile"><button type="button" class="preview-mobile" data-device="mobile"><i class="dashicons dashicons-smartphone"></i></button></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="sydney-dimensions-inputs responsive-control-desktop active" data-device-type="desktop">
                        <?php if( isset( $this->sides[ 'top' ] ) && $this->sides[ 'top' ] ) : ?>
                            <div class="sydney-dimensions-input-wrapper">
                                <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'desktop' ]->top ); ?>" data-side="top" class="sydney-dimensions-input" />
                                <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Top', 'sydney' ); ?></label>
                            </div>
                        <?php endif; ?>
                        <?php if( isset( $this->sides[ 'right' ] ) && $this->sides[ 'right' ] ) : ?>
                            <div class="sydney-dimensions-input-wrapper">
                                <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'desktop' ]->right ); ?>" data-side="right" class="sydney-dimensions-input" />
                                <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Right', 'sydney' ); ?></label>
                            </div>
                        <?php endif; ?>
                        <?php if( isset( $this->sides[ 'bottom' ] ) && $this->sides[ 'bottom' ] ) : ?>
                            <div class="sydney-dimensions-input-wrapper">
                                <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'desktop' ]->bottom ); ?>" data-side="bottom" class="sydney-dimensions-input" />
                                <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Bottom', 'sydney' ); ?></label>
                            </div>
                        <?php endif; ?>
                        <?php if( isset( $this->sides[ 'left' ] ) && $this->sides[ 'left' ] ) : ?>
                            <div class="sydney-dimensions-input-wrapper">
                                <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'desktop' ]->left ); ?>" data-side="left" class="sydney-dimensions-input" />
                                <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Left', 'sydney' ); ?></label>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link( 'desktop' ); ?> class="sydney-dimensions-value" />
                    </div>
                    <?php if( $this->is_responsive ) : ?>
                        <div class="sydney-dimensions-inputs responsive-control-tablet" data-device-type="tablet">
                            <?php if( isset( $this->sides[ 'top' ] ) && $this->sides[ 'top' ] ) : ?>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'tablet' ]->top ); ?>" data-side="top" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Top', 'sydney' ); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if( isset( $this->sides[ 'right' ] ) && $this->sides[ 'right' ] ) : ?>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'tablet' ]->right ); ?>" data-side="right" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Right', 'sydney' ); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if( isset( $this->sides[ 'bottom' ] ) && $this->sides[ 'bottom' ] ) : ?>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'tablet' ]->bottom ); ?>" data-side="bottom" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Bottom', 'sydney' ); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if( isset( $this->sides[ 'left' ] ) && $this->sides[ 'left' ] ) : ?>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'tablet' ]->left ); ?>" data-side="left" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Left', 'sydney' ); ?></label>
                                </div>
                            <?php endif; ?>
                            <input type="hidden" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link( 'tablet' ); ?> class="sydney-dimensions-value" />
                        </div>
                        <div class="sydney-dimensions-inputs responsive-control-mobile" data-device-type="mobile">
                            <?php if( isset( $this->sides[ 'top' ] ) && $this->sides[ 'top' ] ) : ?>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'mobile' ]->top ); ?>" data-side="top" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Top', 'sydney' ); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if( isset( $this->sides[ 'right' ] ) && $this->sides[ 'right' ] ) : ?>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'mobile' ]->right ); ?>" data-side="right" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Right', 'sydney' ); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if( isset( $this->sides[ 'bottom' ] ) && $this->sides[ 'bottom' ] ) : ?>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'mobile' ]->bottom ); ?>" data-side="bottom" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Bottom', 'sydney' ); ?></label>
                                </div>
                            <?php endif; ?>
                            <?php if( isset( $this->sides[ 'left' ] ) && $this->sides[ 'left' ] ) : ?>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="<?php echo esc_attr( $value[ 'mobile' ]->left ); ?>" data-side="left" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label"><?php echo esc_html__( 'Left', 'sydney' ); ?></label>
                                </div>
                            <?php endif; ?>
                            <input type="hidden" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link( 'mobile' ); ?> class="sydney-dimensions-value" />
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
	<?php
	}
}