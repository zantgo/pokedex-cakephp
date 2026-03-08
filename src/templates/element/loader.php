<div id="oak-loader" class="loader-overlay" style="display: none;">
    <div class="spinner"></div>
    <p>Procesando datos biológicos...</p>
</div>

<script>
    // Lógica simple para mostrar loader en submits y clics de paginación
    document.addEventListener('submit', () => document.getElementById('oak-loader').style.display = 'flex');
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', () => document.getElementById('oak-loader').style.display = 'flex');
    });
</script>