<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$pro_url = wpmazic_seo_lite_pro_url();

wpmazic_seo_admin_shell_open(
    __( 'Pro Features', 'wpmazic-seo-lite' ),
    __( 'Compare feature availability between WPMazic SEO Lite and Pro.', 'wpmazic-seo-lite' )
);
?>

<div class="wmz-card">
    <div class="tw-text-center tw-mb-4">
        <h2><?php esc_html_e( 'WPMazic SEO Lite vs Pro', 'wpmazic-seo-lite' ); ?></h2>
        <p class="wmz-subtle"><?php esc_html_e( 'All core SEO features are available in Lite. Upgrade to Pro for unlimited access and premium tools.', 'wpmazic-seo-lite' ); ?></p>
    </div>

    <div class="wmz-table-wrap">
        <table class="wp-list-table widefat striped wmz-compare-table">
            <thead>
                <tr>
                    <th class="wmz-col-feature"><?php esc_html_e( 'Feature', 'wpmazic-seo-lite' ); ?></th>
                    <th class="wmz-col-lite" style="text-align:center;"><?php esc_html_e( 'Lite', 'wpmazic-seo-lite' ); ?></th>
                    <th class="wmz-col-pro" style="text-align:center;"><?php esc_html_e( 'Pro', 'wpmazic-seo-lite' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rows = array(
                    array( __( 'XML Sitemap', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Schema Markup (JSON-LD)', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Open Graph &amp; Twitter Cards', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Title &amp; Meta Description', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Focus Keyword', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Canonical URL &amp; Robots', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Redirect Manager', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( '404 Monitor', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Image SEO', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Breadcrumbs', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Image Sitemap', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'IndexNow', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Robots.txt &amp; llms.txt', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Webmaster Verification', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'GA4 Tracking', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Security Headers &amp; Bot Blocking', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Dynamic OG Image', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'Migration Wizard (10+ sources)', 'wpmazic-seo-lite' ), 'full', 'full' ),
                    array( __( 'SEO Content Score', 'wpmazic-seo-lite' ), __( 'Basic checks', 'wpmazic-seo-lite' ), __( 'Full analysis + readability', 'wpmazic-seo-lite' ) ),
                    array( __( 'Auto Internal Links', 'wpmazic-seo-lite' ), __( '3 links/post, 5 rules', 'wpmazic-seo-lite' ), __( 'Unlimited', 'wpmazic-seo-lite' ) ),
                    array( __( 'HTML Sitemap', 'wpmazic-seo-lite' ), __( '50 items max', 'wpmazic-seo-lite' ), __( 'Unlimited items + taxonomies', 'wpmazic-seo-lite' ) ),
                    array( __( 'Blog Enhancements', 'wpmazic-seo-lite' ), __( 'Basic styling', 'wpmazic-seo-lite' ), __( 'Customizable templates', 'wpmazic-seo-lite' ) ),
                    array( __( 'Search Engine Ping', 'wpmazic-seo-lite' ), __( 'New posts only', 'wpmazic-seo-lite' ), __( 'All post updates', 'wpmazic-seo-lite' ) ),
                    array( __( 'Term SEO (Categories/Tags)', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'Video Sitemap', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'News Sitemap', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'Hreflang Tags', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'URL Controls (HTTPS/www/Slash)', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'SEO Revisions + Rollback', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'WooCommerce SEO', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'SEO Audit (Broken Link Check)', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'AI Assistant &amp; AI Alt Text', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'Rank Tracker', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'Google Indexing API', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                    array( __( 'Email Reports', 'wpmazic-seo-lite' ), '<span style="color:#94a3b8;">—</span>', 'full' ),
                );

                $check_mark = '<span style="color:#16a34a;font-size:1.05rem;">&#10003;</span>';
                foreach ( $rows as $r ) :
                    $lite_cell = 'full' === $r[1] ? $check_mark : $r[1];
                    $pro_cell  = 'full' === $r[2] ? $check_mark : $r[2];
                ?>
                    <tr>
                        <td style="font-weight:500;"><?php echo wp_kses( $r[0], array() ); ?></td>
                        <td style="text-align:center;"><?php echo wp_kses( $lite_cell, array( 'span' => array( 'style' => array() ) ) ); ?></td>
                        <td style="text-align:center;"><?php echo wp_kses( $pro_cell, array( 'span' => array( 'style' => array() ) ) ); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="tw-text-center tw-mt-4">
        <a href="<?php echo esc_url( $pro_url ); ?>" target="_blank" rel="noopener noreferrer" class="button button-primary button-hero">
            <?php esc_html_e( 'View Pro Details', 'wpmazic-seo-lite' ); ?> &rarr;
        </a>
        <p class="wmz-help tw-mt-2"><?php esc_html_e( 'Upgrade at wpmazic.com — license covers unlimited sites.', 'wpmazic-seo-lite' ); ?></p>
    </div>
</div>

<?php
wpmazic_seo_admin_shell_close();
