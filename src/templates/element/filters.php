<div class="filters-card">
    <h4>🔍 Consola de Filtros de Especímenes</h4>
    <?= $this->Form->create(null, ['type' => 'get', 'valueSources' => 'query', 'class' => 'filters-form']) ?>
        <div class="filters-grid">
            <div class="filter-group">
                <?= $this->Form->control('type', [
                    'label' => 'Tipo',
                    'placeholder' => 'Ej: grass',
                    'value' => $this->request->getQuery('type')
                ]) ?>
            </div>

            <div class="filter-group">
                <?= $this->Form->control('min_weight', [
                    'label' => 'Peso Mín (kg)',
                    'type' => 'number',
                    'step' => '0.1',
                    'value' => $this->request->getQuery('min_weight')
                ]) ?>
            </div>

            <div class="filter-group">
                <?= $this->Form->control('max_weight', [
                    'label' => 'Peso Máx (kg)',
                    'type' => 'number',
                    'step' => '0.1',
                    'value' => $this->request->getQuery('max_weight')
                ]) ?>
            </div>

            <div class="filter-group">
                <?= $this->Form->control('min_height', [
                    'label' => 'Altura Mín (cm)',
                    'type' => 'number',
                    'value' => $this->request->getQuery('min_height')
                ]) ?>
            </div>

            <div class="filter-actions">
                <?= $this->Form->button(__('Analizar'), ['class' => 'btn-analyze']) ?>
                <?= $this->Html->link(__('Limpiar'), ['action' => 'index'], ['class' => 'button btn-clear']) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
