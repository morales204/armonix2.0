@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $course->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('instrumentos.index') }}">Cursos</a></li>
                    
                    <li class="breadcrumb-item active">{{ $course->name }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">{{ $course->name }}</h3>
            </div>

            <div class="card-body">
                <h5><strong>Descripción del Curso:</strong></h5>
                <p class="text-muted">{{ $course->description }}</p>

                <h5><strong>Duración:</strong></h5>
                <p>{{ $course->duration }} horas</p>

                <h5><strong>Instructor:</strong></h5>
                <p>{{ $course->instructor }}</p>

                <hr>

                <h4 class="mt-4">Contenidos del Curso</h4>

                @if($courseContents->isEmpty())
                <p class="text-muted">No hay contenidos disponibles para este curso.</p>
                @else
                @foreach($courseContents as $content)
                <div class="card my-3 shadow-sm" style="border-left: 5px solid #007bff;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $content->title }}</h5>
                        <p class="card-text">{{ $content->content }}</p>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </div>
</section>
@endsection