<?php
namespace AIOSEO\Plugin\Addon\Redirects\Utils;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helpers for the WP urls.
 *
 * @since 1.2.3
 */
class WpUri {
	/**
	 * Returns a post url path without the home path.
	 *
	 * @since 1.2.3
	 *
	 * @param  string $postId The post id.
	 * @return string         The path without WP's home path.
	 */
	public static function getPostPath( $postId ) {
		return self::getUrlPath( get_permalink( $postId ) );
	}

	/**
	 * Returns an url path without the home path.
	 *
	 * @since 1.2.3
	 *
	 * @param  string $url The url.
	 * @return string      The path without WP's home path.
	 */
	public static function getUrlPath( $url ) {
		return self::excludeHomePath( wp_parse_url( $url, PHP_URL_PATH ) );
	}

	/**
	 * Exclude the home path from a full path.
	 *
	 * @since 1.2.3
	 *
	 * @param  string $path The original path.
	 * @return string       The path without WP's home path.
	 */
	public static function excludeHomePath( $path ) {
		return preg_replace( '@^' . self::getHomePath() . '@', '/', $path );
	}

	/**
	 * Exclude the home url from a full url.
	 *
	 * @since 1.2.3
	 *
	 * @param  string $url The original url.
	 * @return string      The url without WP's home url.
	 */
	public static function excludeHomeUrl( $url ) {
		$path = str_replace( self::getHomeUrl(), '', $url );

		return aioseo()->helpers->leadingSlashIt( $path );
	}

	/**
	 * The home path.
	 *
	 * @since 1.2.6
	 *
	 * @return string The WP's home path.
	 */
	public static function getHomePath() {
		$homePath = aioseo()->helpers->getHomePath();

		// Account for WPML lang in the home URL.
		if ( 'directory' === aioseo()->helpers->getWpmlUrlFormat() ) {
			$homePath = preg_replace( '@/[a-z]{2}(/|)$@', '', $homePath );
		}

		return untrailingslashit( $homePath ) . '/';
	}

	/**
	 * The home url.
	 *
	 * @since 1.2.6
	 *
	 * @return string The WP's home url.
	 */
	public static function getHomeUrl() {
		$homeUrl = get_home_url();

		// Account for WPML lang in the home URL.
		if ( 'directory' === aioseo()->helpers->getWpmlUrlFormat() ) {
			$homeUrl = preg_replace( '@/[a-z]{2}(/|)$@', '', $homeUrl );
		}

		return user_trailingslashit( $homeUrl );
	}

	/**
	 * Add the home url to a path.
	 *
	 * @since 1.2.6
	 *
	 * @param  string $path A path.
	 * @return string       The path with WP's home url.
	 */
	public static function addHomeUrl( $path ) {
		return untrailingslashit( self::getHomeUrl() ) . '/' . ltrim( $path, '/' );
	}

	/**
	 * Add the home path to a path.
	 *
	 * @since 1.2.8
	 *
	 * @param  string $path A path.
	 * @return string       The path with WP's home url.
	 */
	public static function addHomePath( $path ) {
		return untrailingslashit( self::getHomePath() ) . '/' . ltrim( $path, '/' );
	}
}