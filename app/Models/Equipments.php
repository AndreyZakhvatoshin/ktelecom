<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipments extends Model
{
    use HasFactory;
    /**
     * Сollection of values TypeEquipment mask
     */
    const REG_MASK = [
        'N' => '[0-9]',
        'A' => '[A-Z]',
        'a' => '[a-z]',
        'X' => '[A-Z]|[0-9]',
        'Z' => '[(\-)|(_)|(@)]'
    ];

    public $timestamps = false;

    protected $fillable = [
        'type_equipments_id',
        'serial_number',
    ];

    /**
     * Checks the transmitted serial number
     * for compliance with the hardware mask
     * @param string $mask
     * @param string $subject
     * @return bool
     */
    public static function isCorrect(string $mask, string $subject)
    {
        $reg = "";
        for ($i = 0; $i < strlen($mask); $i++) {
            if (array_key_exists($mask[$i], self::REG_MASK)) {
                $reg .= self::REG_MASK[$mask[$i]];
            }
        }
        if (!preg_match("/" . $reg . "/", $subject) || (strlen($mask) !== strlen($subject))) {
            throw new \DomainException('Серийный номер не соответсвует маске обородувания');
        }
        return preg_match("/" . $reg . "/", $subject);
    }
}
