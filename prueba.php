controlador 



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo; // Asegúrate de que el modelo esté bien referenciado

class ModulosController extends Controller
{
    public function index()
    {
        $categories = Modulo::whereNull('parent_id')
            ->with('children') // Cargar las subcategorías
            ->get();
        
        ($categories); // Verifica que las categorías y subcategorías se obtienen correctamente
        
        return view('layouts.admin', compact('categories'));
    }
    
}


modelo

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'modulos'; // Nombre correcto de la tabla
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'tipo',
        'parent_id',
    ];

    // Relación con la categoría principal (si es una subcategoría)
    public function parent()
    {
        return $this->belongsTo(Modulo::class, 'parent_id');
    }

    // Relación con las subcategorías (si es una categoría principal)
    public function children()
    {
        return $this->hasMany(Modulo::class, 'parent_id')
            ->whereNotNull('parent_id') // Solo subcategorías
            ->where('tipo', 'Subcategoria'); // Asegúrate de que el tipo sea 'Subcategoria'
    }
    
}


Virtua 

@if (auth()->user()->roles_id_rol === 2)
    @if (isset($categories) && count($categories) > 0)
        @foreach ($categories as $category)
            <li class="nav-item {{ request()->is(strtolower($category->nombre) . '/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                        {{ $category->nombre }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @foreach ($subcategories as $subcategory)
                        @if ($subcategory->parent_id === $category->id)
                            <li class="nav-item">
                                <a href="{{ route(strtolower($subcategory->nombre)) }}" 
                                    class="nav-link {{ request()->is(strtolower($subcategory->nombre)) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chevron-right"></i>
                                    <p>{{ $subcategory->nombre }}</p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
    @else
        <p class="text-muted">No hay categorías disponibles.</p>
    @endif
@endif