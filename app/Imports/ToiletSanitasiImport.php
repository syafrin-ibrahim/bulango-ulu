<?php
namespace App\Imports;
use App\Models\ToiletSanitasi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ToiletSanitasiImport implements ToCollection, WithHeadingRow{
    private $_month = null;
    private $_year = null;

   
    public function __construct($m, $y){
        $this->_month = $m;
        $this->_year = $y;
    }


    public function collection(Collection $rows){

           foreach($rows as $key => $row){
             ToiletSanitasi::create([
                'kecamatan_id'     => config('app.default_profile'),
                'desa_id'    => $row['desa_id'],
                 'bulan' => $this->_month,
                'tahun' => $this->_year,
                'sanitasi' => $row['sanitasi'],                  
                'toilet' => $row['toilet']
             ]);
        }


    }

    
}

?>