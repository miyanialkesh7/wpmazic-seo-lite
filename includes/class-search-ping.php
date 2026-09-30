<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPMazic_Search_Ping {

    public function __construct() {
        add_action( 'transition_post_status', array( $this, 'ping_on_publish' ), 10, 3 );
    }

    public function ping_on_publish( $new_status, $old_status, $post ) {
        if ( 'publish' !== $new_status ) {
            return;
        }
        if ( wp_is_post_revision( $post ) || wp_is_post_autosave( $post ) ) {
            return;
        }
        if ( 'post' !== $post->post_type && 'page' !== $post->post_type ) {
            return;
        }

        $settings = wpmazic_seo_get_settings();
        if ( empty( $settings['enable_search_ping'] ) ) {
            return;
        }

        // Lite: ping only for brand-new posts (not updates).
        if ( 'publish' === $old_status ) {
            return;
        }

        $sitemap_url = home_url( '/sitemap.xml' );

        $ping_urls = array(
            'google' => add_query_arg( 'sitemap', rawurlencode( $sitemap_url ), 'https://www.google.com/ping' ),
            'bing'   => add_query_arg( 'sitemap', rawurlencode( $sitemap_url ), 'https://www.bing.com/ping' ),
        );

        foreach ( $ping_urls as $engine => $url ) {
            wp_remote_get( esc_url_raw( $url ), array( 'timeout' => 5, 'blocking' => false ) );
        }

        update_option( 'wpmazic_last_search_ping', current_time( 'mysql' ) );
    }
}
