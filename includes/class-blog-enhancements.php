<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPMazic_Blog_Enhancements {

    public function __construct() {
        add_filter( 'the_content', array( $this, 'inject_reading_time' ), 15 );
        add_filter( 'the_content', array( $this, 'inject_author_box' ), 20 );
    }

    private function is_enabled( $key ) {
        $settings = wpmazic_seo_get_settings();
        return ! empty( $settings[ $key ] );
    }

    public function inject_reading_time( $content ) {
        if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
            return $content;
        }

        if ( ! $this->is_enabled( 'enable_reading_time' ) ) {
            return $content;
        }

        $word_count = str_word_count( wp_strip_all_tags( $content ) );
        $minutes    = max( 1, ceil( $word_count / 200 ) );
        $label      = sprintf(
            /* translators: %d: estimated reading minutes */
            _n( '%d min read', '%d min read', $minutes, 'wpmazic-seo-lite' ),
            $minutes
        );

        $badge = '<div class="wpmazic-reading-time">'
                . '<span class="dashicons dashicons-clock"></span> '
                . esc_html( $label )
                . '</div>';

        return $badge . $content;
    }

    public function inject_author_box( $content ) {
        if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
            return $content;
        }

        if ( ! $this->is_enabled( 'enable_author_box' ) ) {
            return $content;
        }

        $author_id = get_the_author_meta( 'ID' );
        if ( ! $author_id ) {
            return $content;
        }

        $avatar    = get_avatar( $author_id, 80 );
        $name      = esc_html( get_the_author() );
        $bio       = esc_html( get_the_author_meta( 'description' ) );
        $posts_url = esc_url( get_author_posts_url( $author_id ) );

        $box  = '<div class="wpmazic-author-box">';
        $box .= '<div class="wpmazic-author-box-avatar">' . $avatar . '</div>';
        $box .= '<div class="wpmazic-author-box-body">';
        $box .= '<p class="wpmazic-author-box-name"><a href="' . $posts_url . '">' . $name . '</a></p>';
        if ( '' !== $bio ) {
            $box .= '<p class="wpmazic-author-box-bio">' . $bio . '</p>';
        }
        $box .= '</div></div>';

        return $content . $box;
    }
}
