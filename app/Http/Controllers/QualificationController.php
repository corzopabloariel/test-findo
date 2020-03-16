<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use DB;
use App\Qualification;
use App\Student_Subject;
use App\Student;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isJson()) {
            $qualifications = Qualification::with('studentsubject')->with('type')->get();
            return response()->json($qualifications, 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student_Subject $student_subject)
    {
        if($request->isJson()) {
            $rules = array(
                'note' => 'required',
                'date' => 'required|date'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                $aux = Qualification::where("studentsubject_id", $student_subject->id)
                        ->where("type_id",1)
                        ->where("date",$data["date"])
                        ->first();
                if(!$aux) {
                    $element = Qualification::create([
                        "studentsubject_id" => $student_subject->id,
                        "type_id" => 1,
                        "note" => $data["note"],
                        "date" => $data["date"]
                    ]);
                    return response()->json($element, 201);
                } else
                    return response()->json(['message' => "Alumno {$student_subject->student->name()} ya registro calificación en {$student_subject->subject->name} el día {$data["date"]}"], 406);
            }
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Qualification $qualification)
    {
        if($request->isJson()) {
            $qualification["type"] = $qualification->type;
            $qualification["student"] = $qualification->student();
            $qualification["subject"] = $qualification->subject();
            return response()->json($qualification, 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qualification $qualification)
    {
        if($request->isJson()) {
            $rules = array(
                'note' => 'required',
                'date' => 'required|date'
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => 'Datos no válidos'], 406, []);
            } else {
                $data = $request->json()->all();
                $qualification->fill([
                    "note" => $data["note"],
                    "date" => $data["date"]
                ]);
                $qualification->save();
                return response()->json($qualification, 201);
            }
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Qualification $qualification)
    {
        if($request->isJson()) {
            $txt = "Qualifications delete {$qualification->id}";
            $student->person->delete();

            return response()->json(['message' => $txt], 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Realizar un endpoint que devuelva las calificaciones de un alumno en particular
     */
    public function student(Request $request, Student $student)
    {
        if($request->isJson()) {
            $elements = DB::table("qualifications")
                ->join('student__subject', 'student__subject.id', '=', 'qualifications.studentsubject_id')
                ->join('subjects', 'subjects.id', '=', 'student__subject.subject_id')
                ->where('student__subject.student_id', $student->id)
                ->select('qualifications.date','qualifications.note','subjects.name')
                ->get();
            return response()->json($elements, 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Realizar un endpoint que devuelva el promedio histórico por materia.
     */
    public function history(Request $request)
    {
        if($request->isJson()) {
            $elements = DB::table("qualifications")
                ->join('student__subject', 'student__subject.id', '=', 'qualifications.studentsubject_id')
                ->join('subjects', 'subjects.id', '=', 'student__subject.subject_id')
                ->groupBy( 'student__subject.subject_id' )
                ->select( 'subjects.name',DB::raw( 'AVG( qualifications.note ) AS average'),DB::raw('count(*) AS total'))
                ->get();
            return response()->json($elements, 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }
}
