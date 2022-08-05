<?php

namespace App\Http\Controllers;

use App\Models\Puskesmas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\PuskesmasImport;

class PuskesmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puskesmas = Puskesmas::all();

        return view('pages.puskesmas', compact('puskesmas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'puskesmas_file' => 'required|mimes:xlsx|max:2048'
        ]);
        if (!$validation) return back()->with(['error' => $validation->errors()]);

        $puskesmas = Puskesmas::all();
        if (count($puskesmas) > 0) return back()->with(['error' => 'Data puskesmas sudah ada, tidak dapat mengunggah data baru untuk alasan keutuhan data.']);


        Excel::import(new PuskesmasImport, $request->puskesmas_file);
        return redirect('master/puskesmas')->with(['success' => 'File berhasil diunggah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function show(Puskesmas $puskesmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function edit(Puskesmas $puskesmas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puskesmas $puskesmas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puskesmas $puskesmas)
    {
        //
    }
}
