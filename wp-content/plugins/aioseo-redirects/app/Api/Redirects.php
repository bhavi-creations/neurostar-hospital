<?php
namespace AIOSEO\Plugin\Addon\Redirects\Api;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use AIOSEO\Plugin\Addon\Redirects\Main;
use AIOSEO\Plugin\Addon\Redirects\Models;
use AIOSEO\Plugin\Addon\Redirects\Utils;
use AIOSEO\Plugin\Common\Models as CommonModels;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Route class for the API.
 *
 * @since 1.0.0
 */
class Redirects {
	/**
	 * The search term we are using to lookup page or posts.
	 *
	 * @since 1.0.1
	 *
	 * @var string
	 */
	public static $searchTerm = '';

	/**
	 * Get the redirect options.
	 *
	 * @since 1.0.1
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function getOptions() {
		return new \WP_REST_Response( [
			'success'   => true,
			'options'   => aioseoRedirects()->options->all(),
			'importers' => aioseoRedirects()->importExport->plugins()
		], 200 );
	}

	/**
	 * Fetch redirects.
	 *
	 * @since 1.2.4
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function fetchRedirects( $request ) {
		$filter            = $request->get_param( 'filter' );
		$body              = $request->get_json_params();
		$id                = ! empty( $body['id'] ) ? intval( $body['id'] ) : null;
		$context           = ! empty( $body['context'] ) ? $body['context'] : 'post';
		$orderBy           = ! empty( $body['orderBy'] ) ? sanitize_text_field( $body['orderBy'] ) : 'id';
		$orderDir          = ! empty( $body['orderDir'] ) && ! empty( $body['orderBy'] ) ? strtoupper( sanitize_text_field( $body['orderDir'] ) ) : 'DESC';
		$limit             = ! empty( $body['limit'] ) ? intval( $body['limit'] ) : null;
		$offset            = ! empty( $body['offset'] ) ? intval( $body['offset'] ) : 0;
		$searchTerm        = ! empty( $body['searchTerm'] ) ? sanitize_text_field( $body['searchTerm'] ) : null;
		$additionalFilters = ! empty( $body['additionalFilters'] ) ? $body['additionalFilters'] : [];
		$rows              = [];

		// If we are in a post.
		if ( $id ) {
			$url       = 'term' === $context ? get_term_link( $id ) : get_permalink( $id );
			$rows = array_values( aioseoRedirects()->redirect->getRedirects( $url, 'all' ) );
			$total     = count( $rows );

			return new \WP_REST_Response( [
				'success' => true,
				'rows'    => $rows,
				'totals'  => [
					'total' => $total,
					'pages' => 0 === $total ? 1 : ceil( $total / $limit ),
					'page'  => 1
				],
				'filters' => Models\Redirect::getFilters( $filter )
			], 200 );
		}

		// If we are in the Redirects page.
		$orderBy = 'hits' === $orderBy ? '`rh`.`count`' : "`r`.`$orderBy`";
		$query   = aioseo()->core->db->start( 'aioseo_redirects as r' )
			->select( 'r.*, rh.count as hits' )
			->leftJoin( 'aioseo_redirects_hits as rh', 'r.id = rh.redirect_id' )
			->orderBy( "$orderBy $orderDir" )
			->limit( $limit, $offset );
		$totalQuery = aioseo()->core->db->noConflict()->start( 'aioseo_redirects as r' );

		if ( ! empty( $searchTerm ) ) {
			$query->whereRaw( self::getSearchWhere( $searchTerm ) );
			$totalQuery->whereRaw( self::getSearchWhere( $searchTerm ) );
		}

		if ( ! empty( $additionalFilters ) ) {
			$group = ! empty( $additionalFilters['group'] ) ? sanitize_text_field( $additionalFilters['group'] ) : null;
			if ( $group && 'all' !== $group ) {
				$query->where( 'group', $group );
				$totalQuery->where( 'group', $group );
			}
		}

		switch ( $filter ) {
			case 'all':
				$total     = $totalQuery->count();
				$rows = array_values(
					$query->run()
						->models( 'AIOSEO\\Plugin\\Addon\\Redirects\\Models\\Redirect', null, true )
				);
				break;
			case 'enabled':
				$total     = $totalQuery->where( 'enabled', 1 )->count();
				$rows = array_values(
					$query->where( 'enabled', 1 )
						->run()
						->models( 'AIOSEO\\Plugin\\Addon\\Redirects\\Models\\Redirect', null, true )
				);
				break;
			case 'disabled':
				$total     = $totalQuery->where( 'enabled', 0 )->count();
				$rows = array_values(
					$query->where( 'enabled', 0 )
						->run()
						->models( 'AIOSEO\\Plugin\\Addon\\Redirects\\Models\\Redirect', null, true )
				);
				break;
			default:
				return new \WP_REST_Response( [
					'success' => false
				], 404 );
		}

		return new \WP_REST_Response( [
			'success' => true,
			'rows'    => $rows,
			'totals'  => [
				'total' => $total,
				'pages' => 0 === $total ? 1 : ceil( $total / $limit ),
				'page'  => 1
			],
			'filters' => Models\Redirect::getFilters( $filter )
		], 200 );
	}

	/**
	 * Fetch redirects.
	 *
	 * @since 1.2.4
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function fetchLogs( $request ) {
		$slug       = $request->get_param( 'slug' );
		$body       = $request->get_json_params();
		$orderBy    = ! empty( $body['orderBy'] ) ? sanitize_text_field( $body['orderBy'] ) : 'last_accessed';
		$orderDir   = ! empty( $body['orderDir'] ) ? strtoupper( sanitize_text_field( $body['orderDir'] ) ) : 'DESC';
		$limit      = ! empty( $body['limit'] ) ? intval( $body['limit'] ) : null;
		$offset     = ! empty( $body['offset'] ) ? intval( $body['offset'] ) : 0;
		$searchTerm = ! empty( $body['searchTerm'] ) ? sanitize_text_field( $body['searchTerm'] ) : null;
		$logs       = [];

		$data = [
			'limit'    => $limit,
			'offset'   => $offset,
			'orderBy'  => $orderBy,
			'orderDir' => $orderDir
		];

		if ( '404' === $slug ) {
			$data['search'] = self::getSearch404LogsWhere( $searchTerm );
			$logs           = Models\Redirects404Log::getFiltered( $data );
		} else {
			$data['search'] = self::getSearchLogsWhere( $searchTerm );
			$logs           = Models\RedirectsLog::getFiltered( $data );
		}

		return new \WP_REST_Response( [
			'success' => true,
			'rows'    => $logs['results'],
			'totals'  => [
				'total' => $logs['total'],
				'pages' => 0 === $logs['total'] ? 1 : ceil( $logs['total'] / $limit ),
				'page'  => 1
			]
		], 200 );
	}

	/**
	 * Process bulk actions.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function bulk( $request ) {
		$action = $request['action'];
		$body   = $request->get_json_params();
		$rowIds = ! empty( $body['rowIds'] ) ? $body['rowIds'] : [];

		if ( empty( $rowIds ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		switch ( $action ) {
			case 'enable':
			case 'disable':
				aioseo()->core->db->update( 'aioseo_redirects' )
					->whereIn( 'id', array_values( $rowIds ) )
					->set(
						[
							'enabled' => 'enable' === $action ? 1 : 0
						]
					)
					->run();

				// Clear the redirects cache.
				aioseoRedirects()->cache->clearRedirects();
				break;
			case 'reset-hits':
				aioseo()->core->db->update( 'aioseo_redirects_hits' )
					->whereIn( 'redirect_id', $rowIds )
					->set( [ 'count' => 0 ] )
					->run();
				break;
		}

		aioseoRedirects()->server->rewrite();

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Get a where clause for the search term.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $searchTerm The search term.
	 * @return string             The search where clause.
	 */
	private static function getSearchWhere( $searchTerm ) {
		$searchTerm = esc_sql( $searchTerm );
		if ( ! $searchTerm ) {
			return '';
		}

		$where = '';
		if ( is_numeric( $searchTerm ) ) {
			$where .= '
				id = ' . (int) $searchTerm . ' OR
				type = ' . (int) $searchTerm . ' OR
			';
		}

		$where .= '
			source_url LIKE \'%' . $searchTerm . '%\' OR
			target_url LIKE \'%' . $searchTerm . '%\' OR
			source_url LIKE \'%' . str_replace( '%20', '-', $searchTerm ) . '%\' OR
			target_url LIKE \'%' . str_replace( '%20', '-', $searchTerm ) . '%\' OR
			source_url LIKE \'%' . str_replace( '%20', '+', $searchTerm ) . '%\' OR
			target_url LIKE \'%' . str_replace( '%20', '+', $searchTerm ) . '%\'
		';

		return $where;
	}

