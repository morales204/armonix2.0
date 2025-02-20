<?php

namespace App\Http\Controllers;

use App\Models\CourseContent;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Instrument;

class CourseContentController extends Controller
{
    public function showContents($courseId)
    {
        $course = Course::findOrFail($courseId);
        $courseContents = CourseContent::where('course_id', $courseId)->get();

        if (request()->ajax()) {
            $html = view('admin.cursos.course_contents', compact('course', 'courseContents'))->render();

            return response()->json([
                'html' => $html,
                'data' => [
                    'course' => [
                        'name' => $course->name,
                        'description' => $course->description,
                    ],
                    'courseContents' => $courseContents->map(function ($content) {
                        return [
                            'title' => $content->title,
                            'content' => $content->content,
                        ];
                    })
                ]
            ]);
        }

        return view('admin.cursos.cursosdetalles', compact('course', 'courseContents'));
    }




    public function index($courseId)
    {
        $contents = CourseContent::where('course_id', $courseId)->get();
        return response()->json($contents);
    }

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

    public function show($id)
    {
        return response()->json(CourseContent::findOrFail($id));
    }

    public function edit($id)
    {

        $curso = Course::find($id);

        if (!$curso) {
            return redirect()->route('admin.cursos.cursoslist')->with('error', 'Curso no encontrado.');
        }


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
            return response()->json(['success' => false, 'message' => 'Curso no encontrado.'], 404);
        }

        // Eliminar imagen si existe
        if ($curso->image && file_exists(public_path($curso->image))) {
            unlink(public_path($curso->image));
        }

        $curso->delete();

        return response()->json(['success' => true, 'message' => 'Curso eliminado correctamente.']);
    }
}
