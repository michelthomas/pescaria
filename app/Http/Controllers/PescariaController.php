<?php

namespace App\Http\Controllers;

use App\Models\Pescaria;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class PescariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('pescaria.index', [
            'pescarias' => Auth::user()->pescarias()->get(),
            'pescarias_amigos' => Auth::user()->pescariasParticipando()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $friends = Auth::user()->friends;

        return view('pescaria.create', ['friends' => $friends]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store()
    {
        $pescaria = new Pescaria(request(['date', 'hour', 'place']));
        $pescaria->user_id = Auth::user()->id;
        $pescaria->open = true;
        $pescaria->save();

/*
        if (request()->has('participantes')) {

        }*/

        $pescaria->participantes()->attach($pescaria->user_id);
        $pescaria->participantes()->attach(request('participantes'));


        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     * @param Pescaria $pescaria
     * @return Application|Factory|View
     */
    public function show(Pescaria $pescaria)
    {
        return view('pescaria.show', ['pescaria' => $pescaria]);
    }

    public function finish(Pescaria $pescaria)
    {
        $pescaria->open = false;
        $pescaria->save();

        return back();
    }

    public function podium(Pescaria $pescaria)
    {
        $participantes = $pescaria->participantes()->get();

        $qtdPescados = [];
        foreach ($participantes as $participante) {
            $qtdPescados[$participante->id] = $pescaria->pescados()->where('user_id', $participante->id)->count();
        }
        arsort($qtdPescados);

        $pescadores = [];
        foreach($qtdPescados as $id => $user) {
            $pescadores[] = User::find($id);
        }

        $pescadosMaisPesados = $pescaria->pescados()->orderBy('weight', 'desc')->take(3)->get();

        return view('pescaria.podium', [
            'pescados_pesados' => $pescadosMaisPesados,
            'pescadores' => $pescadores,
            'qtd_Pescados' => $qtdPescados
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Pescaria $pescaria
     * @return Response
     */
    public function edit(Pescaria $pescaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Pescaria $pescaria
     * @return Response
     */
    public function update(Request $request, Pescaria $pescaria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pescaria $pescaria
     * @return Response
     */
    public function destroy(Pescaria $pescaria)
    {
        //
    }

    protected function validatePescaria()
    {
        return request()->validate([
            'place' => 'required',
            'date' => 'required',
            'hour' => 'required',
        ]);
    }
}
