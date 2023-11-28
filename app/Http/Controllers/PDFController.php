<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $proyectosPendientes = Proyecto::where('status', 'Pendiente')->orderBy('created_at', 'desc')->get();
        $proyectosCompletados = Proyecto::where('status', 'Completado')->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('proyecto.pdf', compact('proyectosPendientes', 'proyectosCompletados'));
        return $pdf->download('proyectos.pdf');
    }
}
