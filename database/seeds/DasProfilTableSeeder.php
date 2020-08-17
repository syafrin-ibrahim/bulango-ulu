<?php

use Illuminate\Database\Seeder;

class DasProfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('das_profil')->delete();

        \DB::table('das_profil')->insert(array (
            0 =>
            array (
                'id' => 1,
                'provinsi_id' => '75',
                'kabupaten_id' => '75.03',
                'kecamatan_id' => '75.03.14',
                'alamat' => 'Jl. Pilolaheya, Desa Mongiilo, Kecamatan Bulango Ulu',
                'kode_pos' => '96543',
                'telepon' => '082197215585',
                'email' => 'admin@mail.com',
                'tahun_pembentukan' => 2007,
                'dasar_pembentukan' => 'PERDA No 30 2007',
                'nama_camat' => 'Hi. I Wayan Ranawa,S.Pt,MM',
                'sekretaris_camat' => 'Ferry Irawan,SE',
                'kasie_pemerintahan_dan_pelum' => 'Miske Nayoan, S.Pd',
                'kasie_kesejahteraan_masyarakat' => 'Fitri Kurnia Dama, SE',
                'kasie_ekonomi_dan_pembangunan' => 'Sofyan Kaluku,S.Ag',
                'kasie_trantib' => 'Hendra husain,SP',
                'kasubag_kepegawaian' => 'Hartono Umar, SE',
                'kasubag_perencanaan_dan_keuangan' => 'Syafrin Ibrahim, SE',
                'file_struktur_organisasi' => 'Lighthouse.jpg',
                'file_logo' => NULL,
                'visi' => NULL,
                'misi' => NULL,
                'created_at' => '2018-02-03 06:57:26',
                'updated_at' => '2018-07-19 01:29:57',
            ),
        ));
    }
}
