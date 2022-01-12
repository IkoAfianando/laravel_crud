<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $wargas = Warga::all();
        return view('pengeluaran.pengeluaran', compact('wargas'));
    }

    public function pengeluaran_fetchAll()
    {
        $emps = Pengeluaran::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Nama Pengeluaran</th>
                <th>Jumlah Pengeluaran</th>
                <th>Kategori</th>
                <th>Foto Pengeluaran</th>
                <th>Tanggal Pengeluaran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->nama_input_pengeluaran . '</td>
                <td>' . $emp->nama_pengeluaran . '</td>
                <td>Rp' . $emp->jumlah_pengeluaran . '</td>
                <td>' . $emp->kategori. '</td>
                 <td><img src="storage/pengeluaran/' . $emp->foto . '" width="100" class="img-thumbnail" alt="Pengeluaran"></td>
                <td>' . $emp->tanggal_pengeluaran . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">Masukkan Data Anda</h1>';
        }

    }

    public function pengeluaran_store(Request $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('foto');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/pengeluaran', $fileName);

        $empData = [
            'nama_input_pengeluaran' => $request->nama_pemilik,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'kategori' => $request->kategori,
            'foto' => $fileName,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
        ];
        Pengeluaran::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function pengeluaran_edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $emp = Pengeluaran::find($id);
        return response()->json($emp);
    }

    public function pengeluaran_update(Request $request): \Illuminate\Http\JsonResponse
    {
        $pengeluaran = Pengeluaran::find($request->emp_id);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/pengeluaran', $fileName);
            if ($pengeluaran->foto) {
                Storage::delete('public/pengeluaran/' . $pengeluaran->foto);
            }
        } else {
            $fileName = $request->emp_foto;
        }
        $empData = [
            'nama_input_pengeluaran' => $request->nama_pemilik,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'kategori' => $request->kategori,
            'foto' => $fileName,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
        ];
        $pengeluaran->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function pengeluaran_delete(Request $request)
    {
        $id = $request->id;
        $emp = Pengeluaran::find($id);
        if (Storage::delete('public/pengeluaran/' . $emp->foto)) {
            Pengeluaran::destroy($id);
        }
    }
}
