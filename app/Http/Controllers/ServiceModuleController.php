<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Brand;
use App\Models\category;
use App\Models\Device;
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

class ServiceModuleController extends Controller
{
    // Service device Index
    public function index_device()
    {
        publishSchedulePost();
        $data['device'] = Device::where('id', "!=", 1)->get();
        return view('service.device.index', $data);
    }
    // Service device Store
    public function store_device(Request $request)
    {
        publishSchedulePost();
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:devices,name',
        ], [
            'name.required' => 'The Device name is required.',
            'name.unique' => 'This Device name already exists. Please choose a different name.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $data = $request->all();
        $data['image'] = "default.jpg";
        $data['created_at'] = Carbon::now();
        DB::beginTransaction();
        try {
            if ($request->image != "") {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(200, 200)->save(public_path('/uploads/images/service/' . $file_name));
                $data['image'] = $file_name;
            }

            DB::commit();
            Device::create($data);
            return back()->with('success', 'Inserted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
    // Service device Edit Page View
    public function edit_device($id)
    {
        publishSchedulePost();
        $data['device'] = Device::find($id);
        return view('service.device.edit', $data);
    }
    // Service device Update
    public function update_device(Request $request)
    {
        publishSchedulePost();
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:devices,name,' . $request->id,
        ], [
            'name.required' => 'The Device name is required.',
            'name.unique' => 'This Device name already exists. Please choose a different name.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        $oldData = Device::find($request->id);
        $data = $request->all();
        $data['image'] = $oldData->image;
        $data['updated_at'] = Carbon::now();
        DB::beginTransaction();
        try {
            if ($request->image != "") {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(200, 200)->save(public_path('/uploads/images/service/' . $file_name));
                $data['image'] = $file_name;
                if ($oldData->image != 'default.jpg') {
                    $delete_previous_image_from = public_path('/uploads/images/service/') . $oldData->image;
                    unlink($delete_previous_image_from);
                }
            }

            DB::commit();
            Device::find($request->id)->update($data);
            return back()->with('success', 'Updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return redirect()->back()->with('error', $e);
        }
    }
    // Service device Trashed
    public function delete_device($id)
    {
        publishSchedulePost();
        ServiceProduct::where('device', $id)->update([
            'device' => 1,
        ]);
        $model = ServiceModel::where('device', $id)->get();
        foreach ($model as $content) {
            ServiceProduct::where('model', $content->id)->update([
                'model' => 1,
            ]);
        }
        $del = Device::find($id)->delete();
        if ($del) {
            ServiceModel::where('device', $id)->delete();
            return back()->with('success', 'Successful!');
        }
        return back()->with('error', 'try again!');
    }
    // ====================================================
    // ====================================================
    // ====================================================
    // Service Brand Index
    public function index_brand()
    {
        publishSchedulePost();
        $data['brand'] = Brand::where('id', "!=", 1)->get();
        return view('service.brand.index', $data);
    }
    // Service brand Store
    public function store_brand(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();
        $data['image'] = "default.jpg";
        $data['created_at'] = Carbon::now();
        DB::beginTransaction();
        try {
            if ($request->image != "") {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(85, 85)->save(public_path('/uploads/images/service/' . $file_name));
                $data['image'] = $file_name;
            }

            DB::commit();
            Brand::create($data);
            return back()->with('success', 'Inserted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
    // Service brand Edit Page View
    public function edit_brand($id)
    {
        publishSchedulePost();
        $data['brand'] = Brand::find($id);
        return view('service.brand.edit', $data);
    }
    // Service brand Update
    public function update_brand(Request $request)
    {
        publishSchedulePost();
        $oldData = Brand::find($request->id);
        $data = $request->all();
        $data['image'] = $oldData->image;
        $data['updated_at'] = Carbon::now();
        DB::beginTransaction();
        try {
            if ($request->image != "") {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(85, 85)->save(public_path('/uploads/images/service/' . $file_name));
                $data['image'] = $file_name;
                if ($oldData->image != 'default.jpg') {
                    $delete_previous_image_from = public_path('/uploads/images/service/') . $oldData->image;
                    unlink($delete_previous_image_from);
                }
            }

            DB::commit();
            Brand::find($request->id)->update($data);
            return back()->with('success', 'Updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return redirect()->back()->with('error', $e);
        }
    }
    // Service brand Trashed
    public function delete_brand($id)
    {
        publishSchedulePost();
        ServiceProduct::where('brand', $id)->update([
            'brand' => 1,
        ]);
        $del = Brand::find($id)->delete();
        if ($del) {
            return back()->with('success', 'Successful!');
        }
        return back()->with('error', 'try again!');
    }
    // ====================================================
    // ====================================================
    // ====================================================
    // Service Type Index
    public function index_type()
    {
        publishSchedulePost();
        $data['type'] = ServiceType::where('id', "!=", 1)->get();
        return view('service.type.index', $data);
    }
    // Service Type Store
    public function store_type(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();
        $data['image'] = "default.jpg";
        $data['created_at'] = Carbon::now();
        DB::beginTransaction();
        try {
            if ($request->image != "") {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(120, 120)->save(public_path('/uploads/images/service/' . $file_name));
                $data['image'] = $file_name;
            }

            DB::commit();
            ServiceType::create($data);
            return back()->with('success', 'Inserted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return back()->with('error', $e)->withInput();
        }
    }
    // Service Type Edit Page View
    public function edit_type($id)
    {
        publishSchedulePost();
        $data['type'] = ServiceType::find($id);
        return view('service.type.edit', $data);
    }
    // Service Type Update
    public function update_type(Request $request)
    {
        publishSchedulePost();
        $oldData = ServiceType::find($request->id);
        $data = $request->all();
        $data['image'] = $oldData->image;
        $data['updated_at'] = Carbon::now();
        DB::beginTransaction();
        try {
            if ($request->image != "") {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(120, 120)->save(public_path('/uploads/images/service/' . $file_name));
                $data['image'] = $file_name;
                if ($oldData->image != 'default.jpg') {
                    $delete_previous_image_from = public_path('/uploads/images/service/') . $oldData->image;
                    unlink($delete_previous_image_from);
                }
            }

            DB::commit();
            ServiceType::find($request->id)->update($data);
            return back()->with('success', 'Updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return redirect()->back()->with('error', $e);
        }
    }
    // Service Type Trashed
    public function delete_type($id)
    {
        publishSchedulePost();
        ServiceProduct::where('type', $id)->update([
            'type' => 1,
        ]);
        $del = ServiceType::find($id)->delete();
        if ($del) {
            return back()->with('success', 'Successful!');
        }
        return back()->with('error', 'try again!');
    }
    // ====================================================
    // ====================================================
    // ====================================================
    // Service Model Entry
    public function index_model()
    {
        publishSchedulePost();
        $data['device'] = Device::get();
        $data['model'] = ServiceModel::all();
        return view('service.model.index', $data);
    }
    // Service Model Store
    public function store_model(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();
        if (ServiceModel::where('device', $request->device)->where('name', $request->name)->exists()) {
            return back()->with('error', 'Model Name Exists')->withInput();
        } else {
            $data['created_at'] = Carbon::now();
            DB::beginTransaction();
            try {
                DB::commit();
                ServiceModel::create($data);
                return back()->with('success', 'Inserted successfully!');
            } catch (Exception $e) {
                DB::rollBack();
                $e = 'Something went wrong pleaser try again';
                return back()->with('error', $e)->withInput();
            }
        }
    }
    // Service Model Edit Page View
    public function edit_model($id)
    {
        publishSchedulePost();
        $data['device'] = Device::get();
        $data['model'] = ServiceModel::find($id);
        return view('service.model.edit', $data);
    }
    // Service Model Store
    public function update_model(Request $request)
    {
        publishSchedulePost();
        $olddata = ServiceModel::find($request->id);
        $data = $request->all();
        $data['created_at'] = Carbon::now();
        DB::beginTransaction();
        try {
            DB::commit();
            $olddata->update($data);
            return back()->with('success', 'Updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            $e = 'Something went wrong pleaser try again';
            return redirect()->route('subcategoryEdit', $request->id)->with('error', $e)->withInput();
        }
    }
    // Service Model delete
    public function delete_model($id)
    {
        publishSchedulePost();
        ServiceProduct::where('model', $id)->update([
            'model' => 1,
        ]);
        $ServiceModel = ServiceModel::find($id)->delete();
        if ($ServiceModel) {
            return back()->with('success', 'Deleted Successful');
        } else {
            return back()->with('error', 'Something went wrong try again');
        }
    }
    // ====================================================
    // ====================================================
    // ====================================================
    // Service Product Entry
    public function index_product()
    {
        publishSchedulePost();
        $data['type'] = ServiceType::where('id', "!=", 1)->get();
        $data['brand'] = Brand::where('id', "!=", 1)->get();
        $data['device'] = Device::where('id', "!=", 1)->get();
        $data['model'] = ServiceModel::all();
        return view('service.product.index', $data);
    }
    public function list_product()
    {
        publishSchedulePost();
        $data['products'] = ServiceProduct::latest()->get();
        return view('service.product.list', $data);
    }
    public function edit_product($id)
    {
        publishSchedulePost();
        $data['product'] = ServiceProduct::find($id);
        $data['type'] = ServiceType::where('id', "!=", 1)->get();
        $data['brand'] = Brand::where('id', "!=", 1)->get();
        $data['device'] = Device::where('id', "!=", 1)->get();
        $data['model'] = ServiceModel::all();
        return view('service.product.edit', $data);
    }
    public function store_product(Request $request)
    {
        publishSchedulePost();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'slug' => 'required|string|unique:service_products,slug',
            'type' => 'required|integer',
            'brand' => 'required|integer',
            'device' => 'required|integer',
            'model' => 'required|integer',
            'short_desp' => 'required|string|max:500',
            'long_desp' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'The name field is required.',
            'price.required' => 'Please specify the price.',
            'price.numeric' => 'The price must be a numeric value.',
            'slug.required' => 'A unique slug is required for the product.',
            'type.required' => 'Please select a type for the product.',
            'model.required' => 'The model field is required.',
            'short_desp.required' => 'Please provide a short description.',
            'long_desp.required' => 'A detailed description is needed.',
            'image.required' => 'An image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $slug = str_replace(" ", "-", $request->slug);
        $data = $request->all();
        $data['slug'] = $slug;

        DB::beginTransaction();
        try {
            if ($request->image != "") {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(600, 600)->save(public_path('/uploads/images/service/product/' . $file_name));
                $data['image'] = $file_name;
            }

            ServiceProduct::create($data);

            DB::commit();

            return back()->with('success', 'Successful!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function update_product(Request $request)
    {
        publishSchedulePost();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'slug' => [
                'required',
                'string',
                Rule::unique('service_products', 'slug')->ignore($request->id)
            ],
            'brand' => 'required|integer',
            'device' => 'required|integer',
            'type' => 'required|integer',
            'model' => 'required|integer',
            'short_desp' => 'required|string|max:500',
            'long_desp' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'The name field is required.',
            'price.required' => 'Please specify the price.',
            'price.numeric' => 'The price must be a numeric value.',
            'slug.required' => 'A unique slug is required for the product.',
            'type.required' => 'Please select a type for the product.',
            'model.required' => 'The model field is required.',
            'short_desp.required' => 'Please provide a short description.',
            'long_desp.required' => 'A detailed description is needed.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        $oldData = ServiceProduct::find($request->id);
        $data =  $request->all();

        $slug = str_replace(" ", "-", $request->slug);
        $data['slug'] = $slug;
        $data['imageAlt'] = $request->imageAlt == null ? $oldData->imageAlt : $request->imageAlt;
        $data['image'] = $oldData->image;


        DB::beginTransaction();
        try {

            if ($request->image != "") {
                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueNumber = rand(100, 999);
                $file_name = $originalName . '-' . $uniqueNumber . '.' . $extension;
                Image::make($image)->resize(600, 600)->save(public_path('/uploads/images/service/product/' . $file_name));
                $data['image'] = $file_name;
                if ($oldData->image != 'default.jpg') {
                    $delete_previous_image_from = public_path('/uploads/images/service/product/') . $oldData->image;
                    if (file_exists($delete_previous_image_from)) {
                        unlink($delete_previous_image_from);
                    }
                }
            }
            $oldData->update($data);

            DB::commit();

            return back()->with('success', 'Successful!');
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    public function delete_product($id)
    {
        publishSchedulePost();
        $delete = ServiceProduct::find($id)->delete();
        if ($delete) {
            return back()->with('success', 'Deleted Successful');
        } else {
            return back()->with('error', 'Something went wrong try again');
        }
    }

    // Ajax ================================================
    public function getModel(Request $request)
    {
        $ServiceModel = ServiceModel::where('device', $request->type_id)->get();
        return $ServiceModel;
    }
    public function getProduct(Request $request)
    {
        $ServiceProduct = ServiceProduct::where('id', $request->id)->with(['rel_to_type', 'rel_to_model', 'rel_to_brand', 'rel_to_device'])->first();
        return $ServiceProduct;
    }
}
