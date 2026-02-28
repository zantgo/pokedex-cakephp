<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pokemon $pokemon
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Pokemon'), ['action' => 'edit', $pokemon->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Pokemon'), ['action' => 'delete', $pokemon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pokemon->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Pokemons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Pokemon'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pokemons view content">
            <h3><?= h($pokemon->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($pokemon->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Types') ?></th>
                    <td><?= h($pokemon->types) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pokemon->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ext Id') ?></th>
                    <td><?= $this->Number->format($pokemon->ext_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Height') ?></th>
                    <td><?= $this->Number->format($pokemon->height) ?></td>
                </tr>
                <tr>
                    <th><?= __('Weight') ?></th>
                    <td><?= $this->Number->format($pokemon->weight) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
