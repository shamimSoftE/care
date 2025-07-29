<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Booking List
    function list(){
        $data['pending']  = ServiceBooking::where('status','p')->latest()->get();
        $data['approve']  = ServiceBooking::where('status','a')->latest()->get();
        $data['complete'] = ServiceBooking::where('status','d')->latest()->get();
        $data['cancel']   = ServiceBooking::where('status','c')->latest()->get();
        return view('admin.booking.list',$data);
    }
    // Make Booking
    function makeBooking(){
        return view('admin.booking.make_booking');
    }
    // Store
    function store(Request $request){
        $data = $request->all();
        try
        {
            ServiceBooking::create($data);
            return back()->with('success', 'Booking successfully!');

        }
        catch (Exception $e)
        {
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
    // Status
    function status($id , $type){
        ServiceBooking::find($id)->update([
            'status' => $type,
        ]);
        return back()->with('success','Status Updated');
    }
}
