<?php
namespace AIOSEO\Plugin\Addon\VideoSitemap\VideoSitemap;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles outputting the sitemap.
 *
 * @since 1.0.0
 */
class Output {
	/**
	 * Outputs the sitemap.
	 *
	 * @since 1.0.0
	 *
	 * @param  array The sitemap entries.
	 * @return void
	 */
	public function output( $entries ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		if ( 'video' !== aioseo()->sitemap->type ) {
			return;
		}

		$xslUrl     = add_query_arg( 'video-sitemap', aioseo()->sitemap->indexName, home_url() . '/video.xsl' );
		$charset    = aioseo()->helpers->getCharset();
		$generation = ! isset( aioseo()->sitemap->isStatic ) || aioseo()->sitemap->isStatic
			? __( 'statically', 'aioseo-video-sitemap' )
			: __( 'dynamically', 'aioseo-video-sitemap' );
		$version    = aioseo()->helpers->getAioseoVersion();

		if ( ! empty( $version ) ) {
			$version = 'v' . $version;
		}

		echo '<?xml version="1.0" encoding="' . esc_attr( $charset ) . "\"?>\r\n";
		echo '<!-- ' . sprintf(
			// Translators: 1 - "statically" or "dynamically", 2 - The date, 3 - The time, 4 - The plugin name ("All in One SEO"), 5 - Currently installed version.
			esc_html__( 'This sitemap was %1$s generated on %2$s at %3$s by %4$s a%5$s - the original SEO plugin for WordPress.', 'aioseo-video-sitemap' ),
			esc_html( $generation ),
			esc_html( date_i18n( get_option( 'date_format' ) ) ),
			esc_html( date_i18n( get_option( 'time_format' ) ) ),
			esc_html( AIOSEO_PLUGIN_NAME ),
			esc_html( $version )
		) . ' -->';

		echo "\r\n\r\n<?xml-stylesheet type=\"text/xsl\" href=\"" . esc_attr( $xslUrl ) . "\"?>\r\n";

		if ( aioseo()->options->sitemap->video->indexes && 'root' === aioseo()->sitemap->indexName ) {
			include AIOSEO_DIR . '/app/Common/Views/sitemap/xml/root.php';

			return;
		}

		include AIOSEO_VIDEO_SITEMAP_DIR . '/app/Views/xml/video.php';
	}
}