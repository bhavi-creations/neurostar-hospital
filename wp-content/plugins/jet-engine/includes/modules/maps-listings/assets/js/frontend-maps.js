( function( $ ) {

	"use strict";

	var mapProvider = new window.JetEngineMapsProvider();

	var JetEngineMaps = {

		markersData:    {},
		clusterersData: {},
		mapProvider: mapProvider,

		init: function() {

			var widgets = {
				'jet-engine-maps-listing.default' : JetEngineMaps.widgetMap,
			};

			$.each( widgets, function( widget, callback ) {
				window.elementorFrontend.hooks.addAction( 'frontend/element_ready/' + widget, callback );
			});

		},

		initBlocks: function( $scope ) {

			$scope = $scope || $( 'body' );

			window.JetPlugins.init( $scope, [
				{
					block: 'jet-engine/maps-listing',
					callback: JetEngineMaps.widgetMap
				}
			] );

		},

		initBricks: function( $scope ) {

			$scope = $scope || $( 'body' );

			JetEngineMaps.initBlocks( $scope );

		},

		commonInit: function() {
			// Register URL Action.
			if ( undefined === window.JetEngine ) {
				$( window ).on( 'jet-engine/frontend/loaded', JetEngineMaps.registerUrlAction );
			} else {
				JetEngineMaps.registerUrlAction();
			}
		},

		widgetMap: function( $scope ) {

			var $container = $scope.find( '.jet-map-listing' ),
				mapID = $scope.data( 'id' ),
				map,
				init,
				markers,
				bounds,
				general,
				gmMarkers = [],
				activeInfoWindow,
				width,
				offset,
				mapSettings,
				autoCenter,
				customCenter,
				markerCluster;

			if ( ! $container.length || $container.attr( 'id' ) ) {
				return;
			}

			$container.attr( 'id', 'map_' + mapID + '_' + Math.floor( Math.random() * Math.floor( 999 ) ) );

			var initMarker = function( markerData ) {
				var marker,
					infowindow,
					popup,
					popupOpenOn = undefined !== general.popupOpenOn ? general.popupOpenOn : 'click',
					pinData = {
						position: { lat: markerData.latLang.lat, lng: markerData.latLang.lng },
						map: map,
						shadow: false,
					};

				if ( markerData.custom_marker ) {
					pinData.content = markerData.custom_marker;
				} else if ( general.marker && 'image' === general.marker.type ) {
					pinData.content = '<img src="' + general.marker.url + '" class="jet-map-marker-image" alt="" style="cursor: pointer;">';
				} else if ( general.marker && 'text' === general.marker.type ) {
					pinData.content = general.marker.html.replace( '_marker_label_', markerData.label );
				} else if ( general.marker && 'icon' === general.marker.type ) {
					pinData.content = general.marker.html;
				}

				pinData.markerClustering = markerData.markerClustering;

				marker = mapProvider.addMarker( pinData );

				gmMarkers.push( marker );

				JetEngineMaps.addMarkerData( markerData.id, marker, mapID );

				if ( bounds && marker ) {
					bounds.extend( mapProvider.getMarkerPosition( marker ) );
				}

				infowindow = mapProvider.addPopup( {
					position: { lat: markerData.latLang.lat, lng: markerData.latLang.lng },
					width: width,
					offset: offset,
					map: map,
				} );

				mapProvider.closePopup( infowindow, function() {
					activeInfoWindow = false;
				} );

				mapProvider.openPopup( marker, function() {

					if ( infowindow.contentIsSet() ) {

						if ( activeInfoWindow === infowindow ) {
							return;
						}

						if ( activeInfoWindow ) {
							activeInfoWindow.close();
						}

						infowindow.setMap( map );
						infowindow.draw();
						infowindow.open( map, marker );

						activeInfoWindow = infowindow;

						return;

					} else if ( general.popupPreloader ) {

						if ( activeInfoWindow ) {
							activeInfoWindow.close();
							activeInfoWindow = false;
						}

						infowindow.setMap( map );
						infowindow.draw();

						infowindow.setContent( '<div class="jet-map-preloader is-active"><div class="jet-map-loader"></div></div>', false );

						infowindow.open( map, marker );

					}

					var querySeparator = general.querySeparator || '?';
					var api = general.api + querySeparator + 'listing_id=' + general.listingID + '&post_id=' + markerData.id + '&source=' + general.source;

					jQuery.ajax({
						url: api,
						type: 'GET',
						dataType: 'json',
						beforeSend: function( jqXHR ) {
							var nonce = window.JetEngineSettings ? window.JetEngineSettings.restNonce : general.restNonce;
							jqXHR.setRequestHeader( 'X-WP-Nonce', nonce );
						},
					}).done( function( response ) {

						if ( activeInfoWindow ) {
							activeInfoWindow.close();
						}

						infowindow.setMap( map );
						infowindow.draw();

						infowindow.setContent( response.html, false );

						infowindow.open( map, marker );

						activeInfoWindow = infowindow;

					}).fail( function( error ) {

						if ( activeInfoWindow ) {
							activeInfoWindow.close();
						}

						infowindow.setContent( error, true );
						infowindow.open( map, marker );

						activeInfoWindow = infowindow;

					});

				}, infowindow, map, popupOpenOn );

			};

			var setAutoCenter = function() {

				if ( ! bounds ) {
					return;
				}

				if ( bounds.isEmpty && bounds.isEmpty() ) {
					return;
				}

				mapProvider.setAutoCenter( {
					map: map,
					settings: general,
					bounds: bounds,
				} );

			};

			init       = $container.data( 'init' );
			markers    = $container.data( 'markers' );
			general    = $container.data( 'general' );
			autoCenter = general.autoCenter;

			if ( ! autoCenter ) {
				customCenter = general.customCenter;
			}

			mapSettings = {
				zoomControl: true,
				fullscreenControl: true,
				streetViewControl: true,
				mapTypeControl: true,
			};

			mapSettings = $.extend( {}, mapSettings, init );

			if ( ! autoCenter && customCenter ) {
				mapSettings.center = customCenter;
				mapSettings.zoom   = general.customZoom;
			}

			if ( general.maxZoom ) {
				mapSettings.maxZoom = general.maxZoom;
			}

			if ( general.styles ) {
				mapSettings.styles = general.styles;
			}

			if ( general.advanced ) {
				
				if ( general.advanced.zoom_control ) {
					mapSettings.gestureHandling = general.advanced.zoom_control;
				} else {
					mapSettings.scrollwheel = false;
				}

				if ( undefined !== general.advanced.scrollwheel ) {
					mapSettings.scrollwheel = general.advanced.scrollwheel;
				}

			}

			map    = mapProvider.initMap( $container[0], mapSettings );
			bounds = mapProvider.initBounds();
			width  = parseInt( general.width, 10 );
			offset = parseInt( general.offset, 10 );

			if ( markers ) {
				$.each( markers, function( index, markerData ) {
					markerData.markerClustering = general.markerClustering;
					initMarker( markerData );
				});
			}

			if ( autoCenter || ! customCenter ) {
				setAutoCenter();
			}

			if ( general.markerClustering ) {
				
				markerCluster = mapProvider.getMarkerCluster( {
					map: map,
					markers: gmMarkers,
					clustererImg: general.clustererImg
				} );

				JetEngineMaps.clusterersData[ mapID ] = markerCluster;
			}

			$scope.on( 'jet-filter-custom-content-render', function( event, response ) {

				if ( activeInfoWindow ) {
					activeInfoWindow.close();
				}

				if ( markerCluster ) {
					mapProvider.removeMarkers( markerCluster, gmMarkers );
				}

				gmMarkers.forEach( function( marker ) {
					mapProvider.removeMarker( marker );
				} );

				gmMarkers.splice( 0, gmMarkers.length );
				JetEngineMaps.restoreMarkerData();

				bounds = mapProvider.initBounds();

				if ( response.markers.length ) {

					for ( var i = 0; i < response.markers.length; i++ ) {
						let marker = response.markers[ i ];
						marker.markerClustering = general.markerClustering;
						initMarker( marker );
					}

					if ( markerCluster ) {
						mapProvider.addMarkers( markerCluster, gmMarkers );
					}

				}

				if ( autoCenter || ! customCenter ) {
					setAutoCenter();
				}

			} );

		},

		addMarkerData: function( id, marker, mapID ) {

			if ( ! this.markersData[id] ) {
				this.markersData[id] = [];
			}

			this.markersData[id].push( {
				marker: marker,
				clustererIndex: mapID
			} );
		},
		restoreMarkerData: function() {
			this.markersData = {};
		},

		registerUrlAction: function() {
			window.JetEngine.customUrlActions.addAction(
				'open_map_listing_popup',
				JetEngineMaps.openMapListingPopup
			);
		},

		openMapListingPopup: function( settings ) {

			if ( ! settings.id ) {
				return;
			}

			var popupID = settings.id;

			if ( undefined === JetEngineMaps.markersData[ popupID ] ) {
				return;
			}

			for ( var i = 0; i < JetEngineMaps.markersData[ popupID ].length; i++ ) {

				var marker = JetEngineMaps.markersData[ popupID ][i].marker,
					map = mapProvider.getMarkerMap( marker );

				if ( !map ) {
					// A marker inside a cluster
					var clustererIndex   = JetEngineMaps.markersData[ popupID ][i].clustererIndex,
						markersClusterer = JetEngineMaps.clusterersData[ clustererIndex ];

					mapProvider.fitMapToMarker( marker, markersClusterer );
				}

				mapProvider.triggerOpenPopup( marker );
			}
		},

		customInitMapBySelector: function( $selector ) {
			var $mapBlock = $selector.closest( '[data-is-block="jet-engine/maps-listing"]' ),
				$mapElWidget = $selector.closest( '.elementor-widget-jet-engine-maps-listing' );

			if ( $mapBlock.length ) {
				JetEngineMaps.widgetMap( $mapBlock );
			}

			if ( $mapElWidget.length ) {
				window.elementorFrontend.hooks.doAction( 'frontend/element_ready/widget', $mapElWidget, $ );
				window.elementorFrontend.hooks.doAction( 'frontend/element_ready/global', $mapElWidget, $ );
				window.elementorFrontend.hooks.doAction( 'frontend/element_ready/' + $mapElWidget.data( 'widget_type' ), $mapElWidget, $ );
			}
		}

	};

	$( window ).on( 'elementor/frontend/init', JetEngineMaps.init );

	window.addEventListener( 'DOMContentLoaded', function() {
		JetEngineMaps.initBlocks();
		JetEngineMaps.initBricks();
	} );

	window.jetEngineMapsBricks = function() {
		JetEngineMaps.initBricks();
	}

	window.JetEngineMaps = JetEngineMaps;

	JetEngineMaps.commonInit();

	$( window ).trigger( 'jet-engine/frontend-maps/loaded' );

}( jQuery ) );
