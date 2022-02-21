<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Director;
use App\Language;
use App\Platform;
use App\Serie;
use App\SerieActor;
use App\SerieLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SerieController extends Controller
{
    const nro_paginate = 4;
    const nro_paginateExtra = 3;
    public function mList(Request $request)
    {
        $paramSearch = null;
        if ($request->has('dataFiltro')) {
            $paramSearch = $request->dataFiltro;
            $series = Serie::join('tb_directors', 'tb_series.directorId', 'tb_directors.idDirector')->join('tb_platforms', 'tb_series.platformId', 'tb_platforms.idPlatform')->where('tb_series.title', 'ILIKE', '%' . $paramSearch . '%')->orWhere('tb_directors.firstName', 'ILIKE', '%' . $paramSearch . '%')->orWhere('tb_directors.lastName', 'ILIKE', '%' . $paramSearch . '%')->orWhere('tb_platforms.name', 'ILIKE', '%' . $paramSearch . '%')->orderBy('tb_series.idSerie')->paginate(self::nro_paginate);
        } else {
            $series = Serie::join('tb_directors', 'tb_series.directorId', 'tb_directors.idDirector')->join('tb_platforms', 'tb_series.platformId', 'tb_platforms.idPlatform')->orderBy('tb_series.idSerie')->paginate(self::nro_paginate);
        }
        return view('SerieView.list', ['series' => $series, 'dataFiltro' => $paramSearch]);
    }

    public function mView(int $idIn){
        $serie = Serie::join('tb_directors', 'tb_series.directorId', 'tb_directors.idDirector')->join('tb_platforms', 'tb_series.platformId', 'tb_platforms.idPlatform')->findOrFail($idIn);
        $listActors = Serie::findOrFail($idIn)->listActors()->get();
        $listLanguages = Serie::findOrFail($idIn)->listLanguages()->get();

        return view('SerieView.view', ['serie' => $serie, 'listActors' => $listActors, 'listLanguages' => $listLanguages]);
    }

    public function mCreate()
    {
        $directors = Director::orderBy('idDirector')->get();
        $platforms = Platform::orderBy('name')->get();
        return view('SerieView.create', ['directors' => $directors, 'platforms' => $platforms]);
    }

    public function mShowForm(int $idIn)
    {
        $serie = Serie::findOrFail($idIn);
        $listActors = Serie::findOrFail($idIn)->listActors()->get();
        $listLanguages = Serie::findOrFail($idIn)->listLanguages()->get();
        $directors = Director::orderBy('idDirector')->get();
        $platforms = Platform::orderBy('name')->get();
        $actors = Actor::orderBy('idActor')->get();
        $languages = Language::orderBy('idLanguage')->get();
        return view('SerieView.create', ['serie' => $serie, 'listActors' => $listActors, 'listLanguages' => $listLanguages, 'directors' => $directors, 'platforms' => $platforms, 'actors' => $actors, 'languages' => $languages]);
    }

    public function mStore(Request $request)
    {
        $this->validateForm($request)->validate();
        $datosSerie = new Serie();
        $datosSerie->title = $request->serieTitle;
        $datosSerie->synopsis = $request->serieSynopsis;
        $datosSerie->platformId = $request->seriePlatformId;
        $datosSerie->directorId = $request->serieDirectorId;

        if ($this->comprobarExiste($request->serieTitle) == "ok")
            $datosSerie->save();
        else return redirect()->route('series.aCreate')->with('warning', ': Título duplicado, intente con otro nombre');
        return redirect()->route('series.aList')->with('success', ': Registro satisfactorio');
    }

    public function mUpdate(Request $request)
    {
        $this->validateForm($request)->validate();
        $serieOld = Serie::findOrFail($request->idSerie);
        $serieOld->synopsis = $request->serieSynopsis;
        $serieOld->platformId = $request->seriePlatform;
        $serieOld->directorId = $request->serieDirector;
        if ($serieOld->title != $request->serieTitle) {
            $serieOld->title = $request->serieTitle;
            if ($this->comprobarExiste($request->idSerie) == "ok") {
                $serieOld->save();
            } else $this->mShowForm($request->idSerie)->with('warning', ': Título duplicado, intente con otro nombre');
        } else $serieOld->save();
        return redirect()->route('series.aList')->with('success', ': Edición satisfactoria');
    }

    public function mDelete(Request $request)
    {
        $serieOld = Serie::findOrFail($request->idSerie);
        $serieOld->delete();
        return redirect()->route('series.aList')->with('success', ": Eliminación satisfactoria");
    }

    public function mAddActor(Request $request)
    {
        $datosSerieActor = new SerieActor();
        $datosSerieActor->serieId = $request->idSerie;
        $datosSerieActor->actorId = $request->addActor;
        if ($this->comprobarExisteSerieActor($request->idSerie, $request->addActor) == "ok")
            $datosSerieActor->save();
        return redirect()->back();
    }

    public function mDeleteActor(Request $request)
    {
        $serieActorOld = SerieActor::findOrFail($request->serieActorIdSerieActor);
        $serieActorOld->delete();
        return redirect()->back();
    }

    public function mAddLanguage(Request $request)
    {
        $datosSerieLanguageAudio = new SerieLanguage();
        $datosSerieLanguageAudio->serieId = $request->idSerie;
        $datosSerieLanguageAudio->languageId = $request->addLanguage;
        $datosSerieLanguageAudio->type = "Audio";
        if ($this->comprobarExisteSerieLanguage($request->idSerie, $request->addLanguage, "Audio") == "ok")
            $datosSerieLanguageAudio->save();

        $datosSerieLanguageSubtitulo = new SerieLanguage();
        $datosSerieLanguageSubtitulo->serieId = $request->idSerie;
        $datosSerieLanguageSubtitulo->languageId = $request->addLanguage;
        $datosSerieLanguageSubtitulo->type = "Subtítulo";
        if ($this->comprobarExisteSerieLanguage($request->idSerie, $request->addLanguage, "Subtítulo") == "ok")
            $datosSerieLanguageSubtitulo->save();

        return redirect()->back();
    }

    public function mDeleteLanguage(Request $request)
    {
        $serieLanguageOld = SerieLanguage::findOrFail($request->serieLanguageIdSerieLanguage);
        $serieLanguageOld->delete();
        return redirect()->back();
    }

    function validateForm($request)
    {
        return Validator::make($request->all(), [
            'serieTitle' => ['required', 'string', 'max:75', 'min:5'],
            'serieSynopsis' => ['required', 'string', 'max:255', 'min:10'],
            'serieDirectorId' => ['required', 'numeric'],
            'seriePlatformId' => ['required', 'numeric'],
        ]);
    }

    function comprobarExiste(string $titleIn)
    {
        $existe = "ok";
        $data = Serie::where('title', 'ILIKE', $titleIn)->first();
        if ($data != null)
            $existe = "coincidencia";
        return $existe;
    }

    function comprobarExisteSerieActor(int $serieIdIn, int $actorIdIn)
    {
        $existe = "ok";
        $data = SerieActor::where('serieId', $serieIdIn)->where('actorId', $actorIdIn)->first();
        if ($data != null)
            $existe = "coincidencia";
        return $existe;
    }

    function comprobarExisteSerieLanguage(int $serieIdIn, int $languageIdIn, string $typeIn)
    {
        $existe = "ok";
        $data = SerieLanguage::where('serieId', $serieIdIn)->where('languageId', $languageIdIn)->where('type', $typeIn)->first();
        if ($data != null)
            $existe = "coincidencia";
        return $existe;
    }
}
