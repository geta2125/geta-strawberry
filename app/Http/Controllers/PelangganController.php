<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Multipleupload;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kolom yang difilter biasa
        $filterableColumns = ['gender'];

        // Kolom yang bisa dicari lewat search()
        $searchableColumns = ['first_name'];
        // sesuaikan dengan kolom TABEL pelanggan kamu

        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)->withQueryString();

        return view('admin.pelanggan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        // 1. Simpan data pelanggan dulu
        $pelanggan = Pelanggan::create($request->only([
            'first_name',
            'last_name',
            'birthday',
            'gender',
            'email',
            'phone',
        ]));

        // 2. Kalau ada file yang diupload dari halaman create
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if (!$file->isValid()) {
                    continue;
                }

                $filename = round(microtime(true) * 1000) . '-' .
                    str_replace(' ', '-', $file->getClientOriginalName());

                $file->move(public_path('uploads/multiple'), $filename);

                Multipleupload::create([
                    'ref_table' => 'pelanggan',
                    'ref_id' => $pelanggan->pelanggan_id, // pk pelanggan kamu
                    'filename' => $filename,
                ]);
            }
        }

        return redirect()->route('pelanggan.index')
            ->with('create', 'Penambahan data berhasil!');

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $files = Multipleupload::where('ref_table', 'pelanggan')
            ->where('ref_id', $id)
            ->get();

        return view('admin.pelanggan.show', compact('pelanggan', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataPelanggan = Pelanggan::findOrFail($id);

        $files = Multipleupload::where('ref_table', 'pelanggan')
            ->where('ref_id', $id)
            ->get();

        return view('admin.pelanggan.edit', compact('dataPelanggan', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        // 1. Update data pelanggan
        $pelanggan->update($request->only([
            'first_name',
            'last_name',
            'birthday',
            'gender',
            'email',
            'phone',
        ]));

        // 2. Tambah file baru (kalau ada) saat edit
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if (!$file->isValid()) {
                    continue;
                }

                $filename = round(microtime(true) * 1000) . '-' .
                    str_replace(' ', '-', $file->getClientOriginalName());

                $file->move(public_path('uploads/multiple'), $filename);

                Multipleupload::create([
                    'ref_table' => 'pelanggan',
                    'ref_id' => $pelanggan->pelanggan_id,
                    'filename' => $filename,
                ]);
            }
        }

        return redirect()->route('pelanggan.index')
            ->with('update', 'Perubahan data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('delete', 'Data berhasil dihapus!');
    }

    /* MULTIPLE FILE UPLOAD */
    public function uploadFiles(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id' => 'required|integer',
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if (!$file->isValid()) {
                    continue;
                }

                $filename = round(microtime(true) * 1000) . '-' .
                    str_replace(' ', '-', $file->getClientOriginalName());

                $file->move(public_path('uploads/multiple'), $filename);

                Multipleupload::create([
                    'ref_table' => $request->ref_table,
                    'ref_id' => $request->ref_id,
                    'filename' => $filename,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    /* DELETE FILE */
    public function deleteFile(string $fileId)
    {
        $file = Multipleupload::findOrFail($fileId);

        $path = public_path('uploads/multiple/' . $file->filename);
        if (file_exists($path)) {
            @unlink($path);
        }

        $file->delete();

        return redirect()->back()->with('success', 'Data berhasil di hapus!');
    }
}
