<?php

namespace App\Http\Controllers;

use App\Platform;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlatformController extends Controller
{
    const nro_paginate=3;
    public function mList(Request $request){
        $paramSearch =null;
        if($request->has('dataFiltro')){
            $paramSearch=$request->dataFiltro;
            $platforms= Platform::orderBy('name')->where('name', 'ILIKE', '%'.$paramSearch.'%')->paginate(self::nro_paginate);
        }else{
            $platforms= Platform::orderBy('name')->paginate(self::nro_paginate);
        }
        return view('PlatformView.list',['platforms'=>$platforms,'dataFiltro'=>$paramSearch]);
    }

    public function mView(int $idIn){
        $platform = Platform::findOrFail($idIn);
        return view('PlatformView.view',['platform'=>$platform]);
    }

    public function mCreate(){
        return view('PlatformView.create');
    }

    public function mShowForm(int $idIn){
        $platform = Platform::findOrFail($idIn);
        
        return view('PlatformView.create',['platform'=>$platform]);
    }

    public function mStore(Request $request){
        $this->validateForm($request)->validate();

        $datosPlatform= new Platform();
        $datosPlatform->name = $request->platformName;

        if($this->comprobarName($request->platformName)=="ok")
            $datosPlatform->save();
        else return redirect()->route('platforms.aCreate')->with('warning',': Nombre duplicado, intente con otro nombre');
        return redirect()->route('platforms.aList')->with('success',': Registro satisfactorio');
    }

    public function mUpdate(Request $request){
        $this->validateForm($request)->validate();
        $platformOld = Platform::findOrFail($request->idPlatform);
        if($platformOld->name!=$request->platformName){
            if($this->comprobarName($request->platformName)=="ok"){
                $platformOld->name = $request->platformName;
                $platformOld->save();
            }else return redirect()->route('platforms.aCreate')->with('warning',': Nombre duplicado, intente con otro nombre');
        }
        return redirect()->route('platforms.aList')->with('success',': Edición satisfactoria');
    }

    public function mDelete(Request $request){
        $platformOld = Platform::findOrFail($request->idPlatform);
        if($this->comprobarSerieFK($request->idPlatform)=="ok")
            $platformOld->delete();
        else return redirect()->route('platforms.aList')->with('warning', ": No se puede borrar debido que tiene referencia con otra entidad");
        return redirect()->route('platforms.aList')->with('success', ": Eliminación satisfactoria");
    }

    function validateForm($request){
        return Validator::make($request->all(),[
            'platformName'=>['required', 'string', 'max:255', 'min:3']
        ]);
    }

    function comprobarSerieFK(int $idIn){
        $existe="ok";
        $data= Serie::where('platformId', $idIn )->first();
        if($data!=null)
            $existe="coincidencia";
        return $existe;
    }

    function comprobarName(string $nameIn){
        $existe="ok";
        $data= Platform::where('name', $nameIn )->first();
        if($data!=null)
            $existe="coincidencia";
        return $existe;
    }
}
