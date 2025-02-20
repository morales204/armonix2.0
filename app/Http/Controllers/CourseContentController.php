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
    
        if ($request->ajax()) {
            return view('admin.cursos.course_contents', compact('course','courseContents'));
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
    public function edit($id)
{
    // Buscar el curso con el ID proporcionado
    $curso = Course::find($id);

    // Si el curso no existe, redirigir con un mensaje de error
    if (!$curso) {
        return redirect()->route('admin.cursos.cursoslist')->with('error', 'Curso no encontrado.');
    }

    // Obtener todos los instrumentos disponibles
    $instruments = Instrument::all();

    // Retornar la vista con los datos
    return view('admin.cursos.edit', compact('curso', 'instruments'));
}

public function update(Request $request, $id)
{
    $curso = Course::find($id);
    if (!$curso) {
        return redirect()->route('admin.cursos.cursoslist')->with('error', 'Curso no encontrado.');
    }

    $request->validate([
        'instrument_id' => 'required|exists:instruments,id',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $curso->instrument_id = $request->instrument_id;
    $curso->name = $request->name;
    $curso->description = $request->description;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('cursos', 'public');
        $curso->image = 'storage/' . $imagePath;
    }

    $curso->save();

    return redirect()->route('admin.cursos.cursoslist')->with('success', 'Curso actualizado correctamente.');
}
public function destroy($id)
{
    $curso = Course::find($id);
    if (!$curso) {
        return redirect()->route('admin.cursos.cursoslist')->with('error', 'Curso no encontrado.');
    }

    // Eliminar imagen si existe
    if ($curso->image && file_exists(public_path($curso->image))) {
        unlink(public_path($curso->image));
    }

    $curso->delete();

    return redirect()->route('admin.cursos.cursoslist')->with('success', 'Curso eliminado correctamente.');
}

}
