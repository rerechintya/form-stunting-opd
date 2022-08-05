<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\KecamatanImport;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatan = Kecamatan::all();

        return view('pages/kecamatan', compact('kecamatan'));
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
            'kecamatan_file' => 'required|mimes:xlsx|max:2048'
        ]);
        if (!$validation) return back()->with(['error' => $validation->errors()]);

        $kecamatan = Kecamatan::all();
        if (count($kecamatan) > 0) return back()->with(['error' => 'Data kecamatan sudah ada, tidak dapat mengunggah data baru untuk alasan keutuhan data.']);


        Excel::import(new KecamatanImport, $request->kecamatan_file);
        return redirect('master/kecamatan')->with(['success' => 'File berhasil diunggah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        //
    }
}
