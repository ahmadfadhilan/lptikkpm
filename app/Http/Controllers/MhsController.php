<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\Exports\TahunjurExport;
use App\Exports\JaluruktExport;
use Yajra\DataTables\Datatables;

class MhsController extends Controller
{
      public function index()
      {
        $jurusan=MhsController::jurusan();
        $fakultas=MhsController::fakultas();
        $jalur=MhsController::jalur();

        return view('report',compact('jalur','jurusan','fakultas'));
      }

      public function tahunjur()
      {
        $jurusan=MhsController::jurusan();
        $jalur=MhsController::jalur();

        if(isset($_POST['year'],$_POST['semester'],$_POST['jurusan']))
        {
          $year=$_POST['year'];
          $semester=$_POST['semester'];
          $prodi=$_POST['jurusan'];

          $query = DB::connection('15')->select("SELECT count(mhsNiu) AS jumlah FROM mahasiswa WHERE mhsProdiKode=$prodi
          AND EXISTS (SELECT mhsregMhsNiu FROM mahasiswa_registrasi WHERE mahasiswa.mhsNiu=mahasiswa_registrasi.mhsregMhsNiu AND mhsregSemId=$year$semester)");
        }

          return view('report', compact('query','prodi','jurusan','jalur'));
      }

      public function jalurukt()
      {
        $jurusan=MhsController::jurusan();
        $jalur=MhsController::jalur();

        if(isset($_POST['jlrmsk'])){
            $jlrmsk=$_POST['jlrmsk'];

            $query1 = DB::connection('15')->select("SELECT mhsNiu,mhsNama,s_jalur_ref.jllrNama as jalur,program_studi.prodiNamaResmi as prodi,
            (SELECT jumlah FROM tarif_ukt WHERE idProgramStudiSIA=mahasiswa.mhsProdiKode AND idJalurSIA=mahasiswa.mhsJlrrKode) AS jumlah
            FROM mahasiswa JOIN s_jalur_ref ON s_jalur_ref.jllrKode=mahasiswa.mhsJlrrKode
            JOIN program_studi ON program_studi.prodiKode=mahasiswa.mhsProdiKode WHERE mhsJlrrKode='$jlrmsk'");
          }

        return view('report',compact('jalur','jurusan','query0','query1'));
      }

      public function api(){
        $api=DB::connection('15')
        ->table('mahasiswa')
        ->select('mhsNiu','mhsNama','s_jalur_ref.jllrNama as jalur','program_studi.prodiNamaResmi as prodi')
        ->join('s_jalur_ref','s_jalur_ref.jllrKode','=','mahasiswa.mhsJlrrKode')
        ->join('program_studi','program_studi.prodiKode','=','mahasiswa.mhsProdiKode')
        ->get();

        return Datatables::of($api);

      }

      public function query()
      {
        return DB::connection('15');
      }

      public function jurusan()
      {
        return MhsController::query()
        ->table('program_studi')
        ->select('prodiKode','prodiNamaResmi')
        ->where('prodiFakKode','=','15')
        ->pluck('prodiNamaResmi','prodiKode');
      }

      public function fakultas()
      {
        return MhsController::query()
        ->table('fakultas')
        ->select('fakKode','fakNamaResmi')
        ->pluck('fakNamaResmi','fakKode');
      }

      public function jalur()
      {
        return MhsController::query()
        ->table('s_jalur_ref')
        ->pluck('jllrNama', 'jllrKode');
      }

      public function tjexport()
      {
        return Excel::download(new TahunjurExport, 'tahunjur.xlsx');
      }

      public function juexport()
      {
        return Excel::download(new JaluruktExport, 'jalurukt.xlsx');
      }

}
