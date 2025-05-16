<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<div class="container px-3 mx-auto grid">
<br>
<div class="flex flex-col md:flex-row gap-5 mb-8">
    <!-- Tarjeta Agencias -->
    <div class="flex-1 bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden transition-all hover:shadow-lg">
        <div class="p-6 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Agencias</h3>
                <p class="text-3xl font-bold text-blue-600 mt-1"><?= $total_agencias ?></p>
                <div class="flex items-center mt-2">
                    <span class="inline-block w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                    <span class="text-xs text-gray-500">Puntos de atención</span>
                </div>
            </div>
            <div class="bg-blue-50 p-3 rounded-lg">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Tarjeta Corresponsales -->
    <div class="flex-1 bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden transition-all hover:shadow-lg">
        <div class="p-6 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Corresponsales</h3>
                <p class="text-3xl font-bold text-green-600 mt-1"><?= $total_corresponsales ?></p>
                <div class="flex items-center mt-2">
                    <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                    <span class="text-xs text-gray-500">Puntos asociados</span>
                </div>
            </div>
            <div class="bg-green-50 p-3 rounded-lg">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Tarjeta Cajeros -->
    <div class="flex-1 bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden transition-all hover:shadow-lg">
        <div class="p-6 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Cajeros</h3>
                <p class="text-3xl font-bold text-purple-600 mt-1"><?= $total_cajeros ?></p>
                <div class="flex items-center mt-2">
                    <span class="inline-block w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
                    <span class="text-xs text-gray-500">Dispositivos activos</span>
                </div>
            </div>
            <div class="bg-purple-50 p-3 rounded-lg">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3a1 1 0 00-1-1H4a1 1 0 00-1 1v7m10 0h4a1 1 0 011 1v7a1 1 0 01-1 1H3a1 1 0 01-1-1v-7a1 1 0 011-1h10zm-6 4h4"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<div style="width: 100%; height: 600px;" id="reporteMapa"></div>

<script>
  function initMap() {
    var coordenadaCentral = new google.maps.LatLng(-0.15775456825249395, -78.48548425646389);
    var miMapa = new google.maps.Map(document.getElementById("reporteMapa"), {
      center: coordenadaCentral,
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    // Definir íconos con tamaño ajustado
    var iconoAgencia = {
      url: '<?= base_url("assets/icons/agencia.png") ?>',
      scaledSize: new google.maps.Size(32, 32),
      anchor: new google.maps.Point(16, 16)
    };

    var iconoCorresponsal = {
      url: '<?= base_url("assets/icons/reportero.png") ?>',
      scaledSize: new google.maps.Size(32, 32),
      anchor: new google.maps.Point(16, 16)
    };

    var iconoCajero = {
      url: '<?= base_url("assets/icons/cajero.png") ?>', // Asegúrate de que este ícono exista
      scaledSize: new google.maps.Size(32, 32),
      anchor: new google.maps.Point(16, 16)
    };

    // Fetch a la ruta que devuelve el JSON (tu método index)
    fetch('<?= base_url('mapas') ?>')
      .then(response => response.json())
      .then(data => {
        data.forEach(item => {
          var posicion = new google.maps.LatLng(parseFloat(item.latitud), parseFloat(item.longitud));

          // Asignar ícono según el tipo de ubicación
          var icono = iconoAgencia; // Por defecto, asumimos que es agencia
          var titulo = item.nombre || item.numero_serie; // Usar nombre o número de serie

          if (item.tipo.toLowerCase() === 'corresponsal') {
            icono = iconoCorresponsal;
          } else if (item.tipo.toLowerCase() === 'cajero') {
            icono = iconoCajero;
          }

          // Crear el marcador
          var marcador = new google.maps.Marker({
            position: posicion,
            map: miMapa,
            title: titulo,
            icon: icono
          });

          // Contenido del popup
          var infoContent = `<strong>${titulo}</strong><br>Tipo: ${item.tipo}`;
          var infoWindow = new google.maps.InfoWindow();

          // Añadir evento de clic para mostrar el popup
          marcador.addListener('click', function() {
            infoWindow.setContent(infoContent);
            infoWindow.open(miMapa, marcador);
          });
        });
      })
      .catch(error => console.error('Error cargando ubicaciones:', error));
  }

  // Inicializar el mapa cuando la página cargue
  window.onload = initMap;
</script>

<!-- Carga el API de Google Maps con tu API key y el callback a initMap -->
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>

<?= $this->endSection() ?>
