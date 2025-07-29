<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class BlogStatusController extends Controller
{
    public function schedulePostList()
    {
        publishSchedulePost();
        $scheduleBlogs = blog::latest()->where('type',2)->get();
        return view('admin.blogs.blogSchedulePosts',compact('scheduleBlogs'));
    }
    public function draftPostList()
    {
        publishSchedulePost();
        $draftsPost = blog::latest()->where('type',3)->get();
        return view('admin.blogs.draftPostList',compact('draftsPost'));
    }
    public function updatePostStatus(Request $request)
    {
        publishSchedulePost();
        DB::beginTransaction();
        try
        {
            DB::commit();
            blog::find($request->id)->update([
                'publishDate' => $request->publishDate,
                'type' => 2,
            ]);
            return back()->with('success', 'Updated successfully!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
    public function updateBlogToPost($id)
    {
        publishSchedulePost();
        DB::beginTransaction();
        try
        {
            DB::commit();
            blog::find($id)->update([
                'publishDate' => Null,
                'type' => 1,
            ]);
            return back()->with('success', 'Updated successfully!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
    public function updateBlogToDraft($id)
    {
        publishSchedulePost();
        DB::beginTransaction();
        try
        {
            DB::commit();
            blog::find($id)->update([
                'publishDate' => Null,
                'type' => 3,
            ]);
            return back()->with('success', 'Updated successfully!');

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
}
