<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipments extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type_equipments_id',
        'serial_number',
    ];

    public static function isCorrect(string $mask, string $subject)
    {
        $regMask = [
            'N' => '[0-9]',
            'A' => '[A-Z]',
            'a' => '[a-z]',
            'X' => '[A-Z]|[0-9]',
            'Z' => '[(\-)|(_)|(@)]'
        ];

        $reg = "";
        for ($i = 0; $i < strlen($mask); $i++) {
            if (array_key_exists($mask[$i], $regMask)) {
                $reg .= $regMask[$mask[$i]];
            }
        }
        if (!preg_match("/" . $reg . "/", $subject)) {
            throw new \DomainException('Не соответсвует маске обородувания');
        }
        return preg_match("/" . $reg . "/", $subject);
    }
}
