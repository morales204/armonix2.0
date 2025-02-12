<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    // Relación con los instrumentos (si existe)
    public function instruments()
    {
        return $this->hasMany(Instrument::class);
    }

    //scope
    public function scopeFilter($query, $search, $category, $instrumentName)
    {
        return $query->when($search, function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })
            ->when($category, function ($q) use ($category) {
                $q->where('category', $category);
            })
            ->when($instrumentName, function ($q) use ($instrumentName) {
                $q->where('name', $instrumentName);
            });
    }
    
    
}
