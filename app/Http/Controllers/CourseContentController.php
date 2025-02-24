<?php

namespace App\Http\Controllers;

use App\Models\CourseContent;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Instrument;

class CourseContentController extends Controller
{
    /**
     * Muestra los contenidos de un curso en una vista Blade.
     */
    public function showContents(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $courseContents = CourseContent::where('course_id', $courseId)->paginate(9);

        // Si la solicitud es AJAX, devolver JSON en lugar de una vista Blade
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.cursos.course_contents', compact('course', 'courseContents'))->render(),
                'course' => $course,
                'courseContents' => $courseContents,
            ]);
        }

        return view('admin.cursos.cursosdetalles', compact('course', 'courseContents'));
    }

    /**
     * Devuelve los contenidos de un curso en formato JSON.
     */
    public function index($courseId)
    {
        $contents = CourseContent::where('course_id', $courseId)->get();
        return response()->json($contents);
    }

    /**
     * Almacena un nuevo contenido de curso.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $content = CourseContent::create($request->all());
        return response()->json($content, 201);
    }

    /**
     * Muestra un contenido específico.
     */
    public function show($id)
    {
        return response()->json(CourseContent::findOrFail($id));
    }

    /**
     * Actualiza un contenido de curso existente.
     */
    public function update(Request $request, $id)
    {
        $courseContent = CourseContent::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $courseContent->update($request->all());
        return response()->json($courseContent);
    }

    /**
     * Elimina un contenido de curso.
     */
    public function destroy($id)
    {
        $courseContent = CourseContent::find($id);
        if (!$courseContent) {
            return response()->json(['success' => false, 'message' => 'Contenido no encontrado.'], 404);
        }

        $courseContent->delete();
        return response()->json(['success' => true, 'message' => 'Contenido eliminado correctamente.']);
    }
}