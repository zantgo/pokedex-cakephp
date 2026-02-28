<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pokemons Model
 */
class PokemonsTable extends Table
{
    /**
     * Initialize method
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('pokemons');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Reglas de validación por defecto.
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('ext_id')
            ->notEmptyString('ext_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->notEmptyString('name');

        $validator
            ->scalar('types')
            ->maxLength('types', 255)
            ->notEmptyString('types');

        $validator
            ->integer('height')
            ->notEmptyString('height');

        $validator
            ->integer('weight')
            ->notEmptyString('weight');

        return $validator;
    }

    /**
     * Buscador Dinámico para el Análisis de Oak.
     *
     * En lugar de valores fijos (hardcoded), este método recibe un array de opciones
     * que vienen desde el controlador (y este a su vez del frontend).
     *
     * @param \Cake\ORM\Query $query La consulta base
     * @param array $options Parámetros de filtrado (min_weight, max_weight, type, min_height)
     * @return \Cake\ORM\Query
     */
    public function findOakAnalysis(Query $query, array $options): Query
    {
        // Filtro por Rango de Peso
        if (!empty($options['min_weight'])) {
            $query->where(['weight >' => (int)$options['min_weight']]);
        }
        if (!empty($options['max_weight'])) {
            $query->where(['weight <' => (int)$options['max_weight']]);
        }

        // Filtro por Tipo (Búsqueda parcial en el string de tipos)
        if (!empty($options['type'])) {
            $query->where(['types LIKE' => '%' . $options['type'] . '%']);
        }

        // Filtro por Altura Mínima
        if (!empty($options['min_height'])) {
            $query->where(['height >' => (int)$options['min_height']]);
        }

        return $query;
    }
}
