<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Exception;
use Illuminate\Http\Request;
use Image;

class AboutUsController extends Controller
{
    function index()
    {
        $aboutUs = AboutUs::first();
        return view('admin.aboutUs.index',compact('aboutUs'));
    }

    function update(Request $request)
    {
        $oldData               = AboutUs::first();
        $data                  = $request->all();
        $data['main_image']    = $oldData->main_image;
        $data['team_image']    = $oldData->team_image;
        $data['service_image'] = $oldData->service_image;
        try
        {
            if($request->main_image != "")
            {
                $main_image = $request->main_image;
                $extension = $main_image->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($main_image)->resize(770, 430)->save(public_path('/uploads/images/aboutus/'.$file_name));
                $data['main_image'] = $file_name;
                if($oldData->main_image != 'default.jpg')
                {
                    $delete_previous_image_from = public_path('/uploads/images/aboutus/').$oldData->main_image;
                    if (file_exists($delete_previous_image_from)) {
                        unlink($delete_previous_image_from);
                    }
                }
            }
            if($request->team_image != "")
            {
                $team_image = $request->team_image;
                $extension = $team_image->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($team_image)->resize(770, 430)->save(public_path('/uploads/images/aboutus/'.$file_name));
                $data['team_image'] = $file_name;
                if($oldData->team_image != 'default.jpg')
                {
                    $delete_previous_image_from = public_path('/uploads/images/aboutus/').$oldData->team_image;
                    if (file_exists($delete_previous_image_from)) {
                        unlink($delete_previous_image_from);
                    }
                }
            }
            if($request->service_image != "")
            {
                $service_image = $request->service_image;
                $extension = $service_image->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($service_image)->resize(770, 430)->save(public_path('/uploads/images/aboutus/'.$file_name));
                $data['service_image'] = $file_name;
                if($oldData->service_image != 'default.jpg')
                {
                    $delete_previous_image_from = public_path('/uploads/images/aboutus/').$oldData->service_image;
                    if (file_exists($delete_previous_image_from)) {
                        unlink($delete_previous_image_from);
                    }
                }
            }

            $oldData->update($data);

            return back()->with('success', 'Updated successfully!');

        }
        catch (Exception $ex)
        {
            $e = 'Something went wrong pleaser try again';
            return redirect()->back()->with('error', $e);
        }

    }
}
