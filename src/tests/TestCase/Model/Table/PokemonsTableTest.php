<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PokemonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PokemonsTable Test Case
 */
class PokemonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PokemonsTable
     */
    protected $Pokemons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Pokemons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pokemons') ? [] : ['className' => PokemonsTable::class];
        $this->Pokemons = $this->getTableLocator()->get('Pokemons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Pokemons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PokemonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
