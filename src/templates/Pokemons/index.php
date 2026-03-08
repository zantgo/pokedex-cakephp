<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Pokemon> $pokemons
 */
$this->assign('title', 'Análisis de Especímenes');
?>

<div class="pokemons index content">

    <!-- Componente: Loader AJAX -->
    <?= $this->element('loader') ?>

    <div class="header-lab" style="margin-bottom: 20px;">
        <h3>🔬 Laboratorio Oak: Análisis Pokedex</h3>
    </div>

    <!-- Componente: Consola de Filtros -->
    <?= $this->element('filters') ?>

    <!-- BLOQUE: Filtros Rápidos (Requerimientos de Oak) -->
    <div class="quick-filters" style="margin-bottom: 25px;">
        <strong style="display: block; margin-bottom: 10px; color: #7f8c8d;">Filtros Rápidos:</strong>

        <!-- Requerimiento 1: Peso > 30kg y < 80kg -->
        <?= $this->Html->link('1. Peso Oak (30-80 kg)',
            ['action' => 'index', '?' => ['min_weight' => 30, 'max_weight' => 80]],
            ['class' => 'button btn-sm', 'style' => 'background: #27ae60; margin-right: 5px;']) ?>

        <!-- Requerimiento 2: Tipo Grass -->
        <?= $this->Html->link('2. Tipo: Grass',
            ['action' => 'index', '?' => ['type' => 'grass']],
            ['class' => 'button btn-sm', 'style' => 'background: #2ecc71; margin-right: 5px;']) ?>

        <!-- Requerimiento 3: Tipo Flying con Altura > 10 cm -->
        <?= $this->Html->link('3. Flying High (>10 cm)',
            ['action' => 'index', '?' => ['type' => 'flying', 'min_height' => 10]],
            ['class' => 'button btn-sm', 'style' => 'background: #3498db;']) ?>
    </div>

    <!-- Componente: Tabla de Resultados -->
    <?= $this->element('table') ?>

</div>
