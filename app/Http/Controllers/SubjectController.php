<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isJson()) {
            $subjects = Subject::orderBy('name')->get();
            return response()->json($subjects, 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Teacher $teacher)
    {
        if($request->isJson()) {
            $rules = array(
                'name' => 'required|max:70',
                'description' => 'nullable'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                try {
                    $subject = Subject::create([
                        "teacher_id" => $teacher->id,
                        "name" => $data["name"],
                        "description" => isset($data["description"]) ? $data["description"] : null
                    ]);
                    return response()->json($subject, 201);
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
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Subject $subject)
    {
        if($request->isJson())
            return response()->json($subject, 200);

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher, Subject $subject)
    {
        if($request->isJson()) {
            $rules = array(
                'name' => 'required|max:70',
                'description' => 'nullable'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                try {
                    $subject->fill([
                        "teacher_id" => $teacher->id,
                        "name" => $data["name"],
                        "description" => isset($data["description"]) ? $data["description"] : null
                    ]);
                    $subject->save();
                    return response()->json($subject, 201);
                } catch (\Throwable $th) {
                    return response()->json(['error' => 'Ocurrió un error'], 400, []);
                }
            }
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Subject $subject)
    {
        if($request->isJson()) {
            $txt = "Subject delete {$subject->id}";
            $subject->delete();

            return response()->json(['message' => $txt], 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }
}
