<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<div class="container mx-auto px-6 py-8 bg-white rounded-lg shadow-md">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Registrar Agencia</h2>
        <p class="text-gray-500">Completa los siguientes campos para agregar una nueva agencia.</p>
    </div>


    <!-- Formulario -->
    <form action="<?= base_url('agencias'); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" required  
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="telefono" id="telefono" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="ciudad" class="block text-sm font-medium text-gray-700">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" id="direccion" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="horario_atencion" class="block text-sm font-medium text-gray-700">Horario</label>
                <input type="text" name="horario_atencion" id="horario_atencion" required 
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" id="correo" required 
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
            <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" name="foto" id="foto" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" 
                accept="image/*" required>
        </div>

            <div class="row">
            <div class="col-md-12">
                <div id="mapa" style="height:250px; width:100%; border:1px solid black;"></div>
            </div>
    </div>
        </div>

        <div class="flex justify-center mt-6">
            <a href="<?= base_url('agencias');?>"></a>
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
