<?php
namespace App\Imports;
use App\Models\PutusSekolah;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PutusSekolahImport implements ToCollection, WithHeadingRow{
    private $_semester = null;
    private $_year = null;
    private $_desa = null;

   
    public function __construct($smstr, $y, $d){
        $this->_semester = $smstr;
        $this->_year = $y;
        $this->_desa = $d;
    }


    public function collection(Collection $rows){
     
           foreach($rows as $v){
                    PutusSekolah::create([
                  'kecamatan_id' => config('app.default_profile'),
                  'desa_id' => $this->_desa,
                  'siswa_paud' => isset($v['siswa_paud_ra'])?$v['siswa_paud_ra']:0,
                  'anak_usia_paud' => isset($v['anak_usia_paud_ra'])?$v['anak_usia_paud_ra']:0,
                  'siswa_sd' => isset($v['siswa_sd_mi'])?$v['siswa_sd_mi']:0,
                  'anak_usia_sd' => isset($v['anak_usia_sd_mi'])?$v['anak_usia_sd_mi']:0,
                  'siswa_smp' => isset($v['siswa_smp_mts'])?$v['siswa_smp_mts']:0,
                  'anak_usia_smp' => isset($v['anak_usia_smp_mts'])?$v['anak_usia_smp_mts']:0,
                  'siswa_sma' => isset($v['siswa_sma_ma'])?$v['siswa_sma_ma']:0,
                  'anak_usia_sma' => isset($v['anak_usia_sma_ma'])?$v['anak_usia_sma_ma']:0,
                  'semester' => $this->_semester,
                  'tahun' =>  $this->_year,
             ]);
        }
    }

    
}

?>