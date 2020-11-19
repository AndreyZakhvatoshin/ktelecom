<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentsRequest;
use App\Models\Equipments;
use App\Models\TypeEquipments;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{

    public function index()
    {
        return Equipments::all();
    }

    public function store(EquipmentsRequest $request)
    {
        $serial = $request['serial_number'];
        $typeEquipmentsId = $request['type_equipments_id'];
        $mask = TypeEquipments::getMaskById($typeEquipmentsId);
        try {
            Equipments::isCorrect($mask, $serial);
        } catch (\DomainException $e) {
            return $e->getMessage();
        }

        return Equipments::create($request->all());
    }


    public function show($id)
    {
        return Equipments::findOrFail($id);
    }

    public function update(EquipmentsRequest $request, $id)
    {
        $equipment = Equipments::findOrFail($id);
        $serial = $request['serial_number'] ?? $equipment['serial_number'];
        $typeEquipmentsId = $request['type_equipments_id'] ?? $equipment['type_equipments_id'];
        $mask = TypeEquipments::getMaskById($typeEquipmentsId);
        try {
            Equipments::isCorrect($mask, $serial);
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
        $equipment->update($request->all());
        return $equipment;
    }


    public function destroy($id)
    {
        Equipments::findOrFail($id)->delete();
    }
}
