<?php
namespace App\Imports;
use App\Models\AkiAkb;
use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AkiAkbImport implements ToCollection, WithHeadingRow{
    private $_month = null;
    private $_year = null;

   
    public function __construct($m, $y){
        $this->_month = $m;
        $this->_year = $y;
    }


    public function collection(Collection $rows){
        
        // $data = [];

        // foreach($rows as $key => $row){
        //     $data[] = array(
        //         'kecamatan_id'     => config('app.default_profile'),
        //         'desa_id'    => $row['desa_id'],
        //         'cakupan_imunisasi' => $row['cakupan_imunisasi'],
        //         'bulan' => $this->_monthImun,
        //         'tahun' => $this->_yearImun   
        //     );
        // }

        // echo json_encode($data);
        // DB::table('das_imunisasi')->insert($data);

        foreach($rows as $key => $row){
             AkiAkb::create([
                'kecamatan_id'     => config('app.default_profile'),
                'desa_id'    => $row['desa_id'],
                'bulan' => $this->_month,
                'tahun' => $this->_year,
                'aki' => $row['jumlah_aki'],
                'akb' => $row['jumlah_akb'],
                  
             ]);
        }
    }

    
}

?>