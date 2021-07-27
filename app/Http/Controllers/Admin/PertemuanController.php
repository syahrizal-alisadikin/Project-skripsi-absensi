<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date   = $request->tanggal;
        $start  = 0 ;
        $end    = 15 ;
        $pertemuan = Pertemuan::where('fk_matkul_id',$request->fk_matkul_id)->count();
        if($pertemuan == 0){
             for($start; $start <= $end ; $start++){
            $tanggal_start = $start * 7 ;
            $i = 1 + $start;

            Pertemuan::create([
            'name' => "Pertemuan ". $i,
            'tanggal' => date('Y-m-d', strtotime($date. ' + '. $tanggal_start.' days')),
            'fk_matkul_id' => $request->fk_matkul_id,

            ]);
           
            // $data[] = date('Y-m-d', strtotime($date. ' + '. $tanggal.' days'));
        }
        }else{
            Pertemuan::create([
            'name' => $request->name,
            'tanggal' => $date,
            'fk_matkul_id' => $request->fk_matkul_id,

            ]);

        }
      

        return redirect()->route('matkul.show',$request->fk_matkul_id)->with('success','data berhasil ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pertemuan = Pertemuan::find($id);
        $pertemuan->update([
            'name' => $request->name,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('matkul.show',$pertemuan->fk_matkul_id)->with('success','data berhasil diupdate!!');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertemuan = Pertemuan::find($id);
        $pertemuan->delete();

        if ($pertemuan) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
