<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isJson()) {
            $students = Student::with('person')->get();
            return response()->json($students, 200);
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
                'docket'  => 'required|unique:students'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                try {
                    $person = (new PersonController)->store($request);
                    $person_obj = json_decode($person->content());
                    $student = Student::create([
                        "person_id" => $person_obj->id,
                        "docket" => $data["docket"]
                    ]);
                    return response()->json($student, 201);
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student[ "person" ] = $student->person;
        return response()->json($student, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
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
                $person = (new PersonController)->update($request, $student->person);

                return response()->json($student, 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $txt = "Student delete {$student->id}";
        $student->person->delete();

        return response()->json(['success' => $txt], 200);
    }
}
