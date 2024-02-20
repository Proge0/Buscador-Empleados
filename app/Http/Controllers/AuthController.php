<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Anexos;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getAnexos(Request $request) {
    $anexos = Anexos::all();
    return response()->json($anexos);
    }
    public function index(Request $request){
        if ($request->ajax()) {
            return $this->getAnexos($request);
        }

        $anexos = Anexos::all();
        return view('back.pages.home', compact('anexos'));
    }
    public function create(Request $request) {
        Anexos::updateOrCreate(['ID'=>$request->anexo_id],
        [
        'numeros_publicos'=>$request->numero_publico,
        'anexo'=>$request->numero_anexo,
        'nombre_anexo'=>$request->nombre_anexo,
        'departamento'=>$request->departamento,
        'timestamps' => false
        ]
    );
        return response()->json(['success'=>'Anexo creado exitosamente']);
    }

    public function deleteAnexo($id) {
        try {
            $delete_anexo = Anexos::where('ID',$id)->delete();
            return response()->json(['success' => true, 'msg' => 'Anexo Eliminado con exito']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('inicio');
    }
    public function indexInicio(){
        $anexos = Anexos::all();
        return view('back.pages.inicio', compact('anexos'));
    }
    

}

