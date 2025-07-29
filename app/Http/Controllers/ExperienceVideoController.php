<?php

namespace App\Http\Controllers;

use App\Models\ExperienceVideo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienceVideoController extends Controller
{
    // Index Page
    function index()
    {
        $experienceVideo = ExperienceVideo::first();
        return view('admin.experienceVideo.index', compact('experienceVideo'));
    }
    // Update
    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desp' => 'required',
            'link' => 'required',
        ], [
            'desp.required' => 'The Description Required',
            'link.required' => 'The Video Link Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $data = $request->all();

        try {
            ExperienceVideo::first()->update($data);

            return back()->with('success', 'Updated Successfully!');
        } catch (Exception $e) {
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e);
        }
    }
}
