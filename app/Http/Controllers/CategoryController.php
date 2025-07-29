<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;
use Image;

class CategoryController extends Controller
{
    // Category Entry & List Page View
    public function index()
    {
        publishSchedulePost();
        $data['category'] = category::where('id', "!=", 1)->get();
        return view('admin.category.index',$data);
    }
    // Category Store
    public function store(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();
        $data['image'] = "default.jpg";
        $data['created_at'] = Carbon::now();
        DB::beginTransaction();
        try
        {
            if($request->image != "")
            {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(600, 600)->save(public_path('/uploads/images/category/'.$file_name));
                $data['image'] = $file_name;
            }

            DB::commit();
            category::create($data);
            return back()->with('success', 'Inserted successfully!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
    // Category Edit Page View
    public function edit($id)
    {
        publishSchedulePost();
        $data['category'] = category::find($id);
        return view('admin.category.edit',$data);
    }
    // Category Update
    public function update(Request $request)
    {
        publishSchedulePost();
        $oldData = category::find($request->id);
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
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(600, 600)->save(public_path('/uploads/images/category/'.$file_name));
                $data['image'] = $file_name;
                if($oldData->image != 'default.jpg')
                {
                    $delete_previous_image_from = public_path('/uploads/images/category/').$oldData->image;
                    unlink($delete_previous_image_from);
                }
            }

            DB::commit();
            category::find($request->id)->update($data);
            return back()->with('success', 'Updated successfully!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return redirect()->route('categoryEdit',$request->id)->with('error', $e);
        }
    }
    // Category Trashed
    public function trash($id)
    {
        publishSchedulePost();
        blog::where('category',$id)->update([
            'category' => 1,
        ]);
        $subs = subcategory::where('category',$id)->get();
        foreach($subs as $content)
        {
            blog::where('subcategory',$content->id)->update([
                'subcategory' => Null,
            ]);
        }
        $del = category::find($id)->delete();
        if($del)
        {
            subcategory::where('category',$id)->delete();
            return back()->with('success', 'successful!');

        }
        return back()->with('error', 'try again!');
    }
}
