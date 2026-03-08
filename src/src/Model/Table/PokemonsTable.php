<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
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
     * Recibe valores del usuario en unidades humanas (kg/cm) 
     * y los convierte a las unidades de la PokeAPI (hg/dm) 
     * para consultar la base de datos.
     *
     * @param \Cake\ORM\Query $query La consulta base
     * @param array $options Parámetros de filtrado (min_weight, max_weight, type, min_height)
     * @return \Cake\ORM\Query
     */
    public function findOakAnalysis(Query $query, array $options): Query
    {
        // 1. Filtro por Rango de Peso (User: kg -> DB: hg)
        // 1 kg = 10 hg
        if (!empty($options['min_weight'])) {
            $query->where(['weight >' => (float)$options['min_weight'] * 10]);
        }
        if (!empty($options['max_weight'])) {
            $query->where(['weight <' => (float)$options['max_weight'] * 10]);
        }

        // 2. Filtro por Tipo (Búsqueda parcial en el string de tipos)
        if (!empty($options['type'])) {
            $query->where(['types LIKE' => '%' . $options['type'] . '%']);
        }

        // 3. Filtro por Altura Mínima (User: cm -> DB: dm)
        // 10 cm = 1 dm => cm / 10 = dm
        if (!empty($options['min_height'])) {
            $query->where(['height >' => (float)$options['min_height'] / 10]);
        }

        return $query;
    }
}