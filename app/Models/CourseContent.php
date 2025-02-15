<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;

    protected $table = 'course_contents'; // Asegura que coincida con la tabla en la base de datos

    protected $fillable = ['course_id', 'title', 'content'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
