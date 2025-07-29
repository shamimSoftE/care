<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use App\Models\TermAndPrivacy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class CompanyProfileController extends Controller
{
    function index()
    {
        $companyInfo = CompanyInfo::first();
        return view('admin.companyinfo',compact('companyInfo'));
    }

    function update(Request $request)
    {
        $oldData = CompanyInfo::first();
        $data = $request->all();
        $data['logo'] = $oldData->logo;
        $data['favicon'] = $oldData->favicon;
        try
        {
            if($request->logo != "")
            {
                $logo = $request->logo;
                $extension = $logo->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($logo)->resize(575, 182)->save(public_path('/uploads/images/company/'.$file_name));
                $data['logo'] = $file_name;
                if($oldData->logo != 'default.jpg')
                {
                    $delete_previous_image_from = public_path('/uploads/images/company/').$oldData->logo;
                    if (file_exists($delete_previous_image_from)) {
                        unlink($delete_previous_image_from);
                    }
                }
            }

            if($request->favicon != "")
            {
                $favicon = $request->favicon;
                $extension = $favicon->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($favicon)->resize(70, 70)->save(public_path('/uploads/images/company/'.$file_name));
                $data['favicon'] = $file_name;
                if($oldData->favicon != 'default.jpg')
                {
                    $delete_previous_image_from = public_path('/uploads/images/company/').$oldData->favicon;
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

    function term_privacy_index()
    {
        $TermAndPrivacy = TermAndPrivacy::first();
        return view('admin.termPrivacy',compact('TermAndPrivacy'));
    }

    function term_privacy_update(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'term'    => 'required',
            'privacy' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        try
        {
            TermAndPrivacy::first()->update($data);
            return back()->with('success', 'Updated successfully!');
        }
        catch (Exception $ex)
        {
            $e = 'Something went wrong pleaser try again';
            return redirect()->back()->with('error', $e);
        }

    }
}
