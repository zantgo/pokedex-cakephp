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
 * @property float $height_cm
 * @property float $weight_kg
 */
class Pokemon extends Entity
{
    /**
     * Campos que pueden ser asignados de forma masiva (Mass Assignment).
     *
     * @var array<string, bool>
     */
    protected $_accessible =[
        'ext_id' => true,
        'name' => true,
        'types' => true,
        'height' => true,
        'weight' => true,
    ];

    /**
     * Exponemos los campos virtuales para que CakePHP los reconozca y los 
     * inyecte automáticamente si transformamos la entidad a JSON o Array.
     *
     * @var array<string>
     */
    protected $_virtual = ['inverted_name', 'height_cm', 'weight_kg'];

    /**
     * Campo Virtual: Invertir el nombre (ej: bulbasaur -> ruasablub)
     *
     * @return string
     */
    protected function _getInvertedName(): string
    {
        // strrev invierte una cadena en PHP
        return strrev($this->name ?? '');
    }

    /**
     * Campo Virtual: Convierte la altura de Decímetros a Centímetros
     * Multiplica por 10 (Ej: 7 dm = 70 cm)
     *
     * @return float
     */
    protected function _getHeightCm(): float
    {
        return (float)($this->height ?? 0) * 10;
    }

    /**
     * Campo Virtual: Convierte el peso de Hectogramos a Kilogramos
     * Divide por 10 (Ej: 69 hg = 6.9 kg)
     *
     * @return float
     */
    protected function _getWeightKg(): float
    {
        return (float)($this->weight ?? 0) / 10;
    }
}