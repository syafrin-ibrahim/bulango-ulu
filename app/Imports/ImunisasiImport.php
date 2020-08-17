<?php
namespace App\Imports;
use App\Models\Imunisasi;
use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImunisasiImport implements ToCollection, WithHeadingRow{
    private $_monthImun = null;
    private $_yearImun = null;

   
    public function __construct($m, $y){
        $this->_monthImun = $m;
        $this->_yearImun = $y;
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
             Imunisasi::create([
                'kecamatan_id'     => config('app.default_profile'),
                'desa_id'    => $row['desa_id'],
                'cakupan_imunisasi' => $row['cakupan_imunisasi'],
                'bulan' => $this->_monthImun,
                'tahun' => $this->_yearImun   
             ]);
        }
    }

    
}

?>