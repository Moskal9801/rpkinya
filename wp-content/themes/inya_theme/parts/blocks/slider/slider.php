<?php

	/**
	 * Testimonial Block Template.
	 *
	 * @param   array $block The block settings and attributes.
	 * @param   string $content The block inner HTML (empty).
	 * @param   bool $is_preview True during AJAX preview.
	 * @param   (int|string) $post_id The post ID this block is saved to.
	 */

	// Create id attribute allowing for custom "anchor" value.
	$id = 'slider-' . $block['id'];
	if ( ! empty($block['anchor'] ) ) {
		$id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$classes = 'block-slider';
	if ( ! empty( $block['className'] ) ) {
		$classes .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$classes .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$slides = get_field('swiper-slider') ?: 'Добавьте изображения';

?>


<?php if ( $slides ) :  ?>
    <div class="swiper-acf-block-default--wrap">
        <div id="<?= esc_attr($id); ?>" class="swiper swiper-acf-block-default">
            <div class="swiper-wrapper">
				<?php foreach ( $slides as $slide ): ?>
                    <div class="swiper-slide">
                        <a href="<?= wp_get_attachment_url( $slide); ?>" data-fancybox="slider-<?= esc_attr($id); ?>">
							<?= wp_get_attachment_image( $slide, 'full', false ); ?>
                        </a>
                    </div>
				<?php endforeach; ?>
            </div>
            <div class="swiper-acf-block-default--navigation">
                <div class="slider-btn prev">
                    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="21" cy="21" r="21" transform="matrix(-1 0 0 1 42 0)" fill="#72BDBE"/>
                        <path d="M24 12L14.5401 21L24 30" stroke="#FFFFFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="slider-btn next">
                    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="21" cy="21" r="21" fill="#72BDBE"/>
                        <path d="M18 12L27.4599 21L18 30" stroke="#FFFFFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>