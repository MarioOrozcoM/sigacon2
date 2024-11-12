<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EmpresaDetalle;
use Illuminate\Http\Request;

class EmpresaDetalleController extends Controller
{
    // Muestra el índice para seleccionar una empresa
    public function index(Request $request)
    {
        $empresas = Empresa::all();
        $empresaSeleccionada = null;
        $detalles = null;
    
        if ($request->has('empresa_id')) {
            $empresaSeleccionada = Empresa::with('detalle')->find($request->input('empresa_id'));
            $detalles = $empresaSeleccionada ? $empresaSeleccionada->detalle : null;
        }
    
        return view('facturacion.cuentaCorreo.index', compact('empresas', 'empresaSeleccionada', 'detalles'));
    }
    

    // Muestra el formulario para crear detalles de la empresa
    public function create($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        return view('facturacion.cuentaCorreo.create', compact('empresa'));
    }

    // Guarda los detalles de la empresa
    public function store(Request $request, $empresaId)
    {
        $request->validate([
            'correoFactura' => 'required|email',
            'cuentaBanco' => 'required|string|max:255',
        ]);
    
        EmpresaDetalle::create([
            'empresa_id' => $empresaId,
            'correo_factura' => $request->input('correoFactura'), // Cambiado de correoFactura a correo_factura
            'cuenta_banco' => $request->input('cuentaBanco'), // Cambiado de cuentaBanco a cuenta_banco
        ]);
    
        return redirect()->route('empresa_detalles.index')->with('success', 'Detalles de la empresa creados correctamente.');
    }
    
    

    // Muestra el formulario para editar los detalles de la empresa
    public function edit($id)
    {
        $detalle = EmpresaDetalle::findOrFail($id);
        $empresa = $detalle->empresa; // Obtenemos la empresa relacionada con los detalles
        return view('facturacion.cuentaCorreo.edit', compact('detalle', 'empresa'));
    }
    

    // Actualiza los detalles de la empresa
    public function update(Request $request, $id)
    {
        $request->validate([
            'correoFactura' => 'required|email',
            'cuentaBanco' => 'required|string|max:255',
        ]);
    
        $detalle = EmpresaDetalle::findOrFail($id);
    
        // Asignar explícitamente los campos del formulario a los campos en la base de datos
        $detalle->correo_factura = $request->input('correoFactura');
        $detalle->cuenta_banco = $request->input('cuentaBanco');
        $detalle->save();
    
        return redirect()->route('empresa_detalles.index')->with('success', 'Detalles de la empresa actualizados correctamente.');
    }
    

    // Elimina los detalles de la empresa
    public function destroy($id, Request $request)
    {
        $detalle = EmpresaDetalle::findOrFail($id);
        $empresaId = $detalle->empresa_id; // Guardar la empresa asociada antes de eliminar
        $detalle->delete();
    
        return redirect()->route('empresa_detalles.index', ['empresa_id' => $empresaId])
            ->with('success', 'Detalles de la empresa eliminados correctamente.');
    }
    
}