<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RumahController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('data.rumah');
    }

    public function rumah_fetchAll()
    {
        $emps = Rumah::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nomor Rumah</th>
                <th>Foto</th>
                <th>Alamat</th>
                <th>Nama Pemilik</th>
                <th>Nama Penghuni</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->nomor_rumah . '</td>
                <td><img src="storage/rumah/' . $emp->foto . '" width="70" class="figure-img" alt="Warga"></td>
                <td>' . $emp->alamat . '</td>
                <td>' . $emp->nama_pemilik . '</td>
                <td>' . $emp->nama_penghuni . '</td>
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

    public function rumah_store(Request $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('foto');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/rumah', $fileName);

        $empData = [
            'nomor_rumah' => $request->nomor_rumah,
            'foto' => $fileName,
            'alamat' => $request->alamat,
            'nama_pemilik' => $request->nama_pemilik,
            'nama_penghuni' => $request->nama_penghuni
        ];
        Rumah::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function rumah_edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $emp = Rumah::find($id);
        return response()->json($emp);
    }

    public function rumah_update(Request $request): \Illuminate\Http\JsonResponse
    {
        $rumah = Rumah::find($request->emp_id);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/rumah', $fileName);
            if ($rumah->foto) {
                Storage::delete('public/rumah/' . $rumah->foto);
            }
        } else {
            $fileName = $request->emp_foto;
        }
        $empData = [
            'nomor_rumah' => $request->nomor_rumah,
            'foto' => $fileName,
            'alamat' => $request->alamat,
            'nama_pemilik' => $request->nama_pemilik,
            'nama_penghuni' => $request->nama_penghuni
        ];
        $rumah->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function rumah_delete(Request $request)
    {
        $id = $request->id;
        $emp = Rumah::find($id);
        if (Storage::delete('public/rumah/' . $emp->foto)) {
            Rumah::destroy($id);
        }
    }
}
