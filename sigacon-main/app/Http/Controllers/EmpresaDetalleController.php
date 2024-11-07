<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EmpresaDetalle;
use Illuminate\Http\Request;

class EmpresaDetalleController extends Controller
{
    // Muestra el índice para seleccionar una empresa
    public function index()
    {
        $empresas = Empresa::all();
        return view('facturacion.cuentaCorreo.index', compact('empresas'));
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
            'correo_factura' => 'required|email',
            'cuenta_banco' => 'required|string|max:255',
        ]);

        EmpresaDetalle::create([
            'empresa_id' => $empresaId,
            'correoFactura' => $request->input('correoFactura'),
            'cuentaBanco' => $request->input('cuentaBanco'),
        ]);

        return redirect()->route('facturacion.cuentaCorreo.index')->with('success', 'Detalles de la empresa creados correctamente.');
    }

    // Muestra el formulario para editar los detalles de la empresa
    public function edit($id)
    {
        $detalle = EmpresaDetalle::findOrFail($id);
        return view('facturacion.cuentaCorreo.edit', compact('detalle'));
    }

    // Actualiza los detalles de la empresa
    public function update(Request $request, $id)
    {
        $request->validate([
            'correoFactura' => 'required|email',
            'cuentaBanco' => 'required|string|max:255',
        ]);

        $detalle = EmpresaDetalle::findOrFail($id);
        $detalle->update($request->all());

        return redirect()->route('facturacion.cuentaCorreo.index')->with('success', 'Detalles de la empresa actualizados correctamente.');
    }

    // Elimina los detalles de la empresa
    public function destroy($id)
    {
        $detalle = EmpresaDetalle::findOrFail($id);
        $detalle->delete();

        return redirect()->route('facturacion.cuentaCorreo.index')->with('success', 'Detalles de la empresa eliminados correctamente.');
    }
}