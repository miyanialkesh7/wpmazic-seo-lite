<?php
/**
 * Uninstall cleanup for WPMazic SEO Lite.
 *
 * @package WPMazic_SEO_Lite
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.DirectDatabaseQuery.SchemaChange

/**
 * Remove plugin data for a single site.
 *
 * @return void
 */
function wpmazic_seo_lite_uninstall_site_data() {
	global $wpdb;

	delete_option( 'wpmazic_settings' );
	delete_option( 'wpmazic_db_version' );
	delete_option( 'wpmazic_show_migration_wizard' );
	delete_option( 'wpmazic_migration_wizard_completed' );
	delete_option( 'wpmazic_robots_txt' );
	delete_option( 'wpmazic_llms_txt' );
	delete_option( 'wpmazic_last_search_ping' );

	$postmeta_like = $wpdb->esc_like( '_wpmazic_' ) . '%';

	$wpdb->query(
		$wpdb->prepare(
			"DELETE FROM {$wpdb->options}
		WHERE option_name LIKE %s
		   OR option_name LIKE %s",
			$wpdb->esc_like( '_transient_wpmazic_' ) . '%',
			$wpdb->esc_like( '_transient_timeout_wpmazic_' ) . '%'
		)
	);

	foreach ( array( 'wpmazic_seo_redirects', 'wpmazic_seo_404', 'wpmazic_seo_links', 'wpmazic_seo_indexnow', 'wpmazic_redirects', 'wpmazic_404', 'wpmazic_links', 'wpmazic_indexnow' ) as $table_name ) {
		$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS %i', $wpdb->prefix . $table_name ) );
	}

	$wpdb->query(
		$wpdb->prepare(
			"DELETE FROM {$wpdb->postmeta} WHERE meta_key LIKE %s",
			$postmeta_like
		)
	);

	$wpdb->query(
		$wpdb->prepare(
			"DELETE FROM {$wpdb->usermeta} WHERE meta_key IN (%s, %s, %s)",
			'wpmazic_author_job_title',
			'wpmazic_author_expertise',
			'wpmazic_author_sameas'
		)
	);
}

if ( is_multisite() ) {
	$site_ids = get_sites(
		array(
			'fields' => 'ids',
			'number' => 0,
		)
	);

	foreach ( $site_ids as $site_id ) {
		switch_to_blog( (int) $site_id );
		wpmazic_seo_lite_uninstall_site_data();
		restore_current_blog();
	}
} else {
	wpmazic_seo_lite_uninstall_site_data();
}
