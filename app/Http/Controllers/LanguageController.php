<?php

namespace App\Http\Controllers;

use App\Language;
use App\SerieLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    const nro_paginate=3;
    public function mList(Request $request){
        $paramSearch =null;
        if($request->has('dataFiltro')){
            $paramSearch=$request->dataFiltro;
            $languages= Language::orderBy('isoCode')->where('name', 'ILIKE', '%'.$paramSearch.'%')->orWhere('isoCode','ILIKE', $paramSearch)->paginate(self::nro_paginate);
        }else{
            $languages= Language::orderBy('isoCode')->paginate(self::nro_paginate);
        }
        return view('LanguageView.list',['languages'=>$languages,'dataFiltro'=>$paramSearch]);
    }

    public function mView(int $idIn){
        $language = Language::findOrFail($idIn);
        return view('LanguageView.view',['language'=>$language]);
    }

    public function mCreate(){
        return view('LanguageView.create');
    }

    public function mShowForm(int $idIn){
        $language = Language::findOrFail($idIn);
        
        return view('LanguageView.create',['language'=>$language]);
    }

    public function mStore(Request $request){
        $this->validateForm($request)->validate();

        $datosLanguage= new Language();
        $datosLanguage->name = $request->languageName;
        $datosLanguage->isoCode = $request->languageIsoCode;

        if($this->comprobarName($request->languageIsoCode,$request->languageName, 0)=="ok")
            $datosLanguage->save();
        else return redirect()->route('languages.aCreate')->with('warning',': Código duplicado, intente con otro nombre o código');
        return redirect()->route('languages.aList')->with('success',': Registro satisfactorio');
    }

    public function mUpdate(Request $request){
        $this->validateForm($request)->validate();
        $languageOld = Language::findOrFail($request->idLanguage);
        if($languageOld->isoCode!=$request->languageIsoCode ||$languageOld->name!=$request->languageName){
            $languageOld->isoCode = $request->languageIsoCode;
            $languageOld->name = $request->languageName;
            if($this->comprobarName($request->languageIsoCode, $request->languageName,$request->idLanguage)=="ok"){
                $languageOld->save();
            }else return redirect()->route('languages.aCreate')->with('warning',': Código duplicado, intente con otro nombre o código');
        }
        return redirect()->route('languages.aList')->with('success',': Edición satisfactoria');
    }

    public function mDelete(Request $request){
        $languageOld = Language::findOrFail($request->idLanguage);
        if($this->comprobarSerieFK($request->idLanguage)=="ok")
            $languageOld->delete();
        else return redirect()->route('languages.aList')->with('warning', ": No se puede borrar debido que tiene referencia con otra entidad");
        return redirect()->route('languages.aList')->with('success', ": Eliminación satisfactoria");
    }

    function validateForm($request){
        return Validator::make($request->all(),[
            'languageName'=>['required', 'alpha', 'max:255', 'min:3'],
            'languageIsoCode'=>['required','alpha','max:10', 'min:2']
        ]);
    }

    function comprobarSerieFK(int $idIn){
        $existe="ok";
        $data= SerieLanguage::where('languageId', $idIn )->first();
        if($data!=null)
            $existe="coincidencia";
        return $existe;
    }

    function comprobarName(string $isoCodeIn,string $nameIn, int $idIn){
        $existe="ok";
        $data= Language::where([['name','ILIKE',$nameIn],['idLanguage','!=', $idIn]])->orWhere([['isoCode','ILIKE', $isoCodeIn],['idLanguage','!=', $idIn]])->first();
        if($data!=null)
            $existe="coincidencia";
        return $existe;
    }
}
