<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\blogImage;
use App\Models\category;
use App\Models\subcategory;
use App\Models\tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    // View Entry Page
    public function index()
    {
        publishSchedulePost();
        $data['category'] = category::all();
        return view('admin.blogs.index',$data);
    }
    // View Edit Page
    public function edit($id)
    {
        publishSchedulePost();
        $data['blog'] = blog::find($id);
        $data['category'] = category::all();
        return view('admin.blogs.edit',$data);
    }
    // Delete Blog
    public function delete($id)
    {
        publishSchedulePost();
        $delete = blog::find($id)->delete();
        if($delete)
        {
            return back()->with('success','Deleted Successful');
        }
        else{
            return back()->with('error','Something went wrong try again');
        }
    }
    // View Blogs Lists / View Records
    public function records(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();
        $content['category'] = category::all();
        $content['blogs'] = blog::where('type',1)->where(function($search) use ($data){
            // Search Input Check
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != "undefined")
            {
                $search->where(function($search) use ($data){
                    $search->where('title', 'like', '%'.$data['q'].'%');
                    $search->orWhere('short_desp', 'like', '%'.$data['q'].'%');
                    $search->orWhere('long_desp', 'like', '%'.$data['q'].'%');
                    $search->orWhere('imageAlt', 'like', '%'.$data['q'].'%');
                });
            }
            // Search Category Check
            if(!empty($data['c']) && $data['c'] != '' && $data['c'] != "undefined")
            {
                $search->where(function($search) use ($data){
                    $search->where('category', $data['c']);
                });
            }
            // Date Check
            if(!empty($data['sd']) && $data['sd'] != '' && $data['sd'] != "undefined" || !empty($data['ed']) && $data['ed'] != '' && $data['ed'] != "undefined"){
                $search->whereBetween('date',[$data['sd'],$data['ed']]);
            }
        })->get();

        return view('admin.blogs.records',$content);
    }
    // Store Blog Data
    public function store(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();

        $slug = $request->slug;
        $slug = strtolower($slug);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug);
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');

        if($request->imageAlt == null)
        {
            $data['imageAlt'] = "default";
        }
        $data['slug'] = $slug;
        if($request->type != 2)
        {
            $data['publishDate'] = Null;
        }
        $data['addedBy'] = Auth::id();

        try
        {
            if($request->image != "")
            {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(800, 530)->save(public_path('/uploads/images/blogs/'.$file_name));
                $data['image'] = $file_name;
            }

            blog::create($data)->id;

            return back()->with('success', 'Successful!');
        }
        catch (Exception $ex)
        {
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
    // Update Blog Data
    public function update(Request $request)
    {
        publishSchedulePost();
        $oldData = blog::find($request->id);
        $data = $request->all();
        $data['image'] = $oldData->image;
        if($request->imageAlt == null)
        {
            $data['imageAlt'] = "default";
        }
        $slug = str_replace(" ", "-", $request->slug);
        $slug = str_replace("?", "", $slug);

        // $data['slug'] = Str::slug($request->slug);
        $data['slug'] = $slug;
        if($request->type != 2)
        {
            $data['publishDate'] = Null;
        }
        $data['addedBy'] = Auth::id();
        try
        {

            if($request->image != "")
            {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(800, 530)->save(public_path('/uploads/images/blogs/'.$file_name));
                $data['image'] = $file_name;
                if($oldData->image != 'default.jpg')
                {
                    $delete_previous_image_from = public_path('/uploads/images/blogs/').$oldData->image;
                    if (file_exists($delete_previous_image_from)) {
                        unlink($delete_previous_image_from);
                    }
                }
            }
            blog::find($request->id)->update($data);
            return back()->with('success', 'Successful!');

        }
        catch (Exception $ex)
        {
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
}
