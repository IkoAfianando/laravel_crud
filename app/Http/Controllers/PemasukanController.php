<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use App\Models\Pemasukan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemasukanController extends Controller
{
    public function index()
    {
        $wargas = Warga::all();
        $rumahs = Rumah::all();
        return view("pengeluaran.pemasukan",compact('wargas', 'rumahs'));
    }

    public function pemasukan_fetchAll()
    {
        $emps = Pemasukan::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nomor Rumah</th>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Iuran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->nomor_rumah . '</td>
                <td>' . $emp->nama_pemilik . '</td>
                <td>' . $emp->alamat . '</td>
                <td>Rp' . $emp->iuran . '</td>
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

    public function pemasukan_store(Request $request): \Illuminate\Http\JsonResponse
    {
        $empData = [
            'nomor_rumah' => $request->nomor_rumah,
            'nama_pemilik' => $request->nama_pemilik,
            'alamat' => $request->alamat,
            'iuran' => $request->iuran,
        ];
        Pemasukan::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function pemasukan_edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $emp = Pemasukan::find($id);
        return response()->json($emp);
    }

    public function pemasukan_update(Request $request): \Illuminate\Http\JsonResponse
    {
        $iuran = Pemasukan::find($request->emp_id);
        $empData = [
            'nomor_rumah' => $request->nomor_rumah,
            'alamat' => $request->alamat,
            'nama_pemilik' => $request->nama_pemilik,
            'iuran' => $request->iuran
        ];
        $iuran->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function pemasukan_delete(Request $request)
    {
        $id = $request->id;
        Pemasukan::destroy($id);
    }
}
