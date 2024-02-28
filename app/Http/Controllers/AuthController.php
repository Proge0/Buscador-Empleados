<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Anexos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        Anexos::updateOrCreate(['id'=>$request->anexo_id],
        [
        'numeros_publicos'=>$request->numero_publico,
        'anexo'=>$request->numero_anexo,
        'nombre_anexo'=>$request->nombre_anexo,
        'departamento'=>$request->departamento,
        'timestamps' => false
        ]
    );
        return response()->json(['success'=> true, 'msg' => 'Anexo creado exitosamente']);
    }

    public function deleteAnexo($id) {
        try {
            $delete_anexo = Anexos::where('id',$id)->delete();
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
    
    public function editAnexo(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'anexo_anexo' => 'required',
            'anexo_departamento' => 'required',
            'anexo_name' => 'required',
            'anexo_numeros' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->toArray()]);
        } else {
            //dd($request->all());
            try {
                if ($anexo = Anexos::findOrFail($request->anexo_ids)) {
                        $anexo->numeros_publicos = $request->anexo_numeros;
                        $anexo->anexo = $request->anexo_anexo;
                        $anexo->nombre_anexo = $request->anexo_name;
                        $anexo->departamento = $request->anexo_departamento;
                        $anexo->save();
                    return response()->json(['success' => true, 'msg' => 'Anexo actualizado con exito']);
                } else {
                    return response()->json(['error' => false, 'msg' => 'No se encontró el registro que se desea actualizar']);
                }

            } catch (\Exception $e) {
                return response()->json(['error' => false, 'msg' => $e->getMessage()]);
            }
        }
    }

    public function addEmpleados(Request $request){
        return view('back.pages.auth.add');
    }

}