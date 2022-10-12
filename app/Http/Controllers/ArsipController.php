<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $arsips = DB::table('arsips')
            ->select('id', 'nomor_surat', 'kategori', 'judul', 'nama_file', 'created_at')
            ->where('judul', 'like', "%$search%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        } else {
            $arsips = DB::table('arsips')
            ->select('id', 'nomor_surat', 'kategori', 'judul', 'nama_file', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        }

        return view(
            'arsip.index',
            ['arsips' => $arsips]
        );
    }

    public function create()
    {
        return view('arsip.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => ['required'],
            'kategori' => ['required'],
            'judul' => ['required'],
            'file_arsip' => ['required', 'file', 'mimes:pdf']
        ]);

        $file_arsip = $request->file('file_arsip');
        $nama_file = str_replace('/','-', $request->nomor_surat).".".$file_arsip->getClientOriginalExtension();
        $file_arsip->move('arsip', $nama_file);

        DB::beginTransaction();
        try {
            DB::table('arsips')
            ->insert([
                'nomor_surat' => $request->nomor_surat,
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'nama_file' => $nama_file,
                'created_at' => Carbon::now()
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('errors', $ex);
        }
    }

    public function show($id)
    {
        $arsip = DB::table('arsips')
            ->select('id', 'nomor_surat', 'kategori', 'judul', 'nama_file', 'created_at')
            ->where('id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('arsip.show', ['arsip' => $arsip]);
    }

    public function edit($id)
    {
        $arsip = DB::table('arsips')
            ->select('id', 'nomor_surat', 'kategori', 'judul', 'nama_file', 'created_at')
            ->where('id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('arsip.edit', ['arsip' => $arsip]);
    }

    public function update(Request $request, $arsip)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'kategori' => 'required',
            'judul' => 'required',
        ]);

        $data = [
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'updated_at' => Carbon::now()
        ];

        if (!empty($request->file('file_arsip'))) {
            $request->validate(['file_arsip' => 'required|mimes:pdf']);
            $file_arsip = $request->file('file_arsip');
            $nama_file = str_replace('/','-', $request->nomor_surat).".".$file_arsip->getClientOriginalExtension();
            $file_arsip->move('arsip', $nama_file);

            $data['nama_file'] = $nama_file;
        }

        DB::beginTransaction();
        try {
            DB::table('arsips')->where('id', $arsip)->update($data);

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diubah');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('errors', $ex);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arsip  $arsip
     * @return \Illuminate\Http\Response
     */
    public function destroy($arsip)
    {
        DB::beginTransaction();
        try {
            DB::table('arsips')->where('id', $arsip)->delete();
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('errors', $ex);
        }
    }
}
