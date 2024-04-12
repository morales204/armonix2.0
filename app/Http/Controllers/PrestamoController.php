<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input;

use App\Models\Prestamo;
use App\Models\DetallePrestamo;
use App\Models\DatosMateria;
use App\Models\Notificacion;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\PrestamoFormRequest; 

use PDF;
use App\Services\SendGridService;


class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $sendgridService;

    public function __construct(SendGridService $sendgridService)
    {
        $this->middleware('auth');
        $this->sendgridService = $sendgridService;
    }

    public function index(Request $request)
    { 
        $correo = auth()->user()->correo;
        $notificaciones = DB::table('notificaciones')
        ->select('mensaje')
        ->where('correo','=',$correo)
        ->get(); 

        if($request){
            //Trim quita los espacios
            $query=trim($request->get('texto'));
            $periodoInicio = $request->input('periodoInicio');
            $periodoFin = $request->input('periodoFin');

            $prestamosQuery = DB::table('prestamos as p')
            //UNION DE LA TABLAS STATUS
            ->join('status as s', 'p.status_id_status','=','s.id_status')
            //UNION DATOS MATERIA
            ->join('datos_materia as dm', 'p.datos_materia_id_datos_materia','=','dm.id_datos_materia')
            //UNION LABORATORIOS
            ->join('laboratorios as l', 'p.laboratorios_id_laboratorio','=','l.id_laboratorio')
            ->join('ubicacion as ubi', 'l.ubicacion_id_ubicacion','=','ubi.idubicacion')

            ->join('usuarios as u', 'p.usuarios_id_usuario','=','u.id_usuario')
            ->join('usuarios as ue', 'p.encargado_id_usuario','=','ue.id_usuario')

            ->join('materias as m', 'dm.materias_id_materia','=','m.id_materia')
            ->join('carreras as c', 'dm.carreras_id_carrera','=','c.id_carrera')

            ->select('p.id_prestamo','m.materia','dm.unidad_tematica','dm.introduccion',
            'dm.objetivo','dm.grado_grupo','c.nombre_carrera',
            'p.fecha_hora_inicio','p.fecha_hora_fin','p.no_practica','p.titulo_practica','p.fecha_prestamo',
            's.descripcion','l.nombre_laboratorio','ubi.ubicacion','u.nombre_completo as nombre_solicitante','u.correo','u.telefono','ue.nombre_completo as nombre_encargado',

            )
            ->where('u.nombre_completo','LIKE','%'.$query.'%')
            ->where ('p.status_id_status','=','2')  
            ->orderBy('p.id_prestamo','desc');
        }

            // Aplicar el filtro por período si se proporciona
        if ($periodoInicio && $periodoFin) {
            $prestamosQuery->whereBetween('p.fecha_prestamo', [$periodoInicio, $periodoFin]);
        }

        if (auth()->user()->roles_id_rol !== 1) {
            $userEmail = auth()->user()->correo;
            $prestamosQuery->where('u.correo', '=', $userEmail);
    
        }

        $prestamos=$prestamosQuery->paginate(3);

        foreach ($prestamos as $prestamo) {
            $prestamo->fecha = Carbon::parse($prestamo->fecha_prestamo)->toDateString();
            $prestamo->hora = Carbon::parse($prestamo->fecha_prestamo)->toTimeString();

            $prestamo->fecha_inicio = Carbon::parse($prestamo->fecha_hora_inicio)->toDateString();
            $prestamo->hora_inicio = Carbon::parse($prestamo->fecha_hora_inicio)->toTimeString();

            $prestamo->fecha_fin = Carbon::parse($prestamo->fecha_hora_fin)->toDateString();
            $prestamo->hora_fin = Carbon::parse($prestamo->fecha_hora_fin)->toTimeString();
            
             // Calcula la duración entre la hora de inicio y la hora de fin
            $duracion = Carbon::parse($prestamo->fecha_hora_fin)->diff(Carbon::parse($prestamo->fecha_hora_inicio));

            // Accede a los componentes de la duración (horas, minutos, segundos)
            $prestamo->duracion_horas = $duracion->h;
            /*$prestamo->duracion_minutos = $duracion->i;
            $prestamo->duracion_segundos = $duracion->s;*/

            $materiales = DB::table('detalle_prestamo as dp')
            ->join('materiales as m', 'dp.materiales_id_material', '=', 'm.id_material')
            ->join('volumenes as vol' , 'm.volumenes_id_volumen','=', 'vol.id_volumen')
            ->select('m.nombre_material', 'dp.cantidad_material','volumen')
            ->where('dp.prestamos_id_prestamo', '=', $prestamo->id_prestamo)
            ->whereNotNull('dp.materiales_id_material')
            ->whereNotNull('dp.cantidad_material')
            ->get();

            $prestamo->materiales = $materiales;

            $reactivos = DB::table('detalle_prestamo as dp')
            ->join('reactivos as r', 'dp.reactivos_id_reactivo', '=', 'r.id_reactivo')
            ->select('r.nombre_reactivo', 'dp.cantidad_reactivo')
            ->where('dp.prestamos_id_prestamo', '=', $prestamo->id_prestamo)
            ->whereNotNull('dp.reactivos_id_reactivo')
            ->whereNotNull('dp.cantidad_reactivo')
            ->get();

            $prestamo->reactivos = $reactivos;

        }
        
        return view ('prestamos.prestamo.index',["prestamos"=>$prestamos,"texto"=>$query,"periodoInicio"=>$periodoInicio,"periodoFin"=>$periodoFin]);

    }

    public function aceptarPrestamo($idPrestamo,$correo){
          
          try {
            // Actualizar el estado del préstamo a "Aceptado"
            $prestamo = Prestamo::findOrFail($idPrestamo);
            $prestamo->status_id_status = 3; // 3 es el ID para "Aceptado"
            $prestamo->save();



            // Verificar si el estado del préstamo se cambió correctamente
            if ($prestamo->status_id_status === 3) {
                    $notificacion = new Notificacion;
                    $notificacion->correo = $correo;
                    $notificacion->titulo='Tu prestamo ha sido aceptado';
                    $notificacion->mensaje='Tu prestamo con id: '.$prestamo->id_prestamo.' fue aceptada por el administrador por favor acude a las instalaciones con tu credencial o alguna identificacion oficial en mano para confirmar tu identidad';
                    $notificacion->estado='no leido';
                    $notificacion->save();

                    $htmlContent = "<h1>$notificacion->mensaje</h1>";
    
                    //Se envia la notificacion al correo electronico del usuario
                   // $response = $this->sendgridService->send($correo, 'Tu prestamo a sido aceptado', $htmlContent);

                return redirect()->back()->with('success', 'El préstamo ha sido aceptado exitosamente.');
            } else {
                // El cambio no se realizó correctamente
                return redirect()->back()->with('error', 'Hubo un problema al aceptar el préstamo. Por favor, inténtalo de nuevo.');
            }
        } catch (\Exception $e) {
            // Manejar el error de conexión a la base de datos
            return redirect()->back()->with('error', 'Hubo un problema al conectar con la base de datos. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    public function rechazarPrestamo($idPrestamo, $correo){
        try {
            // Actualizar el estado del préstamo a "Aceptado"
            $prestamo = Prestamo::findOrFail($idPrestamo);
            $prestamo->status_id_status = 1; // 3 es el ID para "Aceptado"
            $prestamo->save();
    
            // Verificar si el estado del préstamo se cambió correctamente
            if ($prestamo->status_id_status === 1) {

                $notificacion = new Notificacion;
                $notificacion->correo = $correo;
                $notificacion->titulo='Tu prestamo ha sido rechazado';
                $notificacion->mensaje='Tu prestamo a sido reachazado debido a que: ';
                $notificacion->estado='no leido';
                $notificacion->save();
                // El cambio se realizó correctamente
                return redirect()->back()->with('success', 'El préstamo ha sido rechazado correctamente.');
            } else {
                // El cambio no se realizó correctamente
                return redirect()->back()->with('error', 'Hubo un problema al aceptar el préstamo. Por favor, inténtalo de nuevo.');
            }
        } catch (\Exception $e) {
            // Manejar el error de conexión a la base de datos
            return redirect()->back()->with('error', 'Hubo un problema al conectar con la base de datos. Por favor, inténtalo de nuevo más tarde.');
        }
    }

    public function historial(Request $request){
        if($request){
            //Trim quita los espacios
            $query=trim($request->get('texto'));
            $periodoInicio = $request->input('periodoInicio');
            $periodoFin = $request->input('periodoFin');

            $prestamosQuery = DB::table('prestamos as p')
            //UNION DE LA TABLAS STATUS
            ->join('status as s', 'p.status_id_status','=','s.id_status')
            //UNION DATOS MATERIA
            ->join('datos_materia as dm', 'p.datos_materia_id_datos_materia','=','dm.id_datos_materia')
            //UNION LABORATORIOS
            ->join('laboratorios as l', 'p.laboratorios_id_laboratorio','=','l.id_laboratorio')
            ->join('ubicacion as ubi', 'l.ubicacion_id_ubicacion','=','ubi.idubicacion')

            ->join('usuarios as u', 'p.usuarios_id_usuario','=','u.id_usuario')
            ->join('usuarios as ue', 'p.encargado_id_usuario','=','ue.id_usuario')

            ->join('materias as m', 'dm.materias_id_materia','=','m.id_materia')
            ->join('carreras as c', 'dm.carreras_id_carrera','=','c.id_carrera')

            ->select('p.id_prestamo','m.materia','dm.unidad_tematica','dm.introduccion',
            'dm.objetivo','dm.grado_grupo','c.nombre_carrera',
            'p.fecha_hora_inicio','p.fecha_hora_fin','p.no_practica','p.titulo_practica','p.fecha_prestamo',
            's.descripcion','l.nombre_laboratorio','ubi.ubicacion','u.nombre_completo as nombre_solicitante','u.correo','u.telefono','ue.nombre_completo as nombre_encargado',

            )
            ->where('u.nombre_completo','LIKE','%'.$query.'%')
            ->where ('p.status_id_status','!=','2')
            ->orderBy('p.id_prestamo','desc');

        }
        // Aplicar el filtro por período si se proporciona
        if ($periodoInicio && $periodoFin) {
            $prestamosQuery->whereBetween('p.fecha_prestamo', [$periodoInicio, $periodoFin]);
        }

        if (auth()->user()->roles_id_rol !== 1) {
            $userEmail = auth()->user()->correo;
            $prestamosQuery->where('u.correo', '=', $userEmail);
        }
            
        $prestamos=$prestamosQuery->paginate(2);

        foreach ($prestamos as $prestamo) {
            $prestamo->fecha = Carbon::parse($prestamo->fecha_prestamo)->translatedFormat('d \de F Y');
            $prestamo->hora = Carbon::parse($prestamo->fecha_prestamo)->format('h:i A');

            $prestamo->fecha_inicio = Carbon::parse($prestamo->fecha_hora_inicio)->translatedFormat('d \de F Y');;
            $prestamo->hora_inicio = Carbon::parse($prestamo->fecha_hora_inicio)->format('h:i A');

            $prestamo->fecha_fin = Carbon::parse($prestamo->fecha_hora_fin)->translatedFormat('d \de F Y');;
            $prestamo->hora_fin = Carbon::parse($prestamo->fecha_hora_fin)->format('h:i A');
            
             // Calcula la duración entre la hora de inicio y la hora de fin
            $duracion = Carbon::parse($prestamo->fecha_hora_fin)->diff(Carbon::parse($prestamo->fecha_hora_inicio));

            // Accede a los componentes de la duración (horas, minutos, segundos)
            $prestamo->duracion_horas = $duracion->h;
            /*$prestamo->duracion_minutos = $duracion->i;
            $prestamo->duracion_segundos = $duracion->s;*/

            $materiales = DB::table('detalle_prestamo as dp')
            ->join('materiales as m', 'dp.materiales_id_material', '=', 'm.id_material')
            ->join('volumenes as vol' , 'm.volumenes_id_volumen','=', 'vol.id_volumen')
            ->select('m.nombre_material', 'dp.cantidad_material','volumen')
            ->where('dp.prestamos_id_prestamo', '=', $prestamo->id_prestamo)
            ->whereNotNull('dp.materiales_id_material')
            ->whereNotNull('dp.cantidad_material')
            ->get();

            $prestamo->materiales = $materiales;

            $reactivos = DB::table('detalle_prestamo as dp')
            ->join('reactivos as r', 'dp.reactivos_id_reactivo', '=', 'r.id_reactivo')
            ->select('r.nombre_reactivo', 'dp.cantidad_reactivo')
            ->where('dp.prestamos_id_prestamo', '=', $prestamo->id_prestamo)
            ->whereNotNull('dp.reactivos_id_reactivo')
            ->whereNotNull('dp.cantidad_reactivo')
            ->get();

            $prestamo->reactivos = $reactivos;

        }

                    // Verificar si se solicita generar un PDF
    if ($request->has('pdf')) {
        
        // Cargar la vista PDF con los datos
        $pdf = PDF::loadView('prestamos.prestamo.reportePrestamo', [
            "prestamos" => $prestamos,
        ]);

        // Retornar el PDF para su descarga
        return $pdf->download('historial_prestamos.pdf');
    }
        
        return view ('prestamos.prestamo.historial',["prestamos"=>$prestamos,"texto"=>$query,"periodoInicio"=>$periodoInicio,"periodoFin"=>$periodoFin]);

    }

    public function pdf(Request $request){
        $periodoInicio = $request->input('periodoInicio');
        $periodoFin = $request->input('periodoFin');

        $prestamosQuery = DB::table('prestamos as p')
        //UNION DE LA TABLAS STATUS
        ->join('status as s', 'p.status_id_status','=','s.id_status')
        //UNION DATOS MATERIA
        ->join('datos_materia as dm', 'p.datos_materia_id_datos_materia','=','dm.id_datos_materia')
        //UNION LABORATORIOS
        ->join('laboratorios as l', 'p.laboratorios_id_laboratorio','=','l.id_laboratorio')
        ->join('ubicacion as ubi', 'l.ubicacion_id_ubicacion','=','ubi.idubicacion')

        ->join('usuarios as u', 'p.usuarios_id_usuario','=','u.id_usuario')
        ->join('usuarios as ue', 'p.encargado_id_usuario','=','ue.id_usuario')

        ->join('materias as m', 'dm.materias_id_materia','=','m.id_materia')
        ->join('carreras as c', 'dm.carreras_id_carrera','=','c.id_carrera')



        ->select('p.id_prestamo','m.materia','dm.unidad_tematica','dm.introduccion',
        'dm.objetivo','dm.grado_grupo','c.nombre_carrera',
        'p.fecha_hora_inicio','p.fecha_hora_fin','p.no_practica','p.titulo_practica','p.fecha_prestamo',
        's.descripcion','l.nombre_laboratorio','ubi.ubicacion','u.nombre_completo as nombre_solicitante','ue.nombre_completo as nombre_encargado',

        )
       /* ->where ('p.status_id_status','=','2')*/
        ->orderBy('p.id_prestamo','desc')
        ->where ('p.status_id_status','!=','2');

        // Aplicar el filtro por período si se proporciona
        if ($periodoInicio && $periodoFin) {
            $prestamosQuery->whereBetween('p.fecha_prestamo', [$periodoInicio, $periodoFin]);
        }

        $prestamos=$prestamosQuery->paginate(3);

        foreach ($prestamos as $prestamo) {
            $prestamo->fecha = Carbon::parse($prestamo->fecha_prestamo)->toDateString();
            $prestamo->hora = Carbon::parse($prestamo->fecha_prestamo)->toTimeString();

            $prestamo->fecha_inicio = Carbon::parse($prestamo->fecha_hora_inicio)->toDateString();
            $prestamo->hora_inicio = Carbon::parse($prestamo->fecha_hora_inicio)->toTimeString();

            $prestamo->fecha_fin = Carbon::parse($prestamo->fecha_hora_fin)->toDateString();
            $prestamo->hora_fin = Carbon::parse($prestamo->fecha_hora_fin)->toTimeString();
            
             // Calcula la duración entre la hora de inicio y la hora de fin
            $duracion = Carbon::parse($prestamo->fecha_hora_fin)->diff(Carbon::parse($prestamo->fecha_hora_inicio));

            // Accede a los componentes de la duración (horas, minutos, segundos)
            $prestamo->duracion_horas = $duracion->h;
            /*$prestamo->duracion_minutos = $duracion->i;
            $prestamo->duracion_segundos = $duracion->s;*/

            $materiales = DB::table('detalle_prestamo as dp')
            ->join('materiales as m', 'dp.materiales_id_material', '=', 'm.id_material')
            ->join('volumenes as vol' , 'm.volumenes_id_volumen','=', 'vol.id_volumen')
            ->select('m.nombre_material', 'dp.cantidad_material','volumen')
            ->where('dp.prestamos_id_prestamo', '=', $prestamo->id_prestamo)
            ->whereNotNull('dp.materiales_id_material')
            ->whereNotNull('dp.cantidad_material')
            ->get();

            $prestamo->materiales = $materiales;

            $reactivos = DB::table('detalle_prestamo as dp')
            ->join('reactivos as r', 'dp.reactivos_id_reactivo', '=', 'r.id_reactivo')
            ->select('r.nombre_reactivo', 'dp.cantidad_reactivo')
            ->where('dp.prestamos_id_prestamo', '=', $prestamo->id_prestamo)
            ->whereNotNull('dp.reactivos_id_reactivo')
            ->whereNotNull('dp.cantidad_reactivo')
            ->get();

            $prestamo->reactivos = $reactivos;

        }
        $pdf = PDF::loadView('prestamos.prestamo.reportePrestamo',['prestamos'=>$prestamos]);
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
       // return view ('prestamos.prestamo.reportePrestamo',compact('prestamos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* $material=Material::all();
        $volumenes=DB::table('volumenes as v')
        ->select('id_volumen','v.volumen')
        ->where('v.estatus', '=','1')
        ->get(); */
        $materias=DB::table('materias')->get();
        $carreras=DB::table('carreras')->get();
        $responsable=DB::table('usuarios')->where('roles_id_rol','=','3')->get();
        $laboratorios=DB::table('laboratorios')->get();
        $materiales=DB::table('materiales as m')
        ->join('volumenes as vol','m.volumenes_id_volumen','=','vol.id_volumen')
        ->select(DB::raw('CONCAT(m.nombre_material," ",vol.volumen) AS material'),'m.id_material','m.cantidad_disponible')
        ->where('cantidad_disponible','>','0')
        ->get();
        $reactivos=DB::table('reactivos as r')
        ->select('r.nombre_reactivo','r.id_reactivo','r.cantidad_disponible')
        ->where('r.cantidad_disponible','>','0')
        ->where('r.estatus','=','1')
        ->get();


        $fechasHora = DB::table('prestamos as p')
            ->select('p.fecha_hora_inicio', 'p.fecha_hora_fin')
            ->get();
        
        $fechas = [];
        
        foreach ($fechasHora as $f) {
            $fecha_inicio = Carbon::parse($f->fecha_hora_inicio)->toDateString();
            $hora_inicio = Carbon::parse($f->fecha_hora_inicio)->toTimeString();
            $fecha_fin = Carbon::parse($f->fecha_hora_fin)->toDateString();
            $hora_fin = Carbon::parse($f->fecha_hora_fin)->toTimeString();
        
            $fechas[] = [
                'fecha_inicio' => $fecha_inicio,
                'hora_inicio' => $hora_inicio,
                'fecha_fin' => $fecha_fin,
                'hora_fin' => $hora_fin,
            ];
        }



        return view('prestamos.prestamo.create' ,[
            "materias"=>$materias,
            "carreras"=>$carreras,
            'responsables'=>$responsable,
            'laboratorios'=>$laboratorios,
            'materiales'=>$materiales,
            'reactivos'=>$reactivos,
            'fechas'=>$fechas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrestamoFormRequest $request)
    {
        try{
            DB::beginTransaction();
            $datosMateria=new DatosMateria;
            $datosMateria->materias_id_materia=$request->get('materia');
            $datosMateria->unidad_tematica=$request->get('unidad_tematica');
            $datosMateria->introduccion=$request->get('introduccion');
            $datosMateria->objetivo=$request->get('objetivo');
            $grado=$request->get('grado');
            $grupo=$request->get('grupo');
            $datosMateria->grado_grupo=$grado.'-'.$grupo;
            $datosMateria->carreras_id_carrera=$request->get('carrera');
            $datosMateria->save();


            $prestamo=new Prestamo;
            $prestamo->datos_materia_id_datos_materia=$datosMateria->id_datos_materia;
            $fechaInicio=$request->get('fecha_inicio');
            $horaInicio=$request->get('hora_inicio');
            $prestamo->fecha_hora_inicio = $fechaInicio.' '.$horaInicio;
            $fechaFin=$request->get('fecha_fin');
            $horaFin=$request->get('hora_fin');
            $prestamo->fecha_hora_fin = $fechaFin.' '.$horaFin;
            $prestamo->no_practica = $request->get('numero_practica');
            $prestamo->titulo_practica=$request->get('titulo_practica');
            $prestamo->fecha_prestamo=Carbon::now();
            $prestamo->status_id_status=2;
            $prestamo->laboratorios_id_laboratorio=$request->get('laboratorio');
            $prestamo->usuarios_id_usuario=auth()->user()->id_usuario;
            $prestamo->encargado_id_usuario=$request->get('responsable');
            $prestamo->save();


            $id_material = $request->input('idMaterial');
            $cantidad_material= $request->get('cantidadMaterial');

            $id_reactivo =  $request->input('idReactivo');
            $cantidad_reactivo= $request->get('cantidadReactivo');

            if (!is_null($id_material) && count($id_material) > 0) {
                $contMaterial = 0;
            
                while ($contMaterial < count($id_material)) {
                    $detalle = new DetallePrestamo();
                    $detalle->prestamos_id_prestamo = $prestamo->id_prestamo;
                    $detalle->cantidad_material = $cantidad_material[$contMaterial];
                    $detalle->materiales_id_material = $id_material[$contMaterial];
                    $detalle->save();
                    $contMaterial++;
                }
            }
            
            if (!is_null($id_reactivo) && count($id_reactivo) > 0) {
                $contReactivo = 0;
            
                while ($contReactivo < count($id_reactivo)) {
                    $detalle = new DetallePrestamo();
                    $detalle->prestamos_id_prestamo = $prestamo->id_prestamo;
                    $detalle->cantidad_reactivo = $cantidad_reactivo[$contReactivo];
                    $detalle ->reactivos_id_reactivo=$id_reactivo[$contReactivo];

                    $detalle->save();
                    $contReactivo++;
                }
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('prestamo.store')->with('error', 'Ocurrio un error durante el proceso por favor intente de nuevo o pongase en contacto con el administrador');;
        }

        return redirect()->route('prestamo.index')->with('success', 'Su solicitud se a enviado exitosamente');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
