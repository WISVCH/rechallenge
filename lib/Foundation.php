<?php

namespace ReCHallenge;

require_once("Walkers/Menu.php");
require_once("Walkers/BannerBar.php");

/**
 * Foundation 6 compatibility class.
 *
 * @package ReCHallenge
 */
class Foundation
{
    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        // Replace default Menu Walker
        add_filter('wp_nav_menu_args', [__CLASS__, 'replace_walker']);

        // Add active class to menu
        add_filter('nav_menu_link_attributes', [__CLASS__, 'active_nav_class'], 20, 2);

        // Fix WP gallery
        add_filter('post_gallery', [__CLASS__, 'blockgrid_gallery'], 10, 3);

        // Prev / Next button attributes
        add_filter('previous_posts_link_attributes', [__CLASS__, 'prev_next_attributes']);
        add_filter('next_posts_link_attributes', [__CLASS__, 'prev_next_attributes']);

        // WP pagination
        add_filter('wp_link_pages_args', [__CLASS__, 'wp_link_pages_args']);
        add_filter('wp_link_pages_link', [__CLASS__, 'wp_link_pages_link'], 10, 2);
    }

    /**
     * Add active class to active menu item.
     *
     * @param $atts Link attributes.
     * @param $item Menu item.
     * @return array Updates link attributes.
     */
    static function active_nav_class($atts, $item)
    {

        if ($item->current === true || $item->current_item_ancestor === true) {
            $atts['class'] = 'is-active';
        }

        return $atts;
    }

    /**
     * Switch out default nav walker class with Foundation-compatible version.
     *
     * @param $args wp_nav_menu() defaults
     */
    static function replace_walker($args)
    {

        switch ($args['theme_location']) {
            case 'banner-bar':
                $args['walker'] = new Walkers\BannerBar();
                break;
            default:
                $args['walker'] = new Walkers\Menu();
                break;
        }

        return $args;
    }

    /**
     * Restructure WordPress gallery output to use block grid.
     * Credits: https://federicojacobi.com/foundation-6-block-grid-wordpress-gallery/
     *
     * @param $output
     * @param $atts
     * @param $instance
     * @return string
     */
    static function blockgrid_gallery($output, $atts, $instance)
    {
        $atts = shortcode_atts([
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
            'id' => get_the_ID(),
            'columns' => 3,
            'size' => 'thumbnail',
            'include' => '',
            'exclude' => '',
        ], $atts);

        if (! empty($atts['include'])) {
            $_attachments = get_posts([
                'include' => $atts['include'],
                'post_status' => 'inherit',
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'order' => $atts['order'],
                'orderby' => $atts['orderby'],
            ]);

            $attachments = [];
            foreach ($_attachments as $key => $val) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif (! empty($atts['exclude'])) {
            $attachments = get_children([
                'post_parent' => intval($atts['id']),
                'exclude' => $atts['exclude'],
                'post_status' => 'inherit',
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'order' => $atts['order'],
                'orderby' => $atts['orderby'],
            ]);
        } else {
            $attachments = get_children([
                'post_parent' => intval($atts['id']),
                'post_status' => 'inherit',
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'order' => $atts['order'],
                'orderby' => $atts['orderby'],
            ]);
        }

        if (empty($attachments)) {
            return '';
        }

        $output = '<div class="row inline-gallery small-up-2 medium-up-'.intval($atts['columns']).'" >';

        foreach ($attachments as $id => $attachment) {
            $img = wp_get_attachment_image_url($id, $atts['size']);
            $img_srcset = wp_get_attachment_image_srcset($id, $atts['size']);
            $img_full = wp_get_attachment_image_url($id, 'full');

            $caption = $attachment->post_excerpt ? ' alt="'.esc_attr($attachment->post_excerpt).'" ' : '';

            $output .= '<div class="column column-block">'.'<a href="'.esc_url($img_full).'" class="gallery-image">'.'<img src="'.esc_url($img).'" '.$caption.' class="th" srcset="'.esc_attr($img_srcset).'" sizes="(max-width: 50em) 87vw, 680px" />'.'</a></div>';
        }

        $output .= '</div>';

        return $output;
    }

    /**
     * Add button class to prev and next links.
     *
     * @param $atts
     * @return string
     */
    static function prev_next_attributes($atts)
    {
        return $atts.' class="button small secondary"';
    }

    /**
     * Override wp_link_pages() arguments.
     */
    static function wp_link_pages_args($args)
    {

        if ($args['before'] == '<p>'.__('Pages:') && $args['after'] == '</p>') {
            $args['before'] = '<ul class="pagination text-center medium-text-left" role="navigation" aria-label="Pagination">'.'<li class="disabled">Pages: </li>';
            $args['after'] = '</ul>';
        }

        return $args;
    }

    /**
     * Put wp_link_pages() links in a list item.
     */
    static function wp_link_pages_link($link, $i)
    {

        global $page, $numpages;

        $class = substr($link, 0, 2) !== '<a' ? ' class="current"' : '';
        $item = '<li'.$class.'>'.$link.'</li>';

        // Add prev / next arrows
        if ($i === 1) {

            if ($i === $page) {
                $prev = '&laquo;';
            } else {
                $prev = _wp_link_page($page - 1).'&laquo;</a>';
            }

            $item = '<li class="disabled adjacent"><a>'.$prev.'</a></li>'.$item;
        } elseif ($i === $numpages) {

            if ($i === $page) {
                $next = '&raquo;';
            } else {
                $next = _wp_link_page($page + 1).'&raquo;</a>';
            }

            $item = $item.'<li class="disabled adjacent"><a>'.$next.'</a></li>';
        }

        return $item;
    }
}
