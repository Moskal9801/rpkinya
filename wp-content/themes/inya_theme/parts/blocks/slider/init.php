<?php

// регистрация Guthenberg блока
function slider_register_blocks()
{

    // Проверяем, что функция доступна.
    if (function_exists('acf_register_block_type')) {

        // Регистрируем блок рекомендаций.
        acf_register_block_type(array(
            'name' => 'slider',
            'title' => __('Слайдер'),
            'description' => __('Swiper slider'),
            'icon' => 'format-gallery',
            'render_template' => '/parts/blocks/slider/slider.php',
            'enqueue_style' => get_template_directory_uri() . '/parts/blocks/slider/slider.css',
            'enqueue_script' => get_template_directory_uri() . '/parts/blocks/slider/slider.js',
            'category' => 'formatting',
            'mode' => 'edit'
        ));
    }
}

add_action('acf/init', 'slider_register_blocks');

if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_64c31e481c00d',
        'title' => 'Слайдер',
        'fields' => array(
            array(
                'key' => 'field_64c31e488f8fa',
                'label' => 'Слайдер',
                'name' => 'swiper-slider',
                'aria-label' => '',
                'type' => 'gallery',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'library' => 'all',
                'min' => '',
                'max' => '',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'insert' => 'append',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/slider',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));

endif;

