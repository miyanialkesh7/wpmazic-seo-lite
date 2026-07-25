<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPMazic_SEO_Score {

    public function __construct() {
        add_action( 'wp_ajax_wpmazic_seo_score', array( $this, 'ajax_score' ) );
        // Run after metabox enqueue (priority 11) so the script handle is registered.
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_score_script' ), 11 );
    }

    public function enqueue_score_script( $hook ) {
        if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
            return;
        }

        global $post;
        if ( ! $post || ! in_array( $post->post_type, $this->get_post_types(), true ) ) {
            return;
        }

        // Enqueue the handle if the metabox hasn't done so yet.
        wp_enqueue_script( 'wpmazic-seo-lite-admin-script' );

        wp_localize_script(
            'wpmazic-seo-lite-admin-script',
            'wpmazicSeoScore',
            array(
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'wpmazic_seo_score_nonce' ),
                'postId'  => $post->ID,
                'labels'  => array(
                    'scoreGood'  => __( 'SEO Score: Good', 'wpmazic-seo-lite' ),
                    'scoreOk'    => __( 'SEO Score: Needs Improvement', 'wpmazic-seo-lite' ),
                    'scoreBad'   => __( 'SEO Score: Poor', 'wpmazic-seo-lite' ),
                ),
            )
        );

        // Inline JS: calculate score on page load and update the metabox badge.
        $inline = '
