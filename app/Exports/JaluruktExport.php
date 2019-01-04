<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class JaluruktExport implements FromQuery,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
      return DB::connection('15')
      ->table('mahasiswa')->select('mhsNiu','mhsNama','s_jalur_ref.jllrNama','program_studi.prodiNamaResmi')
      ->join('s_jalur_ref', 's_jalur_ref.jllrKode', '=', 'mahasiswa.mhsJlrrKode')
      ->join('program_studi', 'program_studi.prodiKode', '=', 'mahasiswa.mhsProdiKode')
      ->orderBy('mhsNiu');
    }

    public function headings(): array
    {
      return [
          'NIM',
          'Nama',
          'Jalur Masuk',
          'Jurusan',
      ];
    }
}