	/**
	 * Get a where clause for the search term.
	 *
	 * @since 1.2.2
	 *
	 * @param  string $searchTerm The search term.
	 * @return string             The search where clause.
	 */
	private static function getSearchLogsWhere( $searchTerm ) {
		$searchTerm = esc_sql( $searchTerm );
		if ( ! $searchTerm ) {
			return '';
		}

		$where = '';
		if ( is_numeric( $searchTerm ) ) {
			$where .= '
				http_code = ' . (int) $searchTerm . ' OR
			';
		}

		$where .= '
			url LIKE \'%' . $searchTerm . '%\' OR
			domain LIKE \'%' . $searchTerm . '%\' OR
			sent_to LIKE \'%' . $searchTerm . '%\' OR
			agent LIKE \'%' . $searchTerm . '%\' OR
			referrer LIKE \'%' . $searchTerm . '%\' OR
			ip LIKE \'%' . $searchTerm . '%\' OR
			url LIKE \'%' . str_replace( '%20', '-', $searchTerm ) . '%\' OR
			domain LIKE \'%' . str_replace( '%20', '-', $searchTerm ) . '%\' OR
			sent_to LIKE \'%' . str_replace( '%20', '-', $searchTerm ) . '%\' OR
			url LIKE \'%' . str_replace( '%20', '+', $searchTerm ) . '%\' OR
			domain LIKE \'%' . str_replace( '%20', '+', $searchTerm ) . '%\' OR
			sent_to LIKE \'%' . str_replace( '%20', '+', $searchTerm ) . '%\' 
		';

		return $where;
	}

