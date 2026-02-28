<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Pokemon> $pokemons
 * @var array $filters Los filtros actuales que vienen del controlador
 */
?>
<?php $this->assign('title', 'Análisis de Especímenes'); ?>
<div class="pokemons index content">
    <!-- Encabezado Estilo Laboratorio -->
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #e74c3c; margin-bottom: 20px;">
        <h3 style="color: #2c3e50; margin: 0;">🔬 Laboratorio Oak: Análisis Pokedex</h3>
        <span style="background: #ecf0f1; padding: 5px 15px; border-radius: 20px; font-weight: bold; color: #c0392b;">
            Proyecto HP 2026
        </span>
    </div>

    <!-- BLOQUE 1: Filtros Dinámicos (El usuario define los valores) -->
    <div class="search-form" style="background: #fdfdfd; padding: 20px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 30px;">
        <h4 style="margin-top: 0; font-size: 1.1rem;">🔍 Búsqueda Avanzada de Especímenes</h4>
        <?= $this->Form->create(null, ['type' => 'get', 'valueSources' => 'query']) ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; align-items: end;">

            <div>
                <?= $this->Form->control('type', ['label' => 'Tipo (Ej: fire, water)', 'placeholder' => 'Tipo...']) ?>
            </div>
            <div>
                <?= $this->Form->control('min_weight', ['label' => 'Peso Mín (hg)', 'type' => 'number']) ?>
            </div>
            <div>
                <?= $this->Form->control('max_weight', ['label' => 'Peso Máx (hg)', 'type' => 'number']) ?>
            </div>
            <div>
                <?= $this->Form->control('min_height', ['label' => 'Altura Mín (dm)', 'type' => 'number']) ?>
            </div>

            <div style="display: flex; gap: 10px;">
                <?= $this->Form->button(__('Analizar'), ['style' => 'background: #2980b9; border: none;']) ?>
                <?= $this->Html->link(__('Limpiar'), ['action' => 'index'], ['class' => 'button outline', 'style' => 'color: #7f8c8d; border-color: #bdc3c7;']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <!-- BLOQUE 2: Accesos Directos - Requerimientos de Oak -->
    <div style="margin-bottom: 20px;">
        <strong style="display: block; margin-bottom: 10px; color: #7f8c8d;">⚡ Filtros Rápidos del Desafío:</strong>

        <!-- Requerimiento 1: Peso > 30 y < 80 -->
        <?= $this->Html->link('1. Peso Oak (30-80)',
            ['action' => 'index', '?' => ['min_weight' => 30, 'max_weight' => 80]],
            ['class' => 'button', 'style' => 'background: #27ae60; margin-right: 5px; font-size: 0.8rem;'])
        ?>

        <!-- Requerimiento 2: Tipo Grass -->
        <?= $this->Html->link('2. Tipo: Grass',
            ['action' => 'index', '?' => ['type' => 'grass']],
            ['class' => 'button', 'style' => 'background: #2ecc71; margin-right: 5px; font-size: 0.8rem;'])
        ?>

        <!-- Requerimiento 3: Flying y Altura > 10 -->
        <?= $this->Html->link('3. Flying High (>10)',
            ['action' => 'index', '?' => ['type' => 'flying', 'min_height' => 10]],
            ['class' => 'button', 'style' => 'background: #3498db; font-size: 0.8rem;'])
        ?>
    </div>

    <!-- Tabla de Datos Principal -->
    <div class="table-responsive">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #2c3e50; color: white;">
                    <th style="padding: 12px;"><?= $this->Paginator->sort('ext_id', 'ID API') ?></th>
                    <th><?= $this->Paginator->sort('name', 'Nombre Pokémon') ?></th>
                    <th style="color: #f1c40f;">🔄 Nombre Invertido</th> <!-- Requerimiento 4 -->
                    <th><?= $this->Paginator->sort('types', 'Tipo(s)') ?></th>
                    <th><?= $this->Paginator->sort('height', 'Altura (dm)') ?></th>
                    <th><?= $this->Paginator->sort('weight', 'Peso (hg)') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pokemons as $pokemon): ?>
                <tr>
                    <td style="font-weight: bold; color: #e74c3c;">#<?= $this->Number->format($pokemon->ext_id) ?></td>
                    <td><strong><?= h(ucfirst($pokemon->name)) ?></strong></td>

                    <!-- Transformación: Usando el campo virtual de la Entity -->
                    <td style="color: #7f8c8d; font-style: italic;">
                        <?= h($pokemon->inverted_name) ?>
                    </td>

                    <td>
                        <span style="background: #eee; padding: 2px 8px; border-radius: 4px; font-size: 0.9rem;">
                            <?= h($pokemon->types) ?>
                        </span>
                    </td>
                    <td><?= $this->Number->format($pokemon->height) ?></td>
                    <td><?= $this->Number->format($pokemon->weight) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginación Traducida -->
    <div class="paginator" style="margin-top: 30px; text-align: center;">
        <ul class="pagination">
            <?= $this->Paginator->first('<< primero') ?>
            <?= $this->Paginator->prev('< anterior') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('siguiente >') ?>
            <?= $this->Paginator->last('último >>') ?>
        </ul>
        <p style="color: #95a5a6; font-size: 0.9rem;">
            <?= $this->Paginator->counter('Mostrando espécimen {{current}} de {{count}} registrados en la Pokedex') ?>
        </p>
    </div>
</div>
