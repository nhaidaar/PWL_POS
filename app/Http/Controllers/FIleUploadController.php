<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FIleUploadController extends Controller
{
    public function fileUpload() {
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request) {
        // return "Pemrosesan file upload di sini";
        // dump($request->berkas);

        // if ($request->hasFile('berkas')) {
        //     echo "path(): " . $request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): " . $request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): " . $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): " . $request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): " . $request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): " . $request->berkas->getSize();
        //     echo "<br>";
        // } else {
        //     echo "Tidak ada berkas yang diupload";
        // }

        $request->validate([
            'berkas' => 'required|file|image|max:5000',
        ]);
        // echo $request->berkas->getClientOriginalName() . " lolos validasi";
        // $namaFile = $request->berkas->getClientOriginalName();
        // $extFile = $request->berkas->getClientOriginalName();
        // $namaFile = 'web-' . time() . "." . $extFile;
        // $path = $request->berkas->storeAs('public', $namaFile);

        // $pathBaru = asset('storage/' . $namaFile);
        // echo "proses upload berhasil, file berada di: $path";
        // echo "<br>";
        // echo "Tampilkan link: <a href='$pathBaru'>$pathBaru</a>";

        $extFile = $request->berkas->getClientOriginalName();
        $namaFile = 'web-' . time() . "." . $extFile;

        $path = $request->berkas->move('gambar', $namaFile);
        $path = str_replace("\\", "//", $path);
        echo "Variabel path berisi:$path <br>";

        $pathBaru = asset('gambar/' . $namaFile);
        echo "proses upload berhasil, file berada di: $path";
        echo "<br>";
        echo "Tampilkan link: <a href='$pathBaru'>$pathBaru</a>";
    }

    public function fileUploadRename() {
        return view('file-upload-rename');
    }

    public function prosesFileUploadRename(Request $request) {
        // Get file extension
        $extFile = $request->berkas->extension();
        // Tambahkan extension ke dalam nama file sesuai request
        $nama = $request->nama . ".$extFile";
        // Pindahkan gambar ke folder
        $path = $request->berkas->move('gambar', $nama);
        $path = str_replace("\\", "//", $path);
        $pathBaru = asset('gambar/' . $nama);
        // Tampilan pada view
        echo "Gambar berhasil di upload ke <a href='$pathBaru'>$nama</a>";
        echo "<br>";
        echo "<img src='$pathBaru'>";
    }
}
