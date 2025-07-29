<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\category;
use App\Models\Service;
use App\Models\ServiceModel;
use App\Models\ServiceProduct;
use App\Models\subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Image;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::all();
        return view('admin.service.index',compact('service'));
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit',compact('service'));
    }

    public function delete($id)
    {
        $service = Service::find($id);
        $del = Service::find($id)->delete();
        if($del)
        {
            $delete_previous_image_from = public_path('/uploads/images/service/').$service->image;
            if (file_exists($delete_previous_image_from)) {
                unlink($delete_previous_image_from);
            }
            return back()->with('success', 'successful!');
        }
        return back()->with('error', 'try again!');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_at'] = Carbon::now();

        DB::beginTransaction();
        try
        {
            if($request->image != "")
            {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($image)->resize(120, 120)->save(public_path('/uploads/images/service/'.$file_name));
                $data['image'] = $file_name;
            }

            Service::create($data);
            DB::commit();
            return back()->with('success', 'successful!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }

    public function update(Request $request)
    {
        $oldData = Service::find($request->id);
        $data = $request->all();
        $data['image'] = $oldData->image;
        $data['updated_at'] = Carbon::now();

        DB::beginTransaction();
        try
        {
            if($request->image != "")
            {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($image)->resize(120, 120)->save(public_path('/uploads/images/service/'.$file_name));
                $data['image'] = $file_name;
                $delete_previous_image_from = public_path('/uploads/images/service/').$oldData->image;
                if (file_exists($delete_previous_image_from)) {
                    unlink($delete_previous_image_from);
                }
            }
            $oldData->update($data);
            DB::commit();
            return back()->with('success', 'successful!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';

            return back()->with('error', $e);
        }
    }
}
