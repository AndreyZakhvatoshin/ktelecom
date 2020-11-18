<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Models\Equipments;
use App\Models\TypeEquipments;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Equipments::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Equipments::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipments::findOrFail($id)->delete();
    }
}
