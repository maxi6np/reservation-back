<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservaCollection;
use App\Models\Mesa;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relaciones = ['mesa', 'cliente'];
        $reservas = Reserva::with($relaciones)->get();

        return new ReservaCollection($reservas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'fecha_reserva' => 'required',
                'cantidad_personas' => 'required',
                'hora_reserva' => 'required',
                'id_reserva' => 'required',
                'cliente' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $existClient = User::where('email', $request->cliente['email'])->first();
            $ids_mesas = Mesa::pluck('id_mesa')->toArray();

            if ($existClient) {

                $reserva = Reserva::create([
                    'id_reserva' => $request->id_reserva,
                    'id_mesa' => Arr::random($ids_mesas),
                    'id_cliente' => $existClient->id,
                    'fecha_reserva' => $request->fecha_reserva,
                    'hora_reserva' => $request->hora_reserva,
                    'cantidad_personas' => $request->cantidad_personas,
                    'estado_reserva' => 'Pendiente'
                ]);

                $reserva->save();
            } else{
                $newClient = User::create([
                    'email' => $request->cliente['email'],
                    'name' => $request->cliente['nombre'],
                    'password' => Hash::make('constraseña'),
                ]);

                $newClient->save();

                $reserva = Reserva::create([
                    'id_reserva' => $request->id_reserva,
                    'id_mesa' => Arr::random($ids_mesas),
                    'id_cliente' => $newClient->id,
                    'fecha_reserva' => $request->fecha_reserva,
                    'hora_reserva' => $request->hora_reserva,
                    'cantidad_personas' => $request->cantidad_personas,
                    'estado_reserva' => 'Pendiente'
                ]);
            }

            return response()->json(['message' => 'Reserva creada correctamente', $reserva], 201);
        } catch (\Illuminate\Database\QueryException $exception) {
            return response()->json(['message' => 'Error al procesar la solicitud', $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_reserva)
    {
        $reservaSeleccionada = Reserva::find($id_reserva);

        if (!$reservaSeleccionada) return response()->json(['message' => 'Reserva no encontrada'], 404);


        if ($reservaSeleccionada->delete()) {
            return response()->json(['message' => 'Reserva eliminada correctamente'], 200);
        } else {
            return response()->json(['message' => 'Error al eliminar la reserva'], 500);
        }
    }
}
