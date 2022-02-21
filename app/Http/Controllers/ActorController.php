<?php

namespace App\Http\Controllers;

use App\Actor;
use App\SerieActor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActorController extends Controller
{
    const nro_paginate=3;
    public function mList(Request $request){
        $paramSearch =null;
        if($request->has('dataFiltro')){
            $paramSearch=$request->dataFiltro;
            $actors= Actor::orderBy('idActor')->where('firstName', 'ILIKE', '%'.$paramSearch.'%')->orWhere('lastName', 'ILIKE', '%'.$paramSearch.'%')->orWhere('nationality', 'ILIKE', '%'.$paramSearch.'%')->paginate(self::nro_paginate);
        }else{
            $actors= Actor::orderBy('idActor')->paginate(self::nro_paginate);
        }
        return view('ActorView.list',['actors'=>$actors,'dataFiltro'=>$paramSearch]);
    }

    public function mView(int $idIn){
        $actor = Actor::findOrFail($idIn);
        return view('ActorView.view',['actor'=>$actor]);
    }

    public function mCreate(){
        return view('ActorView.create');
    }

    public function mShowForm(int $idIn){
        $actor = Actor::findOrFail($idIn);
        
        return view('ActorView.create',['actor'=>$actor]);
    }

    public function mStore(Request $request){
        $this->validateForm($request)->validate();
        $datosActor= new Actor();
        $datosActor->firstName = $request->actorFirstName;
        $datosActor->lastName = $request->actorLastName;
        $datosActor->birthDate = $request->actorBirthDate;
        $datosActor->nationality = $request->actorNationality;

        if($this->comprobarName($request->actorFirstName,$request->actorLastName)=="ok")
            $datosActor->save();
        else return redirect()->route('actors.aCreate')->with('warning',': Ya existe un actor ó actris con esos nombres y apellidos registrados');
        return redirect()->route('actors.aList')->with('success',': Registro satisfactorio');
    }

    public function mUpdate(Request $request){
        $this->validateForm($request)->validate();
        $actorOld = Actor::findOrFail($request->idActor);
        $actorOld->birthDate = $request->actorBirthDate;
        $actorOld->nationality = $request->actorNationality;
        if($actorOld->firstName!=$request->actorFirstName ||$actorOld->lastName!=$request->actorLastName){
            $actorOld->firstName = $request->actorFirstName;
            $actorOld->lastName = $request->actorLastName;
            if($this->comprobarName($request->actorFirstName, $request->actorLastName)=="ok"){
                $actorOld->save();
            }else return redirect()->route('actors.aCreate')->with('warning',': Ya existe un actor ó actris con esos nombres y apellidos registrados');
        }else $actorOld->save();
        return redirect()->route('actors.aList')->with('success',': Edición satisfactoria');
    }

    public function mDelete(Request $request){
        $actorOld = Actor::findOrFail($request->idActor);
        if($this->comprobarSerieFK($request->idActor)=="ok")
            $actorOld->delete();
        else return redirect()->route('actors.aList')->with('warning', ": No se puede borrar debido que tiene referencia con otra entidad");
        return redirect()->route('actors.aList')->with('success', ": Eliminación satisfactoria");
    }

    function validateForm($request){
        return Validator::make($request->all(),[
            'actorFirstName'=>['required', 'string', 'max:75', 'min:4'],
            'actorLastName'=>['required','string','max:10', 'min:4'],
            'actorBirthDate'=>['required','date','before:today'],
            'actorNationality'=>['required','alpha','max:25', 'min:5']
        ]);
    }

    function comprobarSerieFK(int $idIn){
        $existe="ok";
        $data= SerieActor::where('actorId', $idIn )->first();
        if($data!=null)
            $existe="coincidencia";
        return $existe;
    }

    function comprobarName(string $firstNameIn,string $lastNameIn){
        $existe="ok";
        $data= Actor::where([['firstName', 'ILIKE',$firstNameIn],['lastName', 'ILIKE', $lastNameIn]])->first();
        if($data!=null)
            $existe="coincidencia";
        return $existe;
    }
}
