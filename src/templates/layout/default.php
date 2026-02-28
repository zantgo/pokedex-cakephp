<?php
/**
 * Layout principal del Laboratorio Oak
 */
$cakeDescription = 'Laboratorio Oak: Pokedex';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Aquí cambiamos el nombre que aparece en la pestaña del navegador -->
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- Barra de navegación minimalista sin rastro de CakePHP -->
    <nav class="top-nav" style="background-color: #2c3e50; padding: 10px 0;">
        <div class="top-nav-title" style="margin-left: 20px;">
            <a href="<?= $this->Url->build('/') ?>" style="color: white; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                🏠 Panel de Control Pokedex
            </a>
        </div>
        <div class="top-nav-links" style="margin-right: 20px;">
            <span style="color: #bdc3c7; font-size: 0.8rem;">Sistema de Análisis v1.0.0</span>
        </div>
    </nav>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer style="text-align: center; padding: 40px 0; color: #95a5a6; font-size: 0.8rem;">
        &copy; <?= date('Y') ?> Laboratorio del Profesor Oak. Datos provistos por PokeAPI.
    </footer>
</body>
</html>
