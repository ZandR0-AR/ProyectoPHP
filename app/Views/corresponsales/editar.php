<?php

use App\Controllers\Agencias;

echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<div class="container mx-auto px-6 py-8 bg-white rounded-lg shadow-md">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Modificar Corresponsal</h2>
        <p class="text-gray-500">Completa los siguientes campos para editar esta corresponsal.</p>
    </div>

    <?php if (session()->has('errors')) : ?>
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <?= session('errors'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('corresponsales/' . $corresponsal['id_corresponsal']); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
    <input type="hidden" name="_method" value="PUT">
        <?php if (session('errors')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <?= session('errors') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
            <input type="text" name="nombre" id="nombre" required value="<?= esc($corresponsal['nombre']); ?>" autofocus
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección *</label>
            <input type="text" name="direccion" id="direccion" required value="<?= esc($corresponsal['direccion']); ?>"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="provincia" class="block text-sm font-medium text-gray-700">Teléfono *</label>
            <input type="text" name="provincia" id="provincia" required value="<?= esc($corresponsal['provincia']); ?>"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad *</label>
            <input type="text" name="ciudad" id="ciudad" required value="<?= esc($corresponsal['ciudad']); ?>"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        

        <div>
            <label for="comision" class="block text-sm font-medium text-gray-700">Comision *</label>
            <input type="text" name="comision" id="comision" required value="<?= esc($corresponsal['comision']); ?>"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

            <!-- id_Agencia -->
            <div>
                <label for="agencia_id" class="block text-sm font-medium text-gray-700">Agencia</label>
                <select name="agencia_id" id="agencia_id" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled>Seleccione una agencia</option>
                    <?php foreach ($agencias as $agencia): ?>
                        <option value="<?= $agencia['id_agencia']; ?>" <?= $corresponsal['agencia_id'] == $agencia['id_agencia'] ? 'selected' : '' ?>>
                            <?= $agencia['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        <div>
            <label for="latitud" class="block text-sm font-medium text-gray-700">Latitud *</label>
            <input type="text" name="latitud" id="latitud" required value="<?= esc($corresponsal['latitud']); ?>"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="longitud" class="block text-sm font-medium text-gray-700">Longitud *</label>
            <input type="text" name="longitud" id="longitud" required value="<?= esc($corresponsal['longitud']); ?>"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
            <?php if (!empty($corresponsal['foto'])): ?>
                <div class="mb-2">
                    <img src="<?= base_url('uploads/agencias/'.esc($corresponsal['foto'])) ?>" alt="Foto actual" class="h-20">
                    <p class="text-sm text-gray-500 mt-1">Foto actual</p>
                </div>
            <?php endif; ?>
            <input type="file" name="foto" id="foto"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" 
                   accept="image/*">
            <p class="mt-1 text-sm text-gray-500">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</p>
        </div>
    </div>

    <div class="mt-6">
        <label class="block text-sm font-medium text-gray-700">Ubicación en el mapa</label>
        <div id="mapa" style="height:300px; width:100%; border:1px solid black;"></div>
        <p class="mt-1 text-sm text-gray-500">Las coordenadas se actualizarán automáticamente al seleccionar una ubicación en el mapa</p>
    </div>
    <div class="flex justify-center mt-6 space-x-4">
        <a href="<?= base_url('corresponsales'); ?>" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Cancelar</a>
        <button type="reset" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-300">Limpiar</button>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Guardar cambios</button>
    </div>
</form>
</div>
<script type="text/javascript">
    function initMap(){
        var coordenadaCentral = new google.maps.LatLng(<?= esc($corresponsal['latitud']); ?>, <?= esc($corresponsal['longitud']); ?>);
        var miMapa = new google.maps.Map(document.getElementById('mapa'),{
            center: coordenadaCentral,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        
        var marcador = new google.maps.Marker({
            position: coordenadaCentral,
            map: miMapa,
            title: 'Selecciona la ubicación',
            draggable: true
        });

        marcador.addListener('dragend', function(event){
            document.getElementById('latitud').value = event.latLng.lat();
            document.getElementById('longitud').value = event.latLng.lng();
        });
    }
</script>

<?= $this->endSection(); ?>
