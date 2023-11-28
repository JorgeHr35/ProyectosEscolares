<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Proyecto;
use App\Models\Materia;
use Illuminate\Http\Request;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
//se Barryvdh\DomPDF\Facade as PDF;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectosPendientes = Proyecto::where('status', 'Pendiente')->orderBy('created_at', 'desc')->paginate();
        $proyectosCompletados = Proyecto::where('status', 'Completado')->orderBy('created_at', 'desc')->paginate();
    
        return view('proyecto.index', compact('proyectosPendientes', 'proyectosCompletados'))
            ->with('i', (request()->input('page', 1) - 1) * $proyectosPendientes->perPage());
    }

    public function create()
    {
        $proyecto = new Proyecto();
        $materias = Materia::pluck('nombre', 'id');
        return view('proyecto.create', compact('proyecto', 'materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materias_id' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_entrega' => 'required|date_format:Y-m-d',
            'status' => 'required|in:Pendiente,Completado',
        ]);

        $fechaEntrega = Carbon::createFromFormat('Y-m-d', $request->fecha_entrega)->format('Y-m-d');

        $proyecto = Proyecto::updateOrCreate(
            ['id' => $request->id], // o cualquier condición que desees
            [
                'materias_id' => $request->materias_id,
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'fecha_entrega' => $fechaEntrega,
                'status' => $request->status,
                // otras columnas...
            ]
        );

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente.');
    }

    public function show($id)
    {
        $proyecto = Proyecto::with('materia')->find($id);
        return view('proyecto.show', compact('proyecto'));
    }
    

    public function edit($id)
    {
        $proyecto = Proyecto::find($id);
        $materias = Materia::pluck('nombre', 'id');
        return view('proyecto.edit', compact('proyecto', 'materias'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'materias_id' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_entrega' => 'required|date_format:Y-m-d',
            'status' => 'required|in:Pendiente,Completado',
            // otras reglas de validación...
        ]);

        $fechaEntrega = Carbon::createFromFormat('Y-m-d', $request->fecha_entrega)->format('Y-m-d');

        $proyecto->update([
            'materias_id' => $request->materias_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $fechaEntrega,
            'status' => $request->status,
            // otras columnas...
        ]);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente');
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::find($id)->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente');
    }

    public function generatePDF()
{
    $proyectosPendientes = Proyecto::where('status', 'Pendiente')->orderBy('created_at', 'desc')->get();
    $proyectosCompletados = Proyecto::where('status', 'Completado')->orderBy('created_at', 'desc')->get();

    $pdf = PDF::loadView('pdf', compact('proyectosPendientes', 'proyectosCompletados'));

    return $pdf->download('proyectos.pdf');
}
}
