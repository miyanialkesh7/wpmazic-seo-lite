<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPMazic_HTML_Sitemap {

    const LITE_MAX_ITEMS = 50;

    public function __construct() {
        add_shortcode( 'wpmazic_html_sitemap', array( $this, 'render_shortcode' ) );
    }

    public function render_shortcode() {
        $settings = wpmazic_seo_get_settings();
        if ( empty( $settings['enable_html_sitemap'] ) ) {
            return '';
        }

        $post_types = get_post_types(
            array( 'public' => true ),
            'objects'
        );
        unset( $post_types['attachment'] );

        $html  = '<div class="wpmazic-html-sitemap" style="font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;">';
        $count = 0;
        $limit = self::LITE_MAX_ITEMS;

        foreach ( $post_types as $pt ) {
            if ( $count >= $limit ) {
                break;
            }

            $posts = get_posts(
                array(
                    'numberposts'      => $limit - $count,
                    'post_type'        => $pt->name,
                    'post_status'      => 'publish',
                    'orderby'          => 'title',
                    'order'            => 'ASC',
                    'suppress_filters' => true,
                )
            );

            if ( empty( $posts ) ) {
                continue;
            }

            $html .= '<section style="margin-bottom:1.5rem;">';
            $html .= '<h2 style="font-size:1.1rem;margin:0 0 0.5rem;color:#0f172a;">' . esc_html( $pt->labels->name ) . '</h2>';
            $html .= '<ul style="list-style:none;margin:0;padding:0;display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:0.35rem;">';

            foreach ( $posts as $p ) {
                $count++;
                $html .= '<li><a href="' . esc_url( get_permalink( $p->ID ) ) . '" style="text-decoration:none;font-size:0.88rem;color:#0369a1;display:block;padding:0.25rem 0;">'
                        . esc_html( $p->post_title ?: __( '(no title)', 'wpmazic-seo-lite' ) )
                        . '</a></li>';
            }

            $html .= '</ul></section>';
        }

        if ( $count >= $limit ) {
            $html .= '<p style="font-size:0.82rem;color:#64748b;border:1px solid #e2e8f0;background:#f8fafc;padding:0.6rem 0.78rem;border-radius:10px;">'
                    . sprintf(
                        /* translators: %d: max items shown */
                        __( 'Showing the first %1$d items.', 'wpmazic-seo-lite' ),
                        self::LITE_MAX_ITEMS
                    )
                    . '</p>';
        }

        $html .= '</div>';

        return $html;
    }
}
