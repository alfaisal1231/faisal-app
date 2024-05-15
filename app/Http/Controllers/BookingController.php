<?php

namespace App\Http\Controllers;

use App\Models\BookingFacility;
use App\Models\Facility;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = BookingFacility::All();
        return view('bookings/index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facilities = Facility::All();
        return view('bookings/create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_transaksi' => 'required',
            'nama_customer' => 'required',
            'alamat_customer' => 'required',
            'harga_sewa' => 'required',
            'harga_kelola' => 'required',
            'lama_sewa' => 'required',
            'total_sewa' => 'required',
            'nama_kasir' => 'required',
            'facility' => 'required|exists:facilities,id',
        ]);

        $already = BookingFacility::where(['tgl_transaksi' => $request->tgl_transaksi, 'id_facility' => $request->facility]);

        if($already->count() > 0){
            return redirect()->route('bookings.index')->withFailed($already->first()->facility->nama_fasilitas.' already booked!');
        }
           
        $data = $request->all();
        try {
            $check = BookingFacility::create([
                'tgl_transaksi' => $data['tgl_transaksi'],
                'nama_customer' => $data['nama_customer'],
                'alamat_customer' => $data['alamat_customer'],
                'harga_sewa' => $data['harga_sewa'],
                'harga_kelola' => $data['harga_kelola'],
                'lama_sewa' => $data['lama_sewa'],
                'total_sewa' => $data['total_sewa'],
                'nama_kasir' => $data['nama_kasir'],
                'id_facility' => $data['facility'],
            ]);

            return redirect()->route('bookings.index')->withSuccess('Great! You have booked '.$check->facility->nama_fasilitas);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('bookings.index')->withFailed('oops '.$th);

        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingFacility $bookingFacility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bookings = BookingFacility::find($id);
        return view('bookings/edit', compact('bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingFacility $bookings)
    {
        $request->validate([
            'tgl_transaksi' => 'required',
            'nama_customer' => 'required',
            'alamat_customer' => 'required',
            'harga_sewa' => 'required',
            'harga_kelola' => 'required',
            'lama_sewa' => 'required',
            'total_sewa' => 'required',
            'nama_kasir' => 'required',
            'facility' => 'required|exists:facilities,id',
        ]);
        $bookings->tgl_transaksi = $request->tgl_transaksi;
        $bookings->nama_customer = $request->nama_customer;
        $bookings->alamat_customer = $request->alamat_customer;
        $bookings->harga_sewa = $request->harga_sewa;
        $bookings->harga_kelola = $request->harga_kelola;
        $bookings->lama_sewa = $request->lama_sewa;
        $bookings->total_sewa = $request->total_sewa;
        $bookings->nama_kasir = $request->nama_kasir;
        $bookings->facility = $request->facility;
        $bookings->save();
        return redirect()->route('bookings.index')->withSuccess('Great! You have updated facility '.$bookings->nama_fasilitas);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bookings = BookingFacility::find($id);
        if($bookings->delete()){
            return redirect()->route('bookings.index')->withSuccess('Great! You have deleted Booking '.$bookings->nama_customer);
        }else{
            return redirect()->route('bookings.index')->withFailed('oops data Booking cannot be deleted');
        }
    }
}
