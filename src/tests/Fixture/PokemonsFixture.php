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
                'name' => 'Lorem ipsum dolor sit amet',
                'types' => 'Lorem ipsum dolor sit amet',
                'height' => 1,
                'weight' => 1,
            ],
        ];
        parent::init();
    }
}
