<?php

namespace App\Http\Controllers;

use App\Models\Pescaria;
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


        return redirect(route('pescaria.index'));
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
