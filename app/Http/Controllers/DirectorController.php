<?php

namespace App\Http\Controllers;

use App\Director;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DirectorController extends Controller
{
    const nro_paginate=3;
    public function mList(Request $request){
        $paramSearch =null;
        if($request->has('dataFiltro')){
            $paramSearch=$request->dataFiltro;
            $directors= Director::orderBy('idDirector')->where('firstName', 'ILIKE', '%'.$paramSearch.'%')->orWhere('lastName', 'ILIKE', '%'.$paramSearch.'%')->orWhere('nationality', 'ILIKE', '%'.$paramSearch.'%')->paginate(self::nro_paginate);
        }else{
            $directors= Director::orderBy('idDirector')->paginate(self::nro_paginate);
        }
        return view('DirectorView.list',['directors'=>$directors,'dataFiltro'=>$paramSearch]);
    }

    public function mView(int $idIn){
        $director = Director::findOrFail($idIn);
        return view('DirectorView.view',['director'=>$director]);
    }

    public function mCreate(){
        return view('DirectorView.create');
    }

    public function mShowForm(int $idIn){
        $director = Director::findOrFail($idIn);
        
        return view('DirectorView.create',['director'=>$director]);
    }

    public function mStore(Request $request){
        $this->validateForm($request)->validate();
        $datosDirector= new Director();
        $datosDirector->firstName = $request->directorFirstName;
        $datosDirector->lastName = $request->directorLastName;
        $datosDirector->birthDate = $request->directorBirthDate;
        $datosDirector->nationality = $request->directorNationality;

        if($this->comprobarName($request->directorFirstName,$request->directorLastName)=="ok")
            $datosDirector->save();
        else return redirect()->route('directors.aCreate')->with('warning',': Ya existe un director con esos nombres y apellidos registrados');
        return redirect()->route('directors.aList')->with('success',': Registro satisfactorio');
    }

    public function mUpdate(Request $request){
        $this->validateForm($request)->validate();
        $directorOld = Director::findOrFail($request->idDirector);
        $directorOld->birthDate = $request->directorBirthDate;
        $directorOld->nationality = $request->directorNationality;
        if($directorOld->firstName!=$request->directorFirstName ||$directorOld->lastName!=$request->directorLastName){
            $directorOld->firstName = $request->directorFirstName;
            $directorOld->lastName = $request->directorLastName;
            if($this->comprobarName($request->directorFirstName, $request->directorLastName)=="ok"){
                $directorOld->save();
            }else return redirect()->route('directors.aCreate')->with('warning',': Ya existe un director con esos nombres y apellidos registrados');
        }else $directorOld->save();
        return redirect()->route('directors.aList')->with('success',': Edición satisfactoria');
    }

    public function mDelete(Request $request){
        $directorOld = Director::findOrFail($request->idDirector);
        if($this->comprobarSerieFK($request->idDirector)=="ok")
            $directorOld->delete();
        else return redirect()->route('directors.aList')->with('warning', ": No se puede borrar debido que tiene referencia con otra entidad");
        return redirect()->route('directors.aList')->with('success', ": Eliminación satisfactoria");
    }

    function validateForm($request){
        return Validator::make($request->all(),[
            'directorFirstName'=>['required', 'string', 'max:75', 'min:4'],
            'directorLastName'=>['required','string','max:10', 'min:4'],
            'directorBirthDate'=>['required','date','before:today'],
            'directorNationality'=>['required','alpha','max:25', 'min:5']
        ]);
    }

    function comprobarSerieFK(int $idIn){
        $existe="ok";
        $data= Serie::where('directorId', $idIn )->first();
        if($data!=null)
            $existe="coincidencia";
        return $existe;
    }

    function comprobarName(string $firstNameIn,string $lastNameIn){
        $existe="ok";
        $data= Director::where([['firstName', 'ILIKE',$firstNameIn],['lastName', 'ILIKE', $lastNameIn]])->first();
        if($data!=null)
            $existe="coincidencia";
        return $existe;
    }
}
