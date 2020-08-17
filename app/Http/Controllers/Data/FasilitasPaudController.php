<?php

namespace App\Http\Controllers\Data;

use App\Models\FasilitasPAUD;
use App\Models\Kecamatan;
use App\Models\Wilayah;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\FasilitasPaudImport;
use Excel;

class FasilitasPaudController extends Controller
{
    //

    public function index()
    {
        //
        $kecamatan = Wilayah::where('kode',config('app.default_profile'))->first();
        $page_title = 'Fasilitas PAUD';
        $page_description = 'Data Fasilitas PAUD Kecamatan '.$kecamatan->nama_kecamatan;
        return view('data.fasilitas_paud.index', compact('page_title', 'page_description'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataFasilitasPAUD()
    {
        //
        return DataTables::of(FasilitasPAUD::with(['desa'])->select('*')->get())
            ->addColumn('actions', function ($row) {
                $edit_url = route('data.fasilitas-paud.edit', $row->id);
                $delete_url = route('data.fasilitas-paud.destroy', $row->id);

                $data['edit_url'] = $edit_url;
                $data['delete_url'] = $delete_url;

                return view('forms.action', $data);
            })
            ->editColumn('desa_id', function($row){
                return $row->desa->nama;
            })
            ->rawColumns(['actions'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        //
        $page_title = 'Import';
        $page_description = 'Import Data Fasilitas PAUD';
        $years_list = years_list();
        $months_list = months_list();
        // return view('data.fasilitas_paud.import', compact('page_title', 'page_description', 'list_desa', 'years_list', 'months_list'));
        return view('data.fasilitas_paud.import', compact('page_title', 'page_description', 'years_list', 'months_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function do_import(Request $request)
    {
        //
        ini_set('max_execution_time', 300);
        $semester = $request->input('semester');
        $tahun = $request->input('tahun');
        $desa_id = $request->input('desa_id');

        request()->validate([
            'file' => 'file|mimes:xls,xlsx,csv|max:5120',
        ]);

        if ($request->hasFile('file') && $this->uploadValidation($desa_id, $semester, $tahun)) {
            try{
                 $path = $request->file('file');
                 Excel::import(new FasilitasPaudImport($semester, $tahun, $desa_id), $path);
                  return back()->with('success', 'Import data sukses.');
            }catch (\Exception $ex){
                return back()->with('error', 'Import data gagal. '.$ex->getMessage());
            }

        }else{
            return back()->with('error', 'Import data gagal. Data sudah pernah diimport.');
        }
    }

    protected function uploadValidation($desa_id, $semester, $tahun){
        return !FasilitasPAUD::where('semester',$semester)->where('tahun', $tahun)->where('desa_id', $desa_id)->exists();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $fasilitas = FasilitasPAUD::findOrFail($id);
        $page_title = 'Ubah';
        $page_description = 'Ubah Data Fasilitas PAUD';
        return view('data.fasilitas_paud.edit', compact('page_title', 'page_description', 'fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            request()->validate([
                'jumlah_paud' => 'required',
                'jumlah_guru_paud' => 'required',
                'jumlah_siswa_paud' => 'required',
                'bulan' => 'required',
                'tahun' => 'required',
            ]);

            FasilitasPAUD::find($id)->update($request->all());

            return redirect()->route('data.fasilitas-paud.index')->with('success', 'Data berhasil disimpan!');
        }catch (Exception $e){
            return back()->withInput()->with('error', 'Data gagal disimpan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            FasilitasPAUD::findOrFail($id)->delete();

            return redirect()->route('data.fasilitas-paud.index')->with('success', 'Data sukses dihapus!');

        } catch (Exception $e) {
            return redirect()->route('data.fasilitas-paud.index')->with('error', 'Data gagal dihapus!');
        }
    }
}
