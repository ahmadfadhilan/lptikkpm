<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class TahunjurExport implements FromQuery,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return DB::connection('15')
        ->table('mahasiswa')
        ->select('mhsNiu','mhsNama','program_studi.prodiNamaResmi','mahasiswa_registrasi.mhsregSemId')
        ->where('mhsNiu','<>','null')
        ->join('mahasiswa_registrasi', 'mahasiswa_registrasi.mhsregMhsNiu', '=', 'mahasiswa.mhsNiu')
        ->join('program_studi', 'program_studi.prodiKode', '=', 'mahasiswa.mhsProdiKode')
        ->orderBy('mhsregSemId');
    }

    public function headings(): array
    {
      return [
          'NIM',
          'Nama',
          'Jurusan',
          'TahunAktif|Semester'
      ];
    }
}
