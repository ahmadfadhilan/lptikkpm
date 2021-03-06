<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\Exports\TahunjurFTIExport;
use App\Exports\JaluruktFTIExport;

class FTIController extends Controller
{
    public function index()
    {
      $jurusan=FTIController::jurusan();
      $jalur=FTIController::jalur();

      return view('report.fti.report',compact('jalur','jurusan'));
    }

    public function tahunjur()
    {
      $jurusan=FTIController::jurusan();
      $jalur=FTIController::jalur();

      if(isset($_POST['year'],$_POST['semester'],$_POST['jurusan']))
      {
        $year=$_POST['year'];
        $semester=$_POST['semester'];
        $prodi=$_POST['jurusan'];

        $query = DB::connection('15')->select("SELECT count(mhsNiu) AS jumlah FROM mahasiswa WHERE mhsProdiKode=$prodi
        AND EXISTS (SELECT mhsregMhsNiu FROM mahasiswa_registrasi WHERE mahasiswa.mhsNiu=mahasiswa_registrasi.mhsregMhsNiu AND mhsregSemId=$year$semester)");
      }

        return view('report.fti.report', compact('query','prodi','jurusan','jalur'));
    }

    public function jalurukt()
    {
      $jurusan=FTIController::jurusan();
      $jalur=FTIController::jalur();

      if(isset($_POST['jlrmsk'])){
          $jlrmsk=$_POST['jlrmsk'];

          $query0 = DB::connection('15')->select("SELECT count(mhsNiu) AS jumlah
          FROM mahasiswa JOIN s_jalur_ref ON s_jalur_ref.jllrKode=mahasiswa.mhsJlrrKode
          JOIN program_studi ON program_studi.prodiKode=mahasiswa.mhsProdiKode WHERE mhsJlrrKode='$jlrmsk'");

          $query1 = DB::connection('15')->select("SELECT mhsNiu,mhsNama,s_jalur_ref.jllrNama as jalur,program_studi.prodiNamaResmi as prodi,
          (SELECT jumlah FROM tarif_ukt WHERE idProgramStudiSIA=mahasiswa.mhsProdiKode AND idJalurSIA=mahasiswa.mhsJlrrKode) AS jumlah
          FROM mahasiswa JOIN s_jalur_ref ON s_jalur_ref.jllrKode=mahasiswa.mhsJlrrKode
          JOIN program_studi ON program_studi.prodiKode=mahasiswa.mhsProdiKode WHERE mhsJlrrKode='$jlrmsk'");
        }

      return view('report.fti.report',compact('jalur','jurusan','query0','query1'));
    }

    public static function jurusan()
    {
      return DB::connection('15')
      ->table('program_studi')
      ->select('prodiKode','prodiNamaResmi')
      ->where('prodiFakKode','=','15')
      ->pluck('prodiNamaResmi','prodiKode');
    }

    public static function jalur()
    {
      return DB::connection('15')
      ->table('s_jalur_ref')
      ->pluck('jllrNama', 'jllrKode');
    }

    public function tjexport()
    {
      return Excel::download(new TahunjurFTIExport, 'tahunjurfti.xlsx');
    }

    public function juexport()
    {
      return Excel::download(new JaluruktFTIExport, 'jaluruktfti.xlsx');
    }
}
