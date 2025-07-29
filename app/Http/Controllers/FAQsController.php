<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FAQsController extends Controller
{
    public function index()
    {
        $faq = Faq::all();
        return view('admin.faq.index',compact('faq'));
    }
    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.edit',compact('faq'));
    }

    public function delete($id)
    {
        $del = Faq::find($id)->delete();
        if($del)
        {
            return back()->with('success', 'successful!');
        }
        return back()->with('error', 'try again!');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'que' => 'required',
            'ans' => 'required',
        ], [
            'type.required' => 'Type Required',
            'que.required' => 'Question Required',
            'ans.required' => 'Answer Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $data = $request->all();
        try
        {
            Faq::create($data);
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
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'que' => 'required',
            'ans' => 'required',
        ], [
            'type.required' => 'Type Required',
            'que.required' => 'Question Required',
            'ans.required' => 'Answer Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $oldData = Faq::find($request->id);
        $data = $request->all();
        try
        {
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
