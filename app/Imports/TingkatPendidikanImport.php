<?php
namespace App\Imports;
use App\Models\TingkatPendidikan;
use App\Models\LogImport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TingkatPendidikanImport implements ToCollection, WithHeadingRow{
    private $_semester = null;
    private $_year = null;
    private $_desa = null;
    private $_import = null;

   
    public function __construct($smstr, $y, $d, $i){
        $this->_semester = $smstr;
        $this->_year = $y;
        $this->_desa = $d;
        $this->_import = $i;
    }


    public function collection(Collection $rows){
     
           foreach($rows as $key => $row){
             TingkatPendidikan::create([
                'kecamatan_id'     => config('app.default_profile'),
                'desa_id'    => $this->_desa,
                'semester' => $this->_semester,
                 'tidak_tamat_sekolah' => isset($row['tidak_tamat_sekolah'])?$row['tidak_tamat_sekolah']:0,
                'tamat_sd' => isset($row['tamat_sd_sederajat'])?$row['tamat_sd_sederajat']:0,
                'tamat_smp' => isset($row['tamat_smp_sederajat'])?$row['tamat_smp_sederajat']:0,
                'tamat_sma' => isset($row['tamat_sma_sederajat'])?$row['tamat_sma_sederajat']:0,
                'tamat_diploma_sederajat' => isset($row['tamat_diploma_sederajat'])?$row['tamat_diploma_sederajat']:0,
                'tahun' => $this->_year,
                'import_id' =>$this->_import
             ]);
        }
    }

    
}

?>