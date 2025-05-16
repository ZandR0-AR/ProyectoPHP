<?php echo $this->extend('plantilla'); ?>
<?= $this->section('contenido'); ?>

<!-- Agregamos el CSS oficial de Leaflet para que el mapa se vea bien -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
      integrity="sha256-sA+q5pT04NkNGLMxVb68xkK+p8NlyRGvfCtcuPmELMc=" crossorigin="" />

<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">

<div class="container px-3 mx-auto grid">
<div class="w-full overflow-hidden rounded-lg shadow-lg mb-8 bg-gray-100 dark:bg-gray-800">
  <div id="mapa" class="h-[600px] w-full rounded-lg"></div>
</div>

<script>
function initMap() {
    const coordenadaCentral = [-1.831239, -78.183406]; // [lat, lng]

    const miMapa = L.map('mapa').setView(coordenadaCentral, 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(miMapa);

    fetch('/mapas') // Asegúrate que esta ruta devuelve JSON con latitud, longitud, tipo, nombre
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                const posicion = [parseFloat(item.latitud), parseFloat(item.longitud)];
                const color = item.tipo.toLowerCase() === 'agencia' ? 'blue' : 'red';

                const marker = L.circleMarker(posicion, {
                    radius: 8,
                    fillColor: color,
                    color: '#000',
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(miMapa);

                marker.bindPopup(`<strong>${item.nombre}</strong><br>Tipo: ${item.tipo}`);
            });
        })
        .catch(err => console.error('Error al cargar ubicaciones:', err));
}

window.onload = initMap;
</script>


<?= $this->endSection(); ?>
