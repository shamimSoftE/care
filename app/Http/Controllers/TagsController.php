<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        publishSchedulePost();
        $data['tags'] = tag::all();
        return view('admin.tags.index',$data);
    }

    public function edit($id)
    {
        publishSchedulePost();
        $data['tags'] = tag::find($id);
        return view('admin.tags.edit',$data);
    }

    public function delete($id)
    {
        publishSchedulePost();
        $blogs = blog::where('tags', 'like', '%'.$id.'%')->get();
        foreach($blogs as $blog)
        {
            $array = explode(',',$blog->tags);
            $arr = array_filter($array, fn($e) => $e !== $id);
            $tags = implode(',',$arr);
            if($tags == "")
            {
                $tags = Null;
            }
            blog::find($blog->id)->update([
                'tags' => $tags,
            ]);
        }

        $tag = tag::find($id)->delete();
        if($tag)
        {
            return back()->with('success','Deleted Successful');
        }
        else{
            return back()->with('error','Something went wrong try again');
        }
    }

    public function store(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();
        $data['created_at'] = Carbon::now();
        DB::beginTransaction();
        try
        {
            DB::commit();
            tag::create($data);
            return back()->with('success', 'Inserted successfully!');

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
        publishSchedulePost();
        $data = $request->all();
        $data['created_at'] = Carbon::now();
        DB::beginTransaction();
        try
        {
            DB::commit();
            tag::find($request->id)->update($data);
            return back()->with('success', 'Updated successfully!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return redirect()->route('tagEdit',$request->id)->with('error', $e)->withInput();
        }
    }
}