document.addEventListener("DOMContentLoaded", function () {
    var scoreEl = document.getElementById("wpmazic-seo-score");
    var titleEl = document.getElementById("wpmazic_title");
    var descEl  = document.getElementById("wpmazic_description");
    var kwEl    = document.getElementById("wpmazic_keyword");
    if (!scoreEl) return;

    function fetchScore() {
        var data = new URLSearchParams();
        data.set("action", "wpmazic_seo_score");
        data.set("nonce",  wpmazicSeoScore.nonce);
        data.set("post_id", wpmazicSeoScore.postId);
        data.set("title",  titleEl ? titleEl.value : "");
        data.set("description", descEl ? descEl.value : "");
        data.set("keyword",  kwEl ? kwEl.value : "");
        data.set("content",  window.wp && wp.data && wp.data.select("core/editor")
            ? wp.data.select("core/editor").getEditedPostContent()
            : document.querySelector("#content") && document.querySelector("#content").value || "");

        fetch(wpmazicSeoScore.ajaxUrl, { method: "POST", body: data, credentials: "same-origin" })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                if (!res.success) return;
                var s = res.data.score;
                scoreEl.className = "wpmazic-seo-score wpmazic-score-" + (s >= 70 ? "good" : s >= 40 ? "ok" : "bad");
                scoreEl.querySelector("#wpmazic-score-label").textContent =
                    s >= 70 ? wpmazicSeoScore.labels.scoreGood + " (" + s + "/100)"
                    : s >= 40 ? wpmazicSeoScore.labels.scoreOk + " (" + s + "/100)"
                    : wpmazicSeoScore.labels.scoreBad + " (" + s + "/100)";
            })["catch"](function () {});
    }

    fetchScore();
    if (titleEl) titleEl.addEventListener("input", fetchScore);
    if (descEl)  descEl.addEventListener("input", fetchScore);
    if (kwEl)    kwEl.addEventListener("input", fetchScore);
});
';
        wp_add_inline_script( 'wpmazic-seo-lite-admin-script', $inline );
    }

    private function get_post_types() {
        return array_values( get_post_types( array( 'public' => true ), 'names' ) );
    }

    public function ajax_score() {
        check_ajax_referer( 'wpmazic_seo_score_nonce', 'nonce' );

        $post_id = isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0;
        if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
            wp_send_json_error( array( 'message' => __( 'Invalid request.', 'wpmazic-seo-lite' ) ) );
        }

        $title       = isset( $_POST['title'] ) ? sanitize_text_field( wp_unslash( $_POST['title'] ) ) : '';
        $description = isset( $_POST['description'] ) ? sanitize_textarea_field( wp_unslash( $_POST['description'] ) ) : '';
        $keyword     = isset( $_POST['keyword'] ) ? sanitize_text_field( wp_unslash( $_POST['keyword'] ) ) : '';
        $content_raw = isset( $_POST['content'] ) ? wp_kses_post( wp_unslash( $_POST['content'] ) ) : '';

        $score  = 0;
        $checks = array();

        // --- Title checks (max 30 points) ---
        $title_len = mb_strlen( $title );
        if ( $title_len >= 40 && $title_len <= 60 ) {
            $score += 30;
            $checks[] = array( 'status' => 'good', 'message' => __( 'SEO title length is ideal (40–60 characters).', 'wpmazic-seo-lite' ) );
        } elseif ( $title_len > 0 ) {
            $score += 15;
            $checks[] = array( 'status' => 'warn', 'message' => __( 'SEO title should be 40–60 characters for best results.', 'wpmazic-seo-lite' ) );
        } else {
            $checks[] = array( 'status' => 'bad', 'message' => __( 'SEO title is empty.', 'wpmazic-seo-lite' ) );
        }

        // --- Description checks (max 25 points) ---
        $desc_len = mb_strlen( $description );
        if ( $desc_len >= 120 && $desc_len <= 160 ) {
            $score += 25;
            $checks[] = array( 'status' => 'good', 'message' => __( 'Meta description length is ideal (120–160 characters).', 'wpmazic-seo-lite' ) );
        } elseif ( $desc_len > 0 ) {
            $score += 12;
            $checks[] = array( 'status' => 'warn', 'message' => __( 'Meta description should be 120–160 characters.', 'wpmazic-seo-lite' ) );
        } else {
            $checks[] = array( 'status' => 'bad', 'message' => __( 'Meta description is empty.', 'wpmazic-seo-lite' ) );
        }

        // --- Keyword checks (max 25 points) ---
        $keyword_clean = trim( mb_strtolower( $keyword ) );
        $has_keyword   = '' !== $keyword_clean;
        $keyword_in_title       = $has_keyword && false !== mb_strpos( mb_strtolower( $title ), $keyword_clean );
        $keyword_in_description = $has_keyword && false !== mb_strpos( mb_strtolower( $description ), $keyword_clean );
        $keyword_in_content     = $has_keyword && false !== mb_strpos( mb_strtolower( $content_raw ), $keyword_clean );

        if ( $keyword_in_title && $keyword_in_content ) {
            $score += 25;
            $checks[] = array( 'status' => 'good', 'message' => __( 'Focus keyword appears in title and content.', 'wpmazic-seo-lite' ) );
        } elseif ( $keyword_in_title ) {
            $score += 15;
            $checks[] = array( 'status' => 'warn', 'message' => __( 'Focus keyword appears in title but not in content.', 'wpmazic-seo-lite' ) );
        } elseif ( $keyword_in_content ) {
            $score += 10;
            $checks[] = array( 'status' => 'warn', 'message' => __( 'Focus keyword appears in content but not in title.', 'wpmazic-seo-lite' ) );
        } elseif ( $has_keyword ) {
            $score += 5;
            $checks[] = array( 'status' => 'warn', 'message' => __( 'Focus keyword set but not found in title or content.', 'wpmazic-seo-lite' ) );
        } else {
            $checks[] = array( 'status' => 'warn', 'message' => __( 'Set a focus keyword to improve targeting.', 'wpmazic-seo-lite' ) );
        }

        // --- Content length (max 20 points) ---
        $word_count = str_word_count( wp_strip_all_tags( $content_raw ) );
        if ( $word_count >= 600 ) {
            $score += 20;
            $checks[] = array( 'status' => 'good', 'message' => __( 'Content length provides strong context (600+ words).', 'wpmazic-seo-lite' ) );
        } elseif ( $word_count >= 300 ) {
            $score += 10;
            $checks[] = array( 'status' => 'warn', 'message' => __( 'Content is adequate but 600+ words is recommended.', 'wpmazic-seo-lite' ) );
        } elseif ( $word_count > 0 ) {
            $score += 5;
            $checks[] = array( 'status' => 'bad', 'message' => __( 'Content is too short (aim for 600+ words).', 'wpmazic-seo-lite' ) );
        }

        $score = min( 100, max( 0, $score ) );

        wp_send_json_success(
            array(
                'score'  => $score,
                'checks' => $checks,
            )
        );
    }
}
