<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isJson()) {
            $teachers = Teacher::with('person')->get();
            return response()->json($teachers, 200);
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
                'id_number' => 'required',
                'name' => 'required|max:70',
                'last_name' => 'required|max:90',
                'date_birth' => 'required|nullable|date',
                'date' => 'nullable|date',
                'docket'  => 'required|unique:teachers'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                try {
                    $person = (new PersonController)->store($request);
                    $person_obj = json_decode($person->content());
                    $teacher = Teacher::create([
                        "person_id" => $person_obj->id,
                        "docket" => $data["docket"],
                        "date" => $data["date"]
                    ]);
                    return response()->json($teacher, 201);
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
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Request $requset, Teacher $teacher)
    {
        if($request->isJson()) {
            $teacher[ "person" ] = $teacher->person;
            return response()->json($teacher, 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        if($request->isJson()) {
            $rules = array(
                'name' => 'required|max:70',
                'last_name' => 'required|max:90',
                'date_birth' => 'required|nullable|date',
                'date' => 'nullable|date',
                'docket'  => 'required|unique:teachers'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                $person = (new PersonController)->update($request, $teacher->person);
                $teacher->fill([
                    'date' => $data["date"],
                    'docket' => $data["docket"]
                ]);
                $teacher->save();
                return response()->json($teacher, 200);
            }
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Teacher $teacher)
    {
        if($request->isJson()) {
            $txt = "Teacher delete {$teacher->id}";
            $teacher->person->delete();

            return response()->json(['message' => $txt], 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }
}
