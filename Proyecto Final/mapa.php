<!--
  Copyright 2023 Google LLC

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
-->

<!-- Api-->
<!DOCTYPE html>
<html>
  <head>
    <title>Locator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  </script>


  <link rel="stylesheet" href="proyecyo.css">

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/handlebars/4.7.7/handlebars.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #map-container {
        width: 100%;
        height: 100%;
        position: relative;
        font-family: "Roboto", sans-serif;
        box-sizing: border-box;
      }

      #map-container a {
        text-decoration: none;
        color: #1967d2;
      }

      #map-container button {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        font-size: inherit;
        cursor: pointer;
      }

      #gmp-map {
        position: absolute;
        left: 22em;
        top: 0;
        right: 0;
        bottom: 0;
      }

      #locations-panel {
        position: absolute;
        left: 0;
        width: 22em;
        top: 0;
        bottom: 0;
        overflow-y: auto;
        background: white;
        padding: 0.5em;
        box-sizing: border-box;
      }

      @media only screen and (max-width: 876px) {
        #gmp-map {
          left: 0;
          bottom: 50%;
        }

        #locations-panel {
          top: 50%;
          right: 0;
          width: unset;
        }
      }

      #locations-panel-list .section-name {
        font-weight: 500;
        font-size: 0.9em;
        margin: 1.8em 0 1em 1.5em;
      }

      #locations-panel-list .location-result {
        position: relative;
        padding: 0.8em 3.5em 0.8em 1.4em;
        border-bottom: 1px solid rgba(0, 0, 0, 0.12);
        cursor: pointer;
      }

      #locations-panel-list .location-result:first-of-type {
        border-top: 1px solid rgba(0, 0, 0, 0.12);
      }

      #locations-panel-list .location-result:last-of-type {
        border-bottom: none;
      }

      #locations-panel-list .location-result.selected {
        outline: 2px solid #4285f4;
      }

      #locations-panel-list button.select-location {
        margin-bottom: 0.6em;
        text-align: left;
      }

      #locations-panel-list .location-result h2.name {
        font-size: 1em;
        font-weight: 500;
        margin: 0;
      }

      #locations-panel-list .location-result .address {
        color: #757575;
        font-size: 0.9em;
        margin-bottom: 0.5em;
      }

      #locations-panel-list .directions-button {
        position: absolute;
        right: 1.2em;
        top: 2.3em;
      }

      #locations-panel-list .directions-button-background:hover {
        fill: rgba(116,120,127,0.1);
      }

      #locations-panel-list .directions-button-background {
        fill: rgba(255,255,255,0.01);
      }

      #location-results-list {
        list-style-type: none;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      'use strict';

      /** Helper function to generate a Google Maps directions URL */
      function generateDirectionsURL(origin, destination) {
        const googleMapsUrlBase = 'https://www.google.com/maps/dir/?';
        const searchParams = new URLSearchParams('api=1');
        searchParams.append('origin', origin);
        const destinationParam = [];
        // Add title to destinationParam except in cases where Quick Builder set
        // the title to the first line of the address
        if (destination.title !== destination.address1) {
          destinationParam.push(destination.title);
        }
        destinationParam.push(destination.address1, destination.address2);
        searchParams.append('destination', destinationParam.join(','));
        return googleMapsUrlBase + searchParams.toString();
      }

      /**
       * Defines an instance of the Locator+ solution, to be instantiated
       * when the Maps library is loaded.
       */
      function LocatorPlus(configuration) {
        const locator = this;

        locator.locations = configuration.locations || [];
        locator.capabilities = configuration.capabilities || {};

        const mapEl = document.getElementById('gmp-map');
        const panelEl = document.getElementById('locations-panel');
        locator.panelListEl = document.getElementById('locations-panel-list');
        const sectionNameEl =
            document.getElementById('location-results-section-name');
        const resultsContainerEl = document.getElementById('location-results-list');

        const itemsTemplate = Handlebars.compile(
            document.getElementById('locator-result-items-tmpl').innerHTML);

        locator.selectedLocationIdx = null;
        locator.userCountry = null;

        // Initialize the map -------------------------------------------------------
        locator.map = new google.maps.Map(mapEl, configuration.mapOptions);

        // Store selection.
        const selectResultItem = function(locationIdx, panToMarker, scrollToResult) {
          locator.selectedLocationIdx = locationIdx;
          for (let locationElem of resultsContainerEl.children) {
            locationElem.classList.remove('selected');
            if (getResultIndex(locationElem) === locator.selectedLocationIdx) {
              locationElem.classList.add('selected');
              if (scrollToResult) {
                panelEl.scrollTop = locationElem.offsetTop;
              }
            }
          }
          if (panToMarker && (locationIdx != null)) {
            locator.map.panTo(locator.locations[locationIdx].coords);
          }
        };

        // Create a marker for each location.
        const markers = locator.locations.map(function(location, index) {
          const marker = new google.maps.Marker({
            position: location.coords,
            map: locator.map,
            title: location.title,
          });
          marker.addListener('click', function() {
            selectResultItem(index, false, true);
          });
          return marker;
        });

        // Fit map to marker bounds.
        locator.updateBounds = function() {
          const bounds = new google.maps.LatLngBounds();
          for (let i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].getPosition());
          }
          locator.map.fitBounds(bounds);
        };
        if (locator.locations.length) {
          locator.updateBounds();
        }

        // Render the results list --------------------------------------------------
        const getResultIndex = function(elem) {
          return parseInt(elem.getAttribute('data-location-index'));
        };

        locator.renderResultsList = function() {
          let locations = locator.locations.slice();
          for (let i = 0; i < locations.length; i++) {
            locations[i].index = i;
          }
          sectionNameEl.textContent = `All locations (${locations.length})`;
          const resultItemContext = {locations: locations};
          resultsContainerEl.innerHTML = itemsTemplate(resultItemContext);
          for (let item of resultsContainerEl.children) {
            const resultIndex = getResultIndex(item);
            if (resultIndex === locator.selectedLocationIdx) {
              item.classList.add('selected');
            }

            const resultSelectionHandler = function() {
              if (resultIndex !== locator.selectedLocationIdx) {
                selectResultItem(resultIndex, true, false);
              }
            };

            // Clicking anywhere on the item selects this location.
            // Additionally, create a button element to make this behavior
            // accessible under tab navigation.
            item.addEventListener('click', resultSelectionHandler);
            item.querySelector('.select-location')
                .addEventListener('click', function(e) {
                  resultSelectionHandler();
                  e.stopPropagation();
                });

            // Clicking the directions button will open Google Maps directions in a
            // new tab
            const origin = (locator.searchLocation != null) ?
                locator.searchLocation.location :
                '';
            const destination = locator.locations[resultIndex];
            const googleMapsUrl = generateDirectionsURL(origin, destination);
            item.querySelector('.directions-button')
                .setAttribute('href', googleMapsUrl);
          }
        };

        // Optional capability initialization --------------------------------------

        // Initial render of results -----------------------------------------------
        locator.renderResultsList();
      }
    </script>
    <script>
      const CONFIGURATION = {
        "locations": [
          {"title":"Guadalupe Victoria 117","address1":"Guadalupe Victoria 117","address2":"Los Altos, 45520 San Pedro Tlaquepaque, Jal., México","coords":{"lat":20.6366155,"lng":-103.29509080859833},"placeId":"ChIJm3cznLyzKIQRMw788480Q8U"}
        ],
        "mapOptions": {"center":{"lat":38.0,"lng":-100.0},"fullscreenControl":true,"mapTypeControl":false,"streetViewControl":false,"zoom":4,"zoomControl":true,"maxZoom":17,"mapId":""},
        "mapsApiKey": "AIzaSyAfhrYxqdoRl0uQfISc3fdaMgXj5xCiMMg",
        "capabilities": {"input":false,"autocomplete":false,"directions":false,"distanceMatrix":false,"details":false,"actions":false}
      };

      function initMap() {
        new LocatorPlus(CONFIGURATION);
      }
    </script>
    <script id="locator-result-items-tmpl" type="text/x-handlebars-template">
      {{#each locations}}
        <li class="location-result" data-location-index="{{index}}">
          <button class="select-location">
            <h2 class="name">{{title}}</h2>
          </button>
          <div class="address">{{address1}}<br>{{address2}}</div>
          <a class="directions-button" href="" target="_blank" title="Get directions to this location on Google Maps">
            <svg width="34" height="34" viewBox="0 0 34 34"
                  fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.5867 9.24375L17.9403 8.8902V8.8902L17.5867 9.24375ZM16.4117 9.24375L16.7653 9.59731L16.7675 9.59502L16.4117 9.24375ZM8.91172 16.7437L8.55817 16.3902L8.91172 16.7437ZM8.91172 17.9229L8.55817 18.2765L8.55826 18.2766L8.91172 17.9229ZM16.4117 25.4187H16.9117V25.2116L16.7652 25.0651L16.4117 25.4187ZM16.4117 25.4229H15.9117V25.63L16.0582 25.7765L16.4117 25.4229ZM25.0909 17.9229L25.4444 18.2765L25.4467 18.2742L25.0909 17.9229ZM25.4403 16.3902L17.9403 8.8902L17.2332 9.5973L24.7332 17.0973L25.4403 16.3902ZM17.9403 8.8902C17.4213 8.3712 16.5737 8.3679 16.0559 8.89248L16.7675 9.59502C16.8914 9.4696 17.1022 9.4663 17.2332 9.5973L17.9403 8.8902ZM16.0582 8.8902L8.55817 16.3902L9.26527 17.0973L16.7653 9.5973L16.0582 8.8902ZM8.55817 16.3902C8.0379 16.9105 8.0379 17.7562 8.55817 18.2765L9.26527 17.5694C9.13553 17.4396 9.13553 17.227 9.26527 17.0973L8.55817 16.3902ZM8.55826 18.2766L16.0583 25.7724L16.7652 25.0651L9.26517 17.5693L8.55826 18.2766ZM15.9117 25.4187V25.4229H16.9117V25.4187H15.9117ZM16.0582 25.7765C16.5784 26.2967 17.4242 26.2967 17.9444 25.7765L17.2373 25.0694C17.1076 25.1991 16.895 25.1991 16.7653 25.0694L16.0582 25.7765ZM17.9444 25.7765L25.4444 18.2765L24.7373 17.5694L17.2373 25.0694L17.9444 25.7765ZM25.4467 18.2742C25.9631 17.7512 25.9663 16.9096 25.438 16.3879L24.7354 17.0995C24.8655 17.2279 24.8687 17.4363 24.7351 17.5716L25.4467 18.2742Z" fill="#1967d2"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M19 19.8333V17.75H15.6667V20.25H14V16.9167C14 16.4542 14.3708 16.0833 14.8333 16.0833H19V14L21.9167 16.9167L19 19.8333Z" fill="#1967d2"/>
              <circle class="directions-button-background" cx="17" cy="17" r="16.5" stroke="#e0e0e0"/>
            </svg>
          </a>
        </li>
      {{/each}}
    </script>
  </head>
  <body>
     <header>


    <nav class="navbar navbar-expand-lg " style="background-color: rgb(248, 210, 206);">
      <div class="container-fluid">


        <a class="navbar-brand" href="proyecto.php">
          <img src="imagenes/boneteria.jpeg" alt="Boneteria" width="200" height="54">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form class="d-flex" role="search">
            <input id="formulario" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button id="boton" class="btn btn-outline-success" type="button">Buscar</button>
            <div id="cover-ctn-search" >

            </div>
          </form>


          &emsp;&emsp;&emsp;
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Categorias
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Novedades</a></li>
                <li><a class="dropdown-item" href="niños.php">Niños</a></li>
                <li><a class="dropdown-item" href="bebes.php">Bebes</a></li>
                <li><a class="dropdown-item" href="mujer.php">Mujer</a></li>
                <li><a class="dropdown-item" href="hombre.php">Hombre</a></li>
                <li><a class="dropdown-item" href="#">En oferta</a></li>
                <li><a class="dropdown-item" href="">Otros</a></li>
              </ul>
            </li>

            <li class="nav-item">

            <div class="dropdown">

<?php
if (isset($_SESSION["nombre"])) {
  echo '<button class="btn dropdown-toggle" type="button" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false" >
  <img src="./php/images/icons/iconoper3.png" alt="icono-persona" class="icono-persona" style="width: 40px; height: 30px;"> 
  ' . $_SESSION["nombre"] . 
  
  '</button>';
  ?>
<ul class="dropdown-menu" >

<?php
echo "<li><a class='dropdown-item' href ='./vercuenta.php?id=".$_SESSION["id"]."' >Ver cuenta</a></li> ";
?>

<li><a class="dropdown-item" href="./php/listadecompras.php">Lista de compras</a></li>
<li><a class="dropdown-item" href="cerrarseccion.php">Cerrar sesión </a></li>
</ul>
<?php
} else {
  echo '<a class="nav-link active" aria-current="page" href="./php/iniciar_seccion.php">Iniciar sesión</a>';
}
?>
  </div>            </li>




            <li class="nav-item">
              <a class="nav-link" href="mapa.php">Ubicacion</a>
            </li>


            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <li class="nav-item">


              <div class="container-icon">
                <div class="container-cart-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon-cart">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                  </svg>
                  <div class="count-products">
                    <span id="contador-productos">0</span>


                  </div>

                </div>


                <div class="container-cart-products hidden-cart">
                  <div class="row-product">
                    <div class="cart-product">
                      <div class="info-cart-product">
                        <span class="cantidad-producto-carrito"></span>
                        <p class="titulo-producto-carrito"></p>
                        <span class="precio-producto-carrito"></span>

                      </div>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="icon-close">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>


                    </div>

                  </div>


                  <div class="cart-total">
                    <h3>Total:</h3>
                    <span class="total-pagar"></span>

                  </div>



                </div>
            </li>

          </ul>

        </div>
      </div>
    </nav>
  </header>
  <div id="resultado" class="hidden-result">
    
    <ul id="box-search">

    </ul>
    
  </div>
    <div id="map-container">
      <div id="locations-panel">
        <div id="locations-panel-list">
          <div class="section-name" id="location-results-section-name">
            All locations
          </div>
          <div class="results">
            <ul id="location-results-list"></ul>
          </div>
        </div>
      </div>
      <div id="gmp-map"></div>
    </div>
    <center>

    
      <footer>
  
        <table>
          <tr>
  
            <th>
  
              <a href="https://www.facebook.com/profile.php?id=61550237064245&mibextid=LQQJ4d"><img
                  src="imagenes/face.png" alt="" class="icono"></a>
              &emsp;
            </th>
  
            <th>
  
              <a href="https://www.facebook.com/profile.php?id=61550237064245&mibextid=LQQJ4d"><img
                  src="imagenes/logomessenger.png" alt="" class="icono"></a>
              &emsp;
            </th>
            <th>
  
              <a href="https://api.whatsapp.com/send?phone=%2B523311094944&text=hola,%20quiero%20comprar%20algo%20"><img
                  src="imagenes/whatsapicono.png" alt="" class="icono"></a>
              &emsp;
            </th>
  
            <th>
  
              <a href="https://instagram.com/mariaguadalupenavarrolimon?igshid=NGVhN2U2NjQ0Yg=="><img
                  src="imagenes/insta.png" alt="" class="icono"></a>
              &emsp;
            </th>
          </tr>
  
  
        </table>
      </footer>
  
  
    </center>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfhrYxqdoRl0uQfISc3fdaMgXj5xCiMMg&callback=initMap&libraries=places&solution_channel=GMP_QB_locatorplus_v9_c" async defer></script>
    
  <script src="proyecto.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  
  </body>
</html>