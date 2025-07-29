<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $review = Review::all();
        return view('admin.review.index',compact('review'));
    }

    public function edit($id)
    {
        $review = Review::find($id);
        return view('admin.review.edit',compact('review'));
    }

    public function delete($id)
    {
        $review = Review::find($id);
        $del = Review::find($id)->delete();
        if($del)
        {
            if($review->image != 'user.jpg')
            {
                $delete_previous_image_from = public_path('/uploads/images/review/').$review->image;
                if (file_exists($delete_previous_image_from)) {
                    unlink($delete_previous_image_from);
                }
            }
            return back()->with('success', 'successful!');
        }
        return back()->with('error', 'try again!');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_at'] = Carbon::now();

        try
        {
            if($request->image != "")
            {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($image)->resize(120, 120)->save(public_path('/uploads/images/review/'.$file_name));
                $data['image'] = $file_name;
            }

            Review::create($data);
            return back()->with('success', 'successful!');

        }
        catch (Exception $ex)
        {
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }

    public function update(Request $request)
    {
        $oldData = Review::find($request->id);
        $data = $request->all();
        $data['image'] = $oldData->image;
        $data['updated_at'] = Carbon::now();

        try
        {
            if($request->image != "")
            {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $file_name = uniqid().".".$extension;
                Image::make($image)->resize(120, 120)->save(public_path('/uploads/images/review/'.$file_name));
                $data['image'] = $file_name;
                $delete_previous_image_from = public_path('/uploads/images/review/').$oldData->image;
                if (file_exists($delete_previous_image_from)) {
                    unlink($delete_previous_image_from);
                }
            }
            $oldData->update($data);
            return back()->with('success', 'successful!');

        }
        catch (Exception $e)
        {
            $e = 'Something went wrong pleaser try again';

            return back()->with('error', $e);
        }
    }
}
