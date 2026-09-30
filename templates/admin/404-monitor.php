<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching

global $wpdb;
$table_raw = wpmazic_seo_get_table_name( '404' );

if ( wpmazic_seo_lite_is_verified_admin_post( 'wpmazic_delete_404_id', 'wpmazic_delete_404' ) ) {
    $delete_id = (int) wpmazic_seo_lite_get_post_value( 'wpmazic_delete_404_id', 'absint', 0 );
    if ( $delete_id && '' !== $table_raw ) {
        $wpdb->delete( $table_raw, array( 'id' => $delete_id ), array( '%d' ) );
        wpmazic_seo_lite_add_notice( 'success', __( '404 entry deleted.', 'wpmazic-seo-lite' ) );
    }
}

if ( wpmazic_seo_lite_is_verified_admin_post( 'wpmazic_clear_404', 'wpmazic_clear_404' ) && wpmazic_seo_table_exists( '404' ) ) {
    $wpdb->query( $wpdb->prepare( 'TRUNCATE TABLE %i', $table_raw ) );
    wpmazic_seo_lite_add_notice( 'success', __( '404 log cleared.', 'wpmazic-seo-lite' ) );
}

$fetch_limit = 50;
$errors      = $wpdb->get_results(
    $wpdb->prepare(
        'SELECT * FROM %i ORDER BY last_hit DESC LIMIT %d',
        $table_raw,
        $fetch_limit
    )
);
$total_rows = wpmazic_seo_count_table_rows( '404' );

wpmazic_seo_admin_shell_open(
    __( '404 Monitor', 'wpmazic-seo-lite' ),
    __( 'Track broken URLs, identify crawl waste, and quickly clean problematic links.', 'wpmazic-seo-lite' )
);
?>

<div class="wmz-card">
    <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-between tw-gap-3">
        <h2 class="tw-mb-0"><?php esc_html_e( 'Tracked 404 URLs', 'wpmazic-seo-lite' ); ?></h2>
        <form method="post">
            <?php wp_nonce_field( 'wpmazic_clear_404' ); ?>
            <input type="hidden" name="wpmazic_clear_404" value="1">
            <button type="submit" class="button"><?php esc_html_e( 'Clear Log', 'wpmazic-seo-lite' ); ?></button>
        </form>
    </div>
    <p class="wmz-subtle tw-mt-3"><?php esc_html_e( 'Showing the latest 50 logged URLs. The full log remains stored until you clear it.', 'wpmazic-seo-lite' ); ?></p>
    <div class="wmz-table-wrap tw-mt-3">
        <table class="wp-list-table widefat striped">
            <thead>
                <tr>
                    <th class="wmz-col-url"><?php esc_html_e( 'URL', 'wpmazic-seo-lite' ); ?></th>
                    <th class="wmz-col-ref"><?php esc_html_e( 'Referer', 'wpmazic-seo-lite' ); ?></th>
                    <th class="wmz-col-hits"><?php esc_html_e( 'Hits', 'wpmazic-seo-lite' ); ?></th>
                    <th class="wmz-col-last"><?php esc_html_e( 'Last Hit', 'wpmazic-seo-lite' ); ?></th>
                    <th class="wmz-col-action"><?php esc_html_e( 'Action', 'wpmazic-seo-lite' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ( ! empty( $errors ) ) : ?>
                    <?php foreach ( $errors as $error ) : ?>
                        <tr>
                            <td><code><?php echo esc_html( $error->url ); ?></code></td>
                            <td><?php echo esc_html( $error->referer ); ?></td>
                            <td><?php echo esc_html( (string) $error->hits ); ?></td>
                            <td><?php echo esc_html( (string) $error->last_hit ); ?></td>
                            <td>
                                <form method="post" class="tw-inline">
                                    <?php wp_nonce_field( 'wpmazic_delete_404' ); ?>
                                    <input type="hidden" name="wpmazic_delete_404_id" value="<?php echo esc_attr( $error->id ); ?>">
                                    <button type="submit" class="button button-small"><?php esc_html_e( 'Delete', 'wpmazic-seo-lite' ); ?></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="5"><?php esc_html_e( 'No 404 errors recorded yet.', 'wpmazic-seo-lite' ); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php wpmazic_seo_admin_shell_close(); ?>
