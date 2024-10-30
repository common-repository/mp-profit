var map;
function initializeShops() {
    var locations = [document.getElementById('map').getAttribute('data-description'), document.getElementById('map').getAttribute('data-latidute'), document.getElementById('map').getAttribute('data-longitude'), 1];
    var center = new google.maps.LatLng(locations[1], locations[2]);
    var color = '#3498db';
 
    var roadAtlasStyles = [
    {
        "featureType": "landscape",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 65
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 51
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 30
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 40
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -100
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffff00"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -97
            }
        ]
    }

  
    ];
   var mapOptions;
    if (jQuery(window).width() > 1024) {
        mapOptions = {
            zoom: parseInt(document.getElementById('map').getAttribute('data-zoom')),
            center: center,
            scaleControl: false,
            scrollwheel: false,
            draggable: true,
            minZoom: 3,
            maxZoom: 21,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
            }
        };
    } else {
        mapOptions = {
            zoom: parseInt(document.getElementById('map').getAttribute('data-zoom')),
            center: center,
            scaleControl: false,
            scrollwheel: false,
            draggable: false,
            minZoom: 3,
            maxZoom: 21,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
            }
        };
    }
    map = new google.maps.Map(document.getElementById('map'),
            mapOptions);
    var styledMapOptions = {
        name: 'Atlas'
    };
    var usRoadMapType = new google.maps.StyledMapType(
            roadAtlasStyles, styledMapOptions);
    map.mapTypes.set('usroadatlas', usRoadMapType);
    map.setMapTypeId('usroadatlas');
    var marker;
    var image = {
        size: new google.maps.Size(42, 63),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 42)
    };
    var shape = {
        coord: [1, 1, 1, 71, 71, 62, 62, 1],
        type: 'poly'
    };
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[1], locations[2]),
        map: map,
//        icon: image,
        shape: shape,
        zIndex: locations[4]

    });
    if (locations[0] != '') {
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', (function () {
            infowindow.setContent(locations[0]);
            infowindow.open(map, marker);
        }));
        infowindow.setContent(locations[0]);
        infowindow.open(map, marker);
    }


    function addMarker(feature) {
        var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
        });
    }
}

google.maps.event.addDomListener(window, 'load', initializeShops);
