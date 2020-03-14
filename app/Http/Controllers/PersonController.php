<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isJson()) {
            $persons = Person::all();
            return response()->json($persons, 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isJson()) {
            $rules = array(
                'id_number' => 'required|unique:persons',
                'name' => 'required|max:70',
                'last_name' => 'required|max:90',
                'date_birth' => 'required|nullable|date'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                try {
                    $person = Person::create([
                        "id_number" => $data["id_number"],
                        "name" => $data["name"],
                        "last_name" => $data["last_name"],
                        "date_birth" => $data["date_birth"]
                    ]);
                    return response()->json($person, 201);
                } catch (\Throwable $th) {
                    return response()->json(['error' => 'Ocurrió un error'], 400, []);
                }
            }
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return response()->json($person, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        if($request->isJson()) {
            $rules = array(
                'name' => 'required|max:70',
                'last_name' => 'required|max:90',
                'date_birth' => 'required|nullable|date'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                $person->fill([
                    "name" => $data["name"],
                    "last_name" => $data["last_name"],
                    "date_birth" => $data["date_birth"]
                ]);
                $person->save();

                return response()->json($person, 200);
            }
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $txt = "Person delete {$person->id}";
        $person->delete();

        return response()->json(['success' => $txt], 200);
    }
}
