<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPMazic_Auto_Internal_Links {

    const LITE_MAX_LINKS_PER_POST = 3;
    const LITE_MAX_RULES          = 5;

    public function __construct() {
        add_filter( 'the_content', array( $this, 'inject_auto_links' ), 30 );
    }

    private function get_rules() {
        $settings = wpmazic_seo_get_settings();
        $raw      = isset( $settings['auto_internal_link_rules'] ) ? $settings['auto_internal_link_rules'] : array();
        if ( ! is_array( $raw ) ) {
            return array();
        }

        return array_slice( $raw, 0, self::LITE_MAX_RULES );
    }

    public function inject_auto_links( $content ) {
        if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
            return $content;
        }

        $settings = wpmazic_seo_get_settings();
        if ( empty( $settings['enable_auto_internal_links'] ) ) {
            return $content;
        }

        $rules = $this->get_rules();
        if ( empty( $rules ) ) {
            return $content;
        }

        $post_id  = get_the_ID();
        $links    = 0;
        $inserted = array();

        // Avoid linking to self.
        $current_url = trailingslashit( get_permalink( $post_id ) );

        foreach ( $rules as $rule ) {
            if ( $links >= self::LITE_MAX_LINKS_PER_POST ) {
                break;
            }

            $keyword = isset( $rule['keyword'] ) ? trim( (string) $rule['keyword'] ) : '';
            $url     = isset( $rule['url'] ) ? trim( (string) $rule['url'] ) : '';
            if ( '' === $keyword || '' === $url ) {
                continue;
            }

            $url = esc_url_raw( $url );
            if ( '' === $url ) {
                continue;
            }

            if ( trailingslashit( $url ) === $current_url ) {
                continue;
            }

            // Skip if already linked.
            if ( preg_match( '/<a[^>]*href=["\']' . preg_quote( $url, '/' ) . '["\']/i', $content ) ) {
                continue;
            }

            // Replace first occurrence of keyword not inside an existing link.
            $pattern = '/\b' . preg_quote( $keyword, '/' ) . '\b(?!([^<]+)?>)/iu';
            $replacement = '<a href="' . esc_attr( $url ) . '" class="wpmazic-auto-link">$0</a>';

            $content = preg_replace( $pattern, $replacement, $content, 1, $replaced );

            if ( $replaced > 0 ) {
                $links++;
                $inserted[] = $keyword;
            }
        }

        return $content;
    }
}
