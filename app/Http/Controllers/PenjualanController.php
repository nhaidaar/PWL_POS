<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Penjualan yang terdaftar dalam sistem'
        ];

        $penjualan = PenjualanModel::all();
        $user = UserModel::all();

        $activeMenu = 'penjualan';

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
                    ->with('user');

        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Transaksi',
            'list' => ['Home', 'Transaksi', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah transaksi baru'
        ];

        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'penjualan';

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_kode' => 'required|string|min:5|unique:t_penjualan,penjualan_kode',
            'pembeli' => 'required|string|max:100',
            'barang_id' => 'required|array',
            'harga' => 'required|array',
            'jumlah' => 'required|array',
            'user_id' => 'required|integer'
        ]);

        // Simpan data penjualan
        $transaksi = PenjualanModel::create([
            'penjualan_tanggal' => now(),
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'user_id' => $request->user_id,
        ]);

        // Simpan detail penjualan
        foreach ($request->barang_id as $index => $barang_id) {
            PenjualanDetailModel::create([
                'penjualan_id' => $transaksi->penjualan_id,
                'barang_id' => $barang_id,
                'harga' => $request->harga[$index],
                'jumlah' => $request->jumlah[$index],
            ]);

            // // Ambil jumlah stok barang yang tersedia
            // $stok = StokModel::where('barang_id', $barang_id)->first();

            // // Kurangi jumlah yang dibeli dari jumlah stok yang tersedia
            // $stok->stok_jumlah -= $request->jumlah[$index];

            // // Simpan kembali jumlah stok yang telah diupdate
            // $stok->save();
        }

        return redirect('/transaksi')->with('success', 'Data transaksi berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penjualan = PenjualanModel::with(['user', 'detail'])
                    ->find($id);

        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'activeMenu' => $activeMenu]);
    }
    
    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanModel::destroy($id);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
