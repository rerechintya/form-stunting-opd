<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\KelurahanImport;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahan = Kelurahan::all();

        return view('pages.kelurahan', compact('kelurahan'));
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
            'kelurahan_file' => 'required|mimes:xlsx|max:2048'
        ]);
        if (!$validation) return back()->with(['error' => $validation->errors()]);

        $kelurahan = Kelurahan::all();
        if (count($kelurahan) > 0) return back()->with(['error' => 'Data kelurahan sudah ada, tidak dapat mengunggah data baru untuk alasan keutuhan data.']);


        Excel::import(new KelurahanImport, $request->kelurahan_file);
        return redirect('master/kelurahan')->with(['success' => 'File berhasil diunggah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        //
    }
}