	/**
	 * Get a where clause for the search term.
	 *
	 * @since 1.2.2
	 *
	 * @param  string $searchTerm The search term.
	 * @return string             The search where clause.
	 */
	private static function getSearch404LogsWhere( $searchTerm ) {
		$searchTerm = esc_sql( $searchTerm );
		if ( ! $searchTerm ) {
			return '';
		}

		$where = '';
		if ( is_numeric( $searchTerm ) ) {
			$where .= '
				http_code = ' . (int) $searchTerm . ' OR
			';
		}

		$where .= '
			url LIKE \'%' . $searchTerm . '%\' OR
			domain LIKE \'%' . $searchTerm . '%\' OR
			agent LIKE \'%' . $searchTerm . '%\' OR
			referrer LIKE \'%' . $searchTerm . '%\' OR
			ip LIKE \'%' . $searchTerm . '%\' OR
			url LIKE \'%' . str_replace( '%20', '-', $searchTerm ) . '%\' OR
			domain LIKE \'%' . str_replace( '%20', '-', $searchTerm ) . '%\' OR
			url LIKE \'%' . str_replace( '%20', '+', $searchTerm ) . '%\' OR
			domain LIKE \'%' . str_replace( '%20', '+', $searchTerm ) . '%\'
		';

		return $where;
	}

