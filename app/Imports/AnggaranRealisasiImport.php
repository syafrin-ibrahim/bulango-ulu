<?php
namespace App\Imports;
use App\Models\AnggaranRealisasi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggaranRealisasiImport implements ToCollection, WithHeadingRow{
    private $_month = null;
    private $_year = null;

   
    public function __construct($m, $y){
        $this->_month = $m;
        $this->_year = $y;

    }


    public function collection(Collection $rows){
     
           foreach($rows as $value){
                   AnggaranRealisasi::create([
                   'kecamatan_id' => config('app.default_profile'),
                   'total_anggaran'=> $value['total_anggaran'],
                   'total_belanja'=> $value['total_belanja'],
                   'belanja_pegawai'=> $value['belanja_pegawai'],
                   'belanja_barang_jasa'=> $value['belanja_barang_jasa'],
                   'belanja_modal'=> $value['belanja_modal'],
                   'belanja_tidak_langsung'=> $value['belanja_tidak_langsung'],
                   'bulan' => $this->_month,
                   'tahun' => $this->_year,
             ]);
        }
    }

    
}

?>