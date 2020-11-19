<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEquipments extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type_name',
        'mask'
    ];

    /**
     *Accepts the hardware type id from table TypeEquipments
     *@param int $id
     *@return string
     */
    public static function getMaskById(int $id)
    {
        $field = TypeEquipments::findOrFail($id);
        return $field['mask'];
    }
}
