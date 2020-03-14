<?php

namespace App\Http\Controllers;

use App\Student_Subject;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isJson()) {
            $elements = Student_Subject::with('student')->with('subject')->get();
            return response()->json($elements, 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student, Subject $subject)
    {
        if($request->isJson()) {
            $data = Student_Subject::where("student_id", $student->id)->where("subject_id", $subject->id)->first();
            if(!$data) {
                $element = Student_Subject::create([
                    "student_id" => $student->id,
                    "subject_id" => $subject->id
                ]);
                return response()->json($element, 201);
            } else
                return response()->json(['message' => "Alumno {$student->name()} ya inscripto en {$subject->name}"], 406);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student_Subject  $student_Subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Student_Subject $student_subject)
    {
        if($request->isJson()) {
            $txt = "Element delete {$student_subject->id}";
            $student_subject->delete();

            return response()->json(['message' => $txt], 200);
        }

        return response()->json(['error' => 'Sin autorización'], 401, []);
    }
}
