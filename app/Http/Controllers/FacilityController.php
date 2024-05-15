<?php

namespace App\Http\Controllers;
use App\Models\Facility;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FacilityController extends Controller
{
    public function index()
    {

        $facilities = Facility::All();

        return view('facility/index', compact('facilities'));
    }


    public function create()
    {
        $facilities = Facility::All();
        return view('facility/create', compact('facilities'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'alamat' => 'required',
            'pj_fasilitas' => 'required',
            'harga_kelola' => 'required',
            'harga_sewa' => 'required',

        ]);
           
        $data = $request->all();
        try {
            $check = Facility::create([
                'nama_fasilitas' => $data['nama_fasilitas'],
                'alamat' => $data['alamat'],
                'pj_fasilitas' =>$data['pj_fasilitas'],
                'harga_kelola' =>$data['harga_kelola'],
                'harga_sewa' =>$data['harga_sewa']
            ]);

            return redirect()->route('facilities.index')->withSuccess('Great! You have added facility '.$check->nama_fasilitas);
        } catch (\Throwable $th) {
            return redirect()->route('facilities.index')->withFailed('oops '.$th);

        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $facility = Facility::find($id);
        return view('facility/edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'alamat' => 'required',
            'pj_fasilitas' => 'required',
            'harga_kelola' => 'required',
            'harga_sewa' => 'required',

        ]);
        $facility->nama_fasilitas = $request->nama_fasilitas;
        $facility->alamat = $request->alamat;
        $facility->pj_fasilitas = $request->pj_fasilitas;
        $facility->harga_kelola = $request->harga_kelola;
        $facility->harga_sewa = $request->harga_sewa;

        $facility->save();

        return redirect()->route('facilities.index')->withSuccess('Great! You have updated facility '.$facility->nama_fasilitas);
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);
        if($facility->delete()){
            return redirect()->route('facilities.index')->withSuccess('Great! You have deleted facility '.$facility->nama_fasilitas);
        }else{
            return redirect()->route('facilities.index')->withFailed('oops data facility cannot be deleted');
        }
    }
}
