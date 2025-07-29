<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Image;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return view('admin.slider.index',compact('slider'));
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function delete($id)
    {
        $slider = Slider::find($id);
        $del = Slider::find($id)->delete();
        if($del)
        {
            $delete_previous_image_from = public_path('/uploads/images/slider/').$slider->image;
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
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $file_name = uniqid().".".$extension;
            Image::make($image)->resize(1536, 578)->save(public_path('/uploads/images/slider/'.$file_name));
            $data['image'] = $file_name;
            Slider::create($data);
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
        $oldData = Slider::find($request->id);
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
                Image::make($image)->resize(1600, 590)->save(public_path('/uploads/images/slider/'.$file_name));
                $data['image'] = $file_name;
                $delete_previous_image_from = public_path('/uploads/images/slider/').$oldData->image;
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
