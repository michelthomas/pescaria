<?php

namespace App\Http\Controllers;

use App\Models\Pescado;
use App\Models\Pescaria;
use App\Traits\UploadTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PescadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Pescaria $pescaria
     * @return Application|Factory|View|JsonResponse|Response
     */
    public function index(Pescaria $pescaria)
    {
        /*return view('pescado.index', [
           'pescados' => $pescaria->pescados()
        ]);*/

        //dd($pescaria->pescados()->get());
        return response()->json($pescaria->pescados()->get());
    }

/*    public function indexByUser()
    {
        return \view('pescado.index', [
           'pescados' =>
        ]);
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @param Pescaria $pescaria
     * @return Application|Factory|View|Response
     */
    public function create(Pescaria $pescaria)
    {
        return view('pescado.create', ['pescaria' => $pescaria]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Pescaria $pescaria
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(Pescaria $pescaria)
    {
        $pescado = new Pescado(request(['name', 'weight', 'size']));
        $pescado->user_id = Auth::user()->id;
        $pescado->pescaria_id = $pescaria->id;
        $pescado->save();

        // Check if a profile image has been uploaded
        if (request()->has('image')) {
            // Get image file
            $image = request()->file('image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug(request()->input('name')) . '_' . time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            UploadTrait::uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $pescado->image = $filePath;
        }

        $pescado->save();

        return redirect(route('pescaria.show', ['pescaria' => $pescaria]));
    }

    /**
     * Display the specified resource.
     *
     * @param Pescado $pescado
     * @return Application|Factory|View|Response
     */
    public function show(Pescaria $pescaria, Pescado $pescado)
    {
        return view('pescado.show', ['pescaria' => $pescaria, 'pescado' => $pescado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pescado $pescado
     * @return Response
     */
    public function edit(Pescado $pescado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Pescado $pescado
     * @return Response
     */
    public function update(Request $request, Pescado $pescado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pescado $pescado
     * @return Response
     */
    public function destroy(Pescado $pescado)
    {
        //
    }
}
