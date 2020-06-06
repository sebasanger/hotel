<?php

namespace App\Http\Controllers;

use App\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

use function Psy\debug;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Habitacion::OrderBy('numeroHabitacion', 'ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $request->validate([
            'numeroHabitacion' => 'required|numeric|unique:habitaciones',
            'piso' => 'required|numeric|max:8',
            'capacidad' => 'required|numeric',
            'single' => 'nullable|numeric|max:6',
            'doble' => 'nullable|numeric|max:4',
        ]);

        $nombreImagen = $this->guardarImagen($request->image_path);
        $nombreImagen2 = $this->guardarImagen($request->image_path2);
        $nombreImagen3 = $this->guardarImagen($request->image_path3);

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = $request->numeroHabitacion;
        $habitacion->piso = $request->piso;
        $habitacion->capacidad = $request->capacidad;
        $habitacion->single = $request->single;
        $habitacion->doble = $request->doble;
        $habitacion->estado = 1;
        $habitacion->estadoLimpieza = 1;
        $habitacion->image_path = $nombreImagen;
        $habitacion->image_path2 = $nombreImagen2;
        $habitacion->image_path3 = $nombreImagen3;
        $habitacion->save();

        return $habitacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return Habitacion::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('isAdmin');
        $id = $request->id;

        $request->validate([
            'numeroHabitacion' => [Rule::unique('habitaciones')->ignore($id)],
            'piso' => 'required|numeric|max:8',
            'capacidad' => 'required|numeric',
            'single' => 'nullable|numeric|max:6',
            'doble' => 'nullable|numeric|max:4',
        ]);
        $habitacion = Habitacion::find($request->id);
        $currentImage1 = $habitacion->image_path;
        //se verifica si es que se envio una nueva imagen por el request
        if ($request->image_path !=  $currentImage1) {
            //nombre de la foto para que no se pueda duplicar
            $name1 = time() . '.' . explode('/', explode(':', substr($request->image_path, 0, strpos($request->image_path, ';')))[1])[1];

            //se guarda en public/img/habitaciones con el plugin image mananger
            Image::make($request->image_path)->save(public_path('img/habitaciones/') . $name1);
            //se cambia el antiguo nombre del request de la imagen
            $request->merge(['image_path' => $name1]);

            //se busca la foto anterior
            $image1 = public_path('img/habitaciones/') . $currentImage1;
            //se verifica si existe
            if (file_exists($image1)) {
                //se elimina
                @unlink($image1);
            }
        }

        $currentImage2 = $habitacion->image_path2;
        if ($request->image_path2 !=  $currentImage2) {
            $name2 = time() . '.' . explode('/', explode(':', substr($request->image_path2, 0, strpos($request->image_path2, ';')))[1])[1];
            Image::make($request->image_path2)->save(public_path('img/habitaciones/') . $name2);
            $request->merge(['image_path2' => $name2]);
            $image2 = public_path('img/habitaciones/') . $currentImage2;
            if (file_exists($image2)) {
                @unlink($image2);
            }
        }

        $currentImage3 = $habitacion->image_path3;
        if ($request->image_path3 !=  $currentImage3) {
            $name3 = time() . '.' . explode('/', explode(':', substr($request->image_path3, 0, strpos($request->image_path3, ';')))[1])[1];
            Image::make($request->image_path3)->save(public_path('img/habitaciones/') . $name3);
            $request->merge(['image_path3' => $name3]);
            $image3 = public_path('img/habitaciones/') . $currentImage3;
            if (file_exists($image3)) {
                @unlink($image3);
            }
        }

        $habitacion->numeroHabitacion = $request->numeroHabitacion;
        $habitacion->piso = $request->piso;
        $habitacion->capacidad = $request->capacidad;
        $habitacion->single = $request->single;
        $habitacion->doble = $request->doble;
        $habitacion->image_path = $request->image_path;
        $habitacion->image_path2 = $request->image_path2;
        $habitacion->image_path3 = $request->image_path3;
        $habitacion->estado = $request->estado;
        $habitacion->save();
        return $habitacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();
        return $habitacion;
    }

    public function getAllHabitaciones()
    {
        return Habitacion::orderBy('numeroHabitacion')->get();
    }

    public function cambiarEstado($id, $estado)
    {
        $habitacion = Habitacion::find($id);
        $habitacion->estadoLimpieza = $estado;
        $habitacion->save();

        return $habitacion;
    }

    public function guardarImagen($path)
    {
        //se verifica si es que se envio una nueva imagen por el request
        if ($path) {
            //nombre de la foto para que no se pueda duplicar
            $name = time() . '.' . explode('/', explode(':', substr($path, 0, strpos($path, ';')))[1])[1];
            //se guarda en public/img/habitaciones con el plugin image mananger
            Image::make($path)->save(public_path('img/habitaciones/') . $name);
            return $name;
        }
    }
}
