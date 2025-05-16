<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<div class="container mx-auto px-6 py-8 bg-white rounded-lg shadow-md">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Registrar Cajeros</h2>
        <p class="text-gray-500">Completa los siguientes campos para agregar un nuevo cajero.</p>
    </div>

    <!-- Formulario -->
    <form action="<?= base_url('cajeros'); ?>" method="POST" class="space-y-6">
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="provincia" class="block text-sm font-medium text-gray-700">Provincia</label>
            <input type="text" name="provincia" id="provincia" required value="<?= old('provincia') ?>" 
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad</label>
            <input type="text" name="ciudad" id="ciudad" required value="<?= old('ciudad') ?>" 
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="numero_serie" class="block text-sm font-medium text-gray-700">Número de Serie</label>
            <input type="text" name="numero_serie" id="numero_serie" required value="<?= old('numero_serie') ?>" 
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
        </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                <input type="text" name="estado" id="estado" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

        <div>
                <label for="latitud" class="block text-sm font-medium text-gray-700">Latitud</label>
                <input type="text" name="latitud" id="latitud" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="longitud" class="block text-sm font-medium text-gray-700">Longitud</label>
                <input type="text" name="longitud" id="longitud" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>


        <!-- id_Agencia -->
        <div>
            <label for="agencia_id" class="block text-sm font-medium text-gray-700">Agencia</label>
            <select name="agencia_id" id="agencia_id" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>Seleccione una agencia</option>
                <?php foreach ($agencias as $agencia): ?>
                    <option value="<?= $agencia['id_agencia']; ?>" <?= old('agencia_id') == $agencia['id_agencia'] ? 'selected' : '' ?>>
                        <?= $agencia['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-span-2">
            <div id="mapa" style="height:250px; width:100%; border:1px solid black;"></div>
        </div>
    </div>

    <div class="flex justify-center mt-6">
        <button type="reset" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300 mr-4">
            Limpiar
        </button>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
            Guardar
        </button>
    </div>
</form>
</div>
<script type="text/javascript">
    function initMap(){
        var coordenadaCentral=
          new google.maps.LatLng(-0.15775456825249395, -78.48548425646389);
        var miMapa=new google.maps.Map(document.getElementById('mapa'),{
            center:coordenadaCentral,
            zoom:8,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        });
        
        var marcador=new google.maps.Marker({
            position:coordenadaCentral,
            map:miMapa,
            title:'Selecciona la ubicacion',
            draggable:true
        });
        google.maps.event.addListener(
            marcador,
            'dragend',
            function(event){
                var latitud=this.getPosition().lat();
                var longitud=this.getPosition().lng();
                document.getElementById('latitud').value=latitud;
                document.getElementById('longitud').value=longitud;
            }
        );
    }
</script>
<?= $this->endSection(); ?>
