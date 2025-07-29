<?php

namespace App\Http\Controllers;

use App\Models\contactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;

class ContactController extends Controller
{
    // Index Page
    function index()
    {
        $contactInfo = contactInfo::first();
        return view('admin.contact.index',compact('contactInfo'));
    }
    // Update
    function update(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();
        $data['created_at'] = Carbon::now();

        DB::beginTransaction();
        try
        {
            contactInfo::first()->update($data);
            DB::commit();

            return back()->with('success', 'Updated Successfully!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';

            return back()->with('error', $e);
        }
    }
}