	/**
	 * Creates a redirect.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function create( $request ) {
		return self::createOrUpdate( $request );
	}

	/**
	 * Updates a redirect.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function update( $request ) {
		$redirectId = (int) $request['id'];
		if ( empty( $redirectId ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		return self::createOrUpdate( $request, $redirectId );
	}

	/**
	 * Create or update a redirect.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request $request    The REST request.
	 * @param  int|null         $redirectId The redirect ID.
	 * @return WP_REST_Response             The REST Response.
	 */
	private static function createOrUpdate( $request, $redirectId = null ) {
		$body                  = $request->get_json_params();
		$sourceUrls            = ! empty( $body['sourceUrls'] ) ? $body['sourceUrls'] : [];
		$targetUrl             = ! empty( $body['targetUrl'] ) ? esc_url_raw( $body['targetUrl'] ) : '';
		$defaultRedirectType   = json_decode( aioseoRedirects()->options->redirectDefaults->redirectType )->value;
		$redirectType          = isset( $body['redirectType'] ) ? (int) $body['redirectType'] : $defaultRedirectType;
		$redirectTypeHasTarget = isset( $body['redirectTypeHasTarget'] ) ? (bool) $body['redirectTypeHasTarget'] : true;
		$defaultQueryParam     = json_decode( aioseoRedirects()->options->redirectDefaults->queryParam )->value;
		$queryParam            = ! empty( $body['queryParam'] ) ? sanitize_text_field( $body['queryParam'] ) : $defaultQueryParam;
		$customRules           = ! empty( $body['customRules'] ) ? $body['customRules'] : null;
		$group                 = ! empty( $body['group'] ) ? sanitize_text_field( $body['group'] ) : 'manual';
		$postId                = ! empty( $body['postId'] ) && 0 < $body['postId'] ? (int) $body['postId'] : null;

		if ( empty( $sourceUrls ) || ( $redirectTypeHasTarget && empty( $targetUrl ) ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		// Sanitize custom rule values.
		if ( $customRules ) {
			foreach ( $customRules as $customRuleKey => &$customRule ) {
				if ( empty( $customRule['value'] ) ) {
					unset( $customRules[ $customRuleKey ] );
				}

				$customRule['value'] = is_array( $customRule['value'] ) ? array_map( 'trim', $customRule['value'] ) : trim( $customRule['value'] );
			}
		}

		$redirect = null;
		$failed   = [];
		foreach ( $sourceUrls as $sourceUrl ) {
			$regex = ! empty( $sourceUrl['regex'] );
			if ( ! $regex ) {
				$sourceUrl['url'] = Utils\Request::normalizeUrl( $sourceUrl['url'] );
			}

			$urlForDuplicates = ! empty( $customRules ) ? $sourceUrl['url'] . wp_json_encode( $customRules ) : $sourceUrl['url'];

			$redirect = empty( $redirectId )
				? Models\Redirect::getRedirectBySourceUrl( $urlForDuplicates )
				: aioseo()->core->db
					->start( 'aioseo_redirects' )
					->where( 'id', $redirectId )
					->run()
					->model( 'AIOSEO\\Plugin\\Addon\\Redirects\\Models\\Redirect' );

			if ( $redirectId ) {
				if ( ! $redirect->exists() ) {
					return new \WP_REST_Response( [
						'success' => false
					], 404 );
				}

				$duplicate = Models\Redirect::getRedirectBySourceUrl( $urlForDuplicates, $redirectId );
				if ( $duplicate->exists() ) {
					$failed[] = $sourceUrl['url'];
					continue;
				}
			}

			if ( ! $redirectId && $redirect->exists() ) {
				$failed[] = $sourceUrl['url'];
				continue;
			}

			$redirect->set( [
				'post_id'      => $postId,
				'source_url'   => $sourceUrl['url'],
				'target_url'   => $targetUrl,
				'type'         => $redirectType,
				'query_param'  => $queryParam,
				'custom_rules' => $customRules,
				'group'        => $group,
				'regex'        => $regex,
				'ignore_slash' => ! empty( $sourceUrl['ignoreSlash'] ) ? true : false,
				'ignore_case'  => ! empty( $sourceUrl['ignoreCase'] ) ? true : false
			] );

			$redirect->save();

			if ( ! $redirectId ) {
				// If this is a 404 redirect, let's delete the 404's that match.
				if ( '404' === $group ) {
					aioseo()->core->db
						->delete( 'aioseo_redirects_404_logs' )
						->where( 'url', $sourceUrl['url'] )
						->run();
				}
			}
		}

		aioseoRedirects()->server->rewrite();

		if ( ! empty( $failed ) || null === $redirect ) {
			return new \WP_REST_Response( [
				'success' => false,
				'failed'  => $failed
			], 409 );
		}

		return new \WP_REST_Response( [
			'success'  => true,
			'redirect' => $redirect
		], 200 );
	}

	/**
	 * Deletes a redirect.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function delete( $request ) {
		$redirectId = (int) $request['id'];
		if ( empty( $redirectId ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		aioseo()->core->db
			->delete( 'aioseo_redirects_hits' )
			->where( 'redirect_id', $redirectId )
			->run();

		$redirect = aioseo()->core->db
			->start( 'aioseo_redirects' )
			->where( 'id', $redirectId )
			->run()
			->model( 'AIOSEO\\Plugin\\Addon\\Redirects\\Models\\Redirect' );

		if ( $redirect->exists() ) {
			$redirect->delete();
		}

		aioseoRedirects()->server->rewrite();

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Tests a redirect.
	 *
	 * @since 1.1.4
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function test( $request ) {
		$redirectId = (int) $request['id'];
		$redirect   = Models\Redirect::getRedirectById( $redirectId );
		if ( empty( $redirectId ) || ! $redirect->exists() ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		$sourceUrl = $request['sourceUrl'] ?: $redirect->source_url;
		$sourceUrl = Utils\Request::formatSourceUrl( $sourceUrl );
		$response = wp_remote_get( $sourceUrl, [
			'redirection' => 0,
			'timeout'     => 10,
			'sslverify'   => false,
			'headers'     => [ 'X-AIOSEO-Redirect-Test' => true ]
		] );

		$errors       = [];
		$responseCode = wp_remote_retrieve_response_code( $response );
		if ( $responseCode !== $redirect->type ) {
			$errors[] = sprintf(
				// Translators: 1 - HTTP status code expected, 2 - HTTP status code received.
				__( 'Response code was not the same. Expected %1$s and received %2$s', 'aioseo-redirects' ),
				$redirect->type,
				$responseCode
			);
		}

		// Only test the target URL if we're expecting a redirect.
		$location  = '';
		$targetUrl = '';
		if ( 300 <= $redirect->type && 399 >= $redirect->type ) {
			// The header here is encoded. We need to decode it to match to the target.
			$location  = rawurldecode( wp_remote_retrieve_header( $response, 'location' ) );
			$targetUrl = Utils\Request::formatTargetUrl( $redirect->target_url );

			$locationParse  = wp_parse_url( $location );
			$targetUrlParse = wp_parse_url( rawurldecode( $targetUrl ) );
			$properties     = [
				'scheme',
				'host',
				'path'
			];

			$targetFailed = false;
			foreach ( $properties as $property ) {
				// This accounts for missing properties in the location.
				if ( ! empty( $targetUrlParse[ $property ] ) && empty( $locationParse[ $property ] ) ) {
					$targetFailed = true;
					break;
				}

				if ( $targetUrlParse[ $property ] !== $locationParse[ $property ] ) {
					$targetFailed = true;
					break;
				}
			}

			if ( $targetFailed ) {
				$errors[] = sprintf(
					// Translators: 1 - URL expected, 2 - URL found.
					__( 'Target url was not the same. Expected %1$s and found %2$s', 'aioseo-redirects' ),
					'<strong>' . Utils\Request::buildUrl( $targetUrlParse, [], [ 'query' ] ) . '</strong>',
					'<strong>' . Utils\Request::buildUrl( $locationParse, [], [ 'query' ] ) . '</strong>'
				);
			}
		}

		// Do the x-redirect-by test only if we're not using server level redirects with Apache.
		$xRedirectBy = '';
		if ( 'apache' !== aioseoRedirects()->server->getName() ) {
			$xRedirectBy = wp_remote_retrieve_header( $response, 'x-redirect-by' );
			if ( ! empty( $xRedirectBy ) && 'AIOSEO' !== $xRedirectBy ) {
				$errors[] = sprintf(
					// Translators: 1 - HTTP header 'x-redirect-by'.
					__( 'This redirect seems not to be done by AIOSEO. Expected header \'x-redirect-by\' to be \'AIOSEO\' but found \'%s\' instead', 'aioseo-redirects' ),
					$xRedirectBy
				);
			}
		}

		return new \WP_REST_Response( [
			'success'  => true,
			'errors'   => $errors,
			'redirect' => [
				'responseCode' => $responseCode,
				'sourceUrl'    => $sourceUrl,
				'targetUrl'    => $targetUrl,
				'location'     => $location,
				'xRedirectBy'  => $xRedirectBy
			]
		], 200 );
	}

	/**
	 * Deletes redirects in bulk.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function bulkDelete( $request ) {
		$body   = $request->get_json_params();
		$rowIds = ! empty( $body['rowIds'] ) ? $body['rowIds'] : [];

		if ( empty( $rowIds ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		aioseo()->core->db
			->delete( 'aioseo_redirects_hits' )
			->whereIn( 'redirect_id', $rowIds )
			->run();

		aioseo()->core->db
			->delete( 'aioseo_redirects' )
			->whereIn( 'id', $rowIds )
			->run();

		aioseoRedirects()->server->rewrite();

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Deletes a log entry.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function deleteLog( $request ) {
		$slug  = $request->get_param( 'slug' );
		$table = '404' === $slug ? 'aioseo_redirects_404_logs' : 'aioseo_redirects_logs';
		$body  = $request->get_json_params();
		$urls  = ! empty( $body['urls'] ) ? array_map( 'sanitize_url', $body['urls'] ) : [];
		if ( empty( $urls ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		aioseo()->core->db
			->delete( $table )
			->whereIn( 'url', $urls )
			->run();

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Exports server redirects.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function export( $request ) {
		$body   = $request->get_json_params();
		$groups = ! empty( $body['groups'] ) ? array_map( 'sanitize_text_field', $body['groups'] ) : [];
		$type   = ! empty( $body['type'] ) ? array_map( 'sanitize_text_field', $body['type'] ) : 'json';
		$type   = sanitize_text_field( $request['type'] );
		if ( empty( $groups ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		$redirects    = '';
		$allRedirects = aioseo()->core->db->start( 'aioseo_redirects' )
			->select( '`id`, `source_url`, `target_url`, `type`, `query_param`, `custom_rules`, `group`, `regex`, `ignore_slash`, `ignore_case`, `enabled`, `created`, `updated`' )
			->whereIn( '`group`', $groups )
			->run()
			->result();

		switch ( $type ) {
			case 'htaccess':
				$server = new Main\Server\Apache();
				foreach ( $allRedirects as $redirect ) {
					$redirects .= $server->format( $redirect ) . PHP_EOL;
				}
				break;
			case 'nginx':
				$server = new Main\Server\Nginx();
				foreach ( $allRedirects as $redirect ) {
					$redirects .= $server->format( $redirect ) . PHP_EOL;
				}
				break;
			case 'json':
			default:
				$redirects = $allRedirects;
				break;
		}

		return new \WP_REST_Response( [
			'success'   => true,
			'redirects' => $redirects
		], 200 );
	}

	/**
	 * Exports server redirects.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function exportServer( $request ) {
		$server     = null;
		$serverType = sanitize_text_field( $request['server'] );
		if ( 'apache' === $serverType ) {
			$server = new Main\Server\Apache();
		} elseif ( 'nginx' === $serverType ) {
			$server = new Main\Server\Nginx();
		}

		if ( empty( $server ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		return new \WP_REST_Response( [
			'success'   => true,
			'redirects' => $server->getConfigFileContent()
		], 200 );
	}

	/**
	 * Exports logs.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function exportLogs( $request ) {
		$type = sanitize_text_field( $request['type'] );
		if ( empty( $type ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		$tableName = '404' === $type ? 'aioseo_redirects_404_logs' : 'aioseo_redirects_logs';

		$allLogs = aioseo()->core->db->start( $tableName )
			->run()
			->result();

		$content = '404' === $type ? 'date,source,ip,referrer,useragent' : 'date,source,target,ip,referrer,useragent';
		$content = $content . PHP_EOL;
		foreach ( $allLogs as $log ) {
			if ( ! isset( $log->sent_to ) ) {
				$log->sent_to = null;
			}

			$data = [
				$log->created,
				$log->url,
				$log->sent_to,
				$log->ip,
				$log->referrer,
				$log->agent
			];

			$content .= implode( ',', $data ) . PHP_EOL;
		}

		return new \WP_REST_Response( [
			'success'   => true,
			'redirects' => $content
		], 200 );
	}

	/**
	 * Import settings from external file.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function import( $request ) {
		$file = $request->get_file_params()['file'];
		if (
			empty( $file['tmp_name'] ) ||
			empty( $file['type'] ) ||
			'application/json' !== $file['type']
		) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		$contents = aioseo()->core->fs->getContents( $file['tmp_name'] );

		// Since this could be any file, we need to pretend like every variable here is missing.
		$contents = json_decode( $contents, true );
		if ( empty( $contents ) || ! is_array( $contents ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		foreach ( $contents as $redirectData ) {
			$redirect = new Models\Redirect( $redirectData['id'] );

			if (
				empty( $redirectData['source_url'] ) ||
				empty( $redirectData['target_url'] )
			) {
				continue;
			}

			$redirect->set( $redirectData );
			$redirect->save();
		}

		$total = aioseo()->core->db->start( 'aioseo_redirects' )->count();
		$rows  = array_values(
			aioseo()->core->db->start( 'aioseo_redirects' )
				->orderBy( 'id DESC' )
				->limit( 20, 0 )
				->run()
				->models( 'AIOSEO\\Plugin\\Addon\\Redirects\\Models\\Redirect', null, true )
		);

		return new \WP_REST_Response( [
			'success' => true,
			'rows'    => $rows,
			'totals'  => [
				'total' => $total,
				'pages' => 0 === $total ? 1 : ceil( $total / 20 ),
				'page'  => 1
			],
			'filters' => Models\Redirect::getFilters( 'all' )
		], 200 );
	}

	/**
	 * Searches for posts by ID/name.
	 *
	 * @since 1.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function getPosts( $request ) {
		$body = $request->get_json_params();

		if ( empty( $body['query'] ) ) {
			return new \WP_REST_Response( [
				'success' => false,
				'message' => 'No search term was provided.'
			], 400 );
		}

		$args = [
			's'                => $body['query'],
			'numberposts'      => 20,
			'post_status'      => [ 'publish', 'draft', 'future', 'pending' ],
			'post_type'        => aioseo()->helpers->getPublicPostTypes( true ),
			'orderby'          => 'post_title',
			'suppress_filters' => false
		];

		if ( ! empty( $body['postId'] ) ) {
			$args['exclude'] = (int) $body['postId'];
		}

		if ( is_numeric( $body['query'] ) && (int) $body['query'] ) {
			unset( $args['s'] );
			$args['include'] = (int) $body['query'];
		}

		self::$searchTerm = $body['query'];
		add_filter( 'posts_search', [ get_called_class(), 'filterSearch' ] );
		$posts = get_posts( $args );
		remove_filter( 'posts_search', [ get_called_class(), 'filterSearch' ] );

		if ( empty( $posts ) ) {
			return new \WP_REST_Response( [
				'success' => true,
				'objects' => []
			], 200 );
		}

		$parsed = [];
		foreach ( $posts as $post ) {
			// We need to clone the post here so we can get a real permalink for the post even if it is not published already.
			$clonedPost              = clone $post;
			$clonedPost->post_status = 'publish';
			$clonedPost->post_name   = sanitize_title(
				$clonedPost->post_name ? $clonedPost->post_name : $clonedPost->post_title,
				$clonedPost->ID
			);

			$parsed[] = [
				'type'   => $post->post_type,
				'value'  => $post->ID,
				'label'  => $post->post_title,
				'link'   => get_permalink( $clonedPost ),
				'status' => $post->post_status
			];
		}

		return new \WP_REST_Response( [
			'success' => true,
			'objects' => $parsed
		], 200 );
	}

	/**
	 * Filter the where clause when searching for pages or posts.
	 *
	 * @since 1.0.1
	 *
	 * @param  string $search The where clause.
	 * @return string         The where clause.
	 */
	public static function filterSearch( $search ) {
		$column     = aioseo()->core->db->db->prefix . 'posts.post_name';
		$searchTerm = self::$searchTerm;
		$searchTerm = aioseo()->core->db->db->prepare( "/* %d = %d */ %%$searchTerm%%", 1, 1 );
		$searchTerm = str_replace( '/* 1 = 1 */ ', '', $searchTerm );

		return preg_replace( '/\)\)\)/', ") OR ($column LIKE '$searchTerm')))", $search );
	}

	/**
	 * Tests the server redirects.
	 *
	 * @since 1.1.4
	 *
	 * @return \WP_REST_Response The response.
	 */
	public static function serverTest() {
		$test          = aioseoRedirects()->server->test->runRedirectsTest();
		$notifications = CommonModels\Notification::getNotifications();

		return new \WP_REST_Response( [
			'success'       => $test,
			'notifications' => $notifications
		], 200 );
	}

	/**
	 * Get redirects related to a post_id.
	 *
	 * @since 1.1.7
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function getRedirects( $request ) {
		$id = ! empty( $request['id'] ) ? (int) $request['id'] : null;
		$context = ! empty( $request['context'] ) && in_array( $request['context'], [
			'post',
			'term'
		], true ) ? $request['context'] : 'post';

		if ( empty( $id ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 404 );
		}

		$url = 'term' === $context ? get_term_link( $id ) : get_permalink( $id );

		$redirects = array_values( aioseoRedirects()->redirect->getRedirects( $url, 'all' ) );

		if ( 'post' === $context && 'publish' !== get_post_status( $id ) ) {
			$redirect = aioseoRedirects()->redirect->getRedirectByPostId( $id );
			if ( $redirect->exists() ) {
				$redirects = [ $redirect ];
			}
		}

		return new \WP_REST_Response( [
			'success'       => true,
			'rows'          => $redirects ?: [],
			'permalinkPath' => Utils\WpUri::excludeHomeUrl( $url ),
			'postStatus'    => 'post' === $context ? get_post_status( $id ) : null
		], 200 );
	}

	/**
	 * Get manual redirects.
	 *
	 * @since 1.2.2
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function getManualRedirects( $request ) {
		$hash = $request->get_param( 'hash' );

		if ( empty( $hash ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 404 );
		}

		$manualRedirects = aioseoRedirects()->helpers->getManualRedirectUrls( $hash );

		return new \WP_REST_Response( [
			'success'   => true,
			'redirects' => $manualRedirects ?: [],
		], 200 );
	}
}