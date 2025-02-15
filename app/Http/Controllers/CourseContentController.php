<?php

namespace App\Http\Controllers;

use App\Models\CourseContent;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    /**
     * Muestra los contenidos de un curso en una vista Blade.
     */
    public function showContents($courseId)
{
    $course = Course::findOrFail($courseId);
    $courseContents = CourseContent::where('course_id', $courseId)->get();

    return view('admin.cursos.cursosdetalles', compact('course', 'courseContents')); // Pasando 'courseContents' en lugar de 'contents'
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
        $content = CourseContent::findOrFail($id);
        $content->update($request->all());

        return response()->json($content);
    }

    /**
     * Elimina un contenido de curso.
     */
    public function destroy($id)
    {
        CourseContent::findOrFail($id)->delete();
        return response()->json(['message' => 'Contenido eliminado']);
    }

    public function showCourseContents($courseId)
{
    return $this->showContents($courseId);
}

}
