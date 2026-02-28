<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pokemon Entity
 *
 * @property int $id
 * @property int $ext_id
 * @property string $name
 * @property string $types
 * @property int $height
 * @property int $weight
 *
 * @property string $inverted_name
 */
class Pokemon extends Entity
{
    /**
     * @var array<string, bool>
     */
    protected $_accessible = [
        'ext_id' => true,
        'name' => true,
        'types' => true,
        'height' => true,
        'weight' => true,
    ];

    /**
     * @return string
     */
    protected function _getInvertedName(): string
    {
        // Campo Virtual
        // Invertir el nombre (bulbasaur -> ruasablub)
        return strrev($this->name);
    }
}
