<?php echo $this->extend('plantilla'); ?>
<?= $this->section('contenido'); ?>
<script src="<?= base_url('assets/js/datatableScripts.js') ?>"></script>
<script src="<?= base_url('assets/js/deleteScripts.js') ?>"></script>

<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">


<div class="container px-3 mx-auto grid">
<br>
<div class="flex flex-col md:flex-row gap-4 mb-6">
    <div class="flex-1 bg-purple-100 p-4 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión de Corresponsales</h2>
        <p class="mt-1 text-sm text-gray-900 dark:text-gray-400">
            Listado completo de todas las corresponsales registradas en el sistema.
        </p>
    </div>

    <div class="flex items-center justify-center md:justify-end bg-purple-200 p-4 rounded-lg shadow-md">
        <a href="<?= base_url('corresponsales/new'); ?>">
            <button class="flex items-center justify-between px-6 py-3 text-sm font-semibold text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg shadow-md hover:bg-purple-700 active:bg-purple-800 focus:outline-none focus:shadow-outline-purple">
                <span>Agregar Corresponsal</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
        </a>
    </div>
</div>

    <!-- Tabla -->
    <div class="w-full overflow-hidden rounded-lg shadow-lg mb-8">
    <div class="overflow-x-auto">
        <table id="tbl_corresponsales" class="min-w-full bg-white dark:bg-gray-800 dark:text-gray-300">

            <thead>
                <tr class="text-sm font-bold tracking-wide text-left text-gray-600 uppercase border-b-2 border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 dark:text-gray-300">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Dirección</th>
                    <th class="px-4 py-3">provincia</th>
                    <th class="px-4 py-3">Ciudad</th>
                    <th class="px-4 py-3">Comision</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Agencia</th>
                    <th class="px-4 py-3">Latitud</th>
                    <th class="px-4 py-3">Longitud</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($corresponsales as $corresponsal) : ?>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm"><?= $corresponsal['id_corresponsal']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $corresponsal['nombre']; ?></td>
                    <td class="px-4 py-3 text-sm max-w-xs truncate"><?= $corresponsal['direccion']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $corresponsal['provincia']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $corresponsal['ciudad']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $corresponsal['comision']; ?></td>
                    <td class="px-4 py-3 text-sm">
                        <?php if (!empty($corresponsal['foto'])): ?>
                            <img class="w-12 h-12 rounded-full object-cover" src="<?= base_url('uploads/corresponsales/' . $corresponsal['foto']); ?>" alt="Foto corresponsal" loading="lazy">
                        <?php else: ?>
                            <span class="text-gray-500 dark:text-gray-400">N/A</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-sm"><?= $corresponsal['nombre_agencia']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $corresponsal['latitud']; ?></td>
                    <td class="px-4 py-3 text-sm"><?= $corresponsal['longitud']; ?></td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex items-center space-x-3">
                            <a href="<?= base_url('corresponsales/'.$corresponsal['id_corresponsal'].'/edit'); ?>" 
                            class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md transition-all duration-200 hover:scale-105 hover:bg-blue-600 hover:shadow-lg">
                                ✏️ Editar
                            </a>

                            <button onclick="eliminarCorresponsal('<?= base_url('corresponsales/'.$corresponsal['id_corresponsal']) ?>')" 
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