<?php
namespace App\Imports;
use App\Models\FasilitasPAUD;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FasilitasPaudImport implements ToCollection, WithHeadingRow{
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
                   FasilitasPAUD::create([
                   'kecamatan_id' => config('app.default_profile'),
                   'desa_id' => $this->_desa,
                   'jumlah_paud' => isset($v['jumlah_paud_ra'])?$v['jumlah_paud_ra']:0,
                   'jumlah_guru_paud' => isset($v['jumlah_guru_paud_ra'])?$v['jumlah_guru_paud_ra']:0,
                   'jumlah_siswa_paud' => isset($v['jumlah_siswa_paud_ra'])?$v['jumlah_siswa_paud_ra']:0,
                    'semester' => $this->_semester,
                   'tahun' => $this->_year,
             ]);
        }
    }

    
}

?>