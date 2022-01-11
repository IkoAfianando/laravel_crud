<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('data.warga');
    }

    public function warga_fetchAll()
    {
        $emps = Warga::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Foto KTP</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Status Pernikahan</th>
                <th>Status Warga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->name . '</td>
                <td><img src="storage/warga/' . $emp->foto . '" width="70" class="figure-img" alt="Warga"></td>
                <td>' . $emp->alamat . '</td>
                <td>' . $emp->tanggal_lahir . '</td>
                <td>' . $emp->email . '</td>
                <td>' . $emp->jenis_kelamin . '</td>
                <td>' . $emp->status_pernikahan . '</td>
                <td>' . $emp->status_warga . '</td>
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

    public function warga_store(Request $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('foto');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/warga', $fileName);

        $empData = [
            'name' => $request->name,
            'foto' => $fileName,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_pernikahan' => $request->status_pernikahan,
            'status_warga' => $request->status_warga,

        ];
        Warga::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function warga_edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $emp = Warga::find($id);
        return response()->json($emp);
    }

    public function warga_update(Request $request): \Illuminate\Http\JsonResponse
    {
        $warga = Warga::find($request->emp_id);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/warga', $fileName);
            if ($warga->foto) {
                Storage::delete('public/warga/' . $warga->foto);
            }
        } else {
            $fileName = $request->emp_foto;
        }
        $empData = [
            'name' => $request->name,
            'foto' => $fileName,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_pernikahan' => $request->status_pernikahan,
            'status_warga' => $request->status_warga,
        ];
        $warga->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function warga_delete(Request $request)
    {
        $id = $request->id;
        $emp = Warga::find($id);
        if (Storage::delete('public/warga/' . $emp->foto)) {
            Warga::destroy($id);
        }
    }
}
