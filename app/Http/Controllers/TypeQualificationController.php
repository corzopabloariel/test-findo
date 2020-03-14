<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\TypeQualification;
use Illuminate\Http\Request;

class TypeQualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isJson()) {
            $types = TypeQualification::orderBy('name')->get();
            return response()->json($types, 200);
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
                'name' => 'required|max:40'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                //try {
                    $type_qualification = TypeQualification::create([
                        "name" => $data["name"]
                    ]);
                    return response()->json($type_qualification, 201);
                /*} catch (\Throwable $th) {
                    return response()->json(['error' => 'Ocurrió un error'], 400, []);
                }*/
            }
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeQualification  type_qualification
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TypeQualification $type_qualification)
    {
        if($request->isJson())
            return response()->json($type_qualification, 200);

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeQualification  type_qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeQualification $type_qualification)
    {
        if($request->isJson()) {
            $rules = array(
                'name' => 'required|max:40'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                $type_qualification->fill([
                    'name' => $data["name"]
                ]);
                $type_qualification->save();
                return response()->json($type_qualification, 200);
            }
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeQualification  type_qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TypeQualification $type_qualification)
    {
        if($request->isJson()) {
            $txt = "Type Qualification delete {$type_qualification->id}";
            $type_qualification->delete();

            return response()->json(['message' => $txt], 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }
}
