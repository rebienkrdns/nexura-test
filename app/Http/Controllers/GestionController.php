<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\EmpleadoRol;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index')->with('areas', Area::all())->with('roles', Rol::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $empleadoNuevo = Empleado::create([
                "nombre" => $request->nombre,
                "email" => $request->correo,
                "sexo" => $request->sexo,
                "area_id" => $request->area,
                "descripcion" => $request->descripcion,
                "boletin" => isset($request->boletin) ? 1 : 0
            ]);

            foreach (Rol::all() as $rol) {
                if ($request->get("rol$rol->id")) {
                    EmpleadoRol::create([
                        'empleado_id' => $empleadoNuevo->id,
                        'rol_id' => $rol->id
                    ]);
                }
            }
            session()->flash('success', "Datos guardados correctamente");
        } catch (\Exception $e) {
            session()->flash('error', "Debe agregar los datos obligatorios");
        }
        return Redirect::to('/empleados');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $empleados = Empleado::seleccionar();
            if ($id) {
                return ['empleado' => $empleados->find($id), 'roles' => EmpleadoRol::where('empleado_id', $id)->get()];
            } else {
                return $empleados->get();
            }
        } catch (\Exception $e) {
            session()->flash('error', "Empleado no encontrado");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Empleado::find($request->id)
                ->update([
                    "nombre" => $request->nombreM,
                    "email" => $request->correoM,
                    "sexo" => $request->sexoM,
                    "area_id" => $request->areaM,
                    "descripcion" => $request->descripcionM,
                    "boletin" => isset($request->boletinM) ? 1 : 0
                ]);

            EmpleadoRol::where('empleado_id', $request->id)->delete();
            foreach (Rol::all() as $rol) {
                if ($request->get("rol$rol->id" . "M")) {
                    EmpleadoRol::create([
                        'empleado_id' => $request->id,
                        'rol_id' => $rol->id
                    ]);
                }
            }
            session()->flash('success', "Datos guardados correctamente");
        } catch (\Exception $e) {
            session()->flash('error', "Debe agregar los datos obligatorios");
        }
        return Redirect::to('/empleados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::find($id)->delete();
    }
}
