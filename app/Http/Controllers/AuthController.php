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
        Anexos::updateOrCreate(['ID'=>$request->anexo_id],
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
    
    public function editCar(Request $request){
        // validate form
        $validator = Validator::make($request->all(),[
            'numeros_publicos' => 'required',
            'anexo' => 'required',
            'nombre_anexo' => 'required',
            'departamento' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }else{
            // perform edit functionality here
            try {
                // so the car was not updated because of naming of id field input from form
                Anexos::where('id',$request->car_id)->update([
                    'numeros_publicos'=>$request->numero_publico,
                    'anexo'=>$request->numero_anexo,
                    'nombre_anexo'=>$request->nombre_anexo,
                    'departamento'=>$request->departamento,
                    'timestamps' => false
                ]);

                return response()->json(['success' => true, 'msg' => 'Anexo actualizado exitosamente']);

                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'msg' => $e->getMessage()]);

                }

            }
        }
}

