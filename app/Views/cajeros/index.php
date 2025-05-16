<?php echo $this->extend('plantilla'); ?>
<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/datatableScripts.js') ?>"></script>
<script src="<?= base_url('assets/js/deleteScripts.js') ?>"></script>

<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
<div class="container px-3 mx-auto grid">
<br>
<div class="flex flex-col md:flex-row gap-4 mb-6">
    <div class="flex-1 bg-purple-100 p-4 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Cajero</h2>
        <p class="mt-1 text-sm text-gray-900 dark:text-gray-400">
            Listado completo de todas las cajeros registradas en el sistema.
        </p>
    </div>

    <div class="flex items-center justify-center md:justify-end bg-purple-200 p-4 rounded-lg shadow-md">
        <a href="<?= base_url('cajeros/new'); ?>">
            <button class="flex items-center justify-between px-6 py-3 text-sm font-semibold text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg shadow-md hover:bg-purple-700 active:bg-purple-800 focus:outline-none focus:shadow-outline-purple">
                <span>Agregar Cajero</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
        </a>
    </div>
</div>

    <!-- Tabla-->
    <div class="w-full overflow-hidden rounded-lg shadow-lg mb-8">
    <div class="overflow-x-auto">
        <table id="tbl_corresponsales" class="min-w-full bg-white dark:bg-gray-800 dark:text-gray-300">

            <thead>
                <tr class="text-sm font-bold tracking-wide text-left text-gray-600 uppercase border-b-2 border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 dark:text-gray-300">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Provincia</th>
                    <th class="px-4 py-3">Ciudad</th>
                    <th class="px-4 py-3">Numero Serie</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Latitud</th>
                    <th class="px-4 py-3">Longitud</th>
                    <th class="px-4 py-3">Agencia</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($cajeros as $cajero) : ?>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm"><?= $cajero['id_cajero']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $cajero['provincia']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $cajero['ciudad']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $cajero['numero_serie']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $cajero['estado']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $cajero['latitud']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $cajero['longitud']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $cajero['agencia_id']; ?></td>

                    <td class="px-4 py-3 text-sm">
                        <div class="flex items-center space-x-3">
                            <a href="<?= base_url('cajeros/'.$cajero['id_cajero'].'/edit'); ?>" 
                            class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md transition-all duration-200 hover:scale-105 hover:bg-blue-600 hover:shadow-lg">
                                ✏️ Editar
                            </a>

                            <button onclick="eliminarCajero('<?= base_url('cajeros/'.$cajero['id_cajero']) ?>')" 
                                    class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg shadow-md transition-all duration-200 hover:scale-105 hover:bg-red-700 hover:shadow-lg">
                                🗑️ Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<?= $this->endSection(); ?>