<div class="table-responsive">
    <table class="oak-table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ext_id', 'ID') ?></th>
                <th><?= $this->Paginator->sort('name', 'Especie') ?></th>
                <th class="text-inverted">🔄 Nombre Invertido</th>
                <th><?= $this->Paginator->sort('types', 'Tipos') ?></th>
                <th><?= $this->Paginator->sort('height', 'Altura (cm)') ?></th>
                <th><?= $this->Paginator->sort('weight', 'Peso (kg)') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pokemons as $pokemon): ?>
            <tr>
                <td class="poke-id">
                    #<?= str_pad((string)$pokemon->ext_id, 3, '0', STR_PAD_LEFT) ?>
                </td>

                <td>
                    <strong><?= h(ucfirst($pokemon->name)) ?></strong>
                </td>

                <td class="text-inverted">
                    <?= h($pokemon->inverted_name) ?>
                </td>

                <td>
                    <?php foreach (explode(', ', $pokemon->types) as $type): ?>
                        <span class="badge type-<?= h($type) ?>">
                            <?= h($type) ?>
                        </span>
                    <?php endforeach; ?>
                </td>

                <!-- Uso de Mutators de la Entidad -->
                <td>
                    <?= $this->Number->format($pokemon->height_cm) ?> cm
                </td>

                <td>
                    <?= $this->Number->format($pokemon->weight_kg) ?> kg
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="paginator text-center">
    <ul class="pagination">
        <?= $this->Paginator->first('<< primero') ?>
        <?= $this->Paginator->prev('< anterior') ?>
        
        <!-- CORRECCIÓN: Se añade currentClass => 'active' -->
        <?= $this->Paginator->numbers(['currentClass' => 'active']) ?>
        
        <?= $this->Paginator->next('siguiente >') ?>
        <?= $this->Paginator->last('último >>') ?>
    </ul>

    <p>
        <?= $this->Paginator->counter('Mostrando {{current}} de {{count}} especímenes') ?>
    </p>
</div>