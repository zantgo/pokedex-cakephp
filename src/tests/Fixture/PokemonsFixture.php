<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PokemonsFixture
 */
class PokemonsFixture extends TestFixture
{
    /**
     * Nombre de la tabla para asegurar que los datos van a la tabla correcta
     * @var string
     */
    public $table = 'pokemons';

    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'ext_id' => 1,
                'name' => 'bulbasaur',
                'types' => 'grass, poison',
                'height' => 7,
                'weight' => 69, // 6.9 kg
            ],
            [
                'id' => 2,
                'ext_id' => 25,
                'name' => 'pikachu',
                'types' => 'electric',
                'height' => 4,
                'weight' => 60, // 6.0 kg
            ],
            [
                'id' => 3,
                'ext_id' => 12,
                'name' => 'butterfree',
                'types' => 'bug, flying',
                'height' => 11, // 1.1 dm (11 cm)
                'weight' => 320, // 32 kg
            ],
        ];
        parent::init();
    }
}
