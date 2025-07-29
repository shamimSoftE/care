<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\blog;
use App\Models\Brand;
use App\Models\category;
use App\Models\Device;
use App\Models\ExperienceVideo;
use App\Models\Faq;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceModel;
use App\Models\ServiceProduct;
use App\Models\ServiceType;
use App\Models\TermAndPrivacy;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    // Home Page
    public function welcome()
    {
        publishSchedulePost();
        $data['service'] = Service::all();
        $data['service_type'] = ServiceType::where('id', '!=', 1)->get();
        $data['experience'] = ExperienceVideo::first();
        $data['review'] = Review::all();
        $data['blog'] = blog::all();
        $data['faq'] = Faq::all();
        return view('welcome', $data);
    }
    // About Page
    public function about()
    {
        publishSchedulePost();
        $data['aboutUs'] = AboutUs::first();
        return view('frontend.aboutUs', $data);
    }
    // Service By Device Page
    public function service_device($device)
    {
        publishSchedulePost();
        $device = Device::where('name', $device)->first();
        $data['model'] = ServiceModel::where('device', $device->id)->get();
        return view('frontend.service_device', $data);
    }
    // Service Product
    public function service_product($slug)
    {
        publishSchedulePost();
        $data['product'] = ServiceProduct::where('slug', $slug)->first();
        $data['service'] = Service::take(3)->get();
        return view('frontend.single_service', $data);
    }
    // Single Blog
    public function blog_single($slug)
    {
        try {
            publishSchedulePost();
            $data['category'] = category::where('id', '!=', 1)->get();
            $data['blog'] = blog::where('slug', $slug)->first();
            if ($data['blog'] == null) {
                return redirect()->back()->with('error', 'blog not found');
            }
            $data['recent_blog'] = blog::take(6)->latest()->get();
            return view('frontend.single_blog', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Item not found' . $th->getMessage());
        }
    }
    // Blog List
    public function blog_list()
    {
        try {
            publishSchedulePost();
            $data['category'] = category::where('id', '!=', 1)->get();
            $data['blog'] = blog::latest()->get();
            $data['recent_blog'] = blog::take(6)->latest()->get();
            return view('frontend.blog_list', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Item not found' . $th->getMessage());
        }
    }
    // Blog Category List
    public function blog_category($slug)
    {
        try {
            publishSchedulePost();
            $data['category'] = category::where('id', '!=', 1)->get();
            $data['c'] = category::where('name', $slug)->first();
            $data['blog'] = blog::where('category', $data['c']->id)->get();
            $data['recent_blog'] = blog::take(6)->latest()->get();
            return view('frontend.blog_category', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Item not found' . $th->getMessage());
        }
    }
    // Term Page
    public function term()
    {
        publishSchedulePost();
        $data['term'] = TermAndPrivacy::first();
        return view('frontend.termCondition', $data);
    }
    // Privacy Page
    public function privacy()
    {
        publishSchedulePost();
        $data['privacy'] = TermAndPrivacy::first();
        return view('frontend.privacyPolicy', $data);
    }
    // Contact Page
    public function contact()
    {
        publishSchedulePost();
        return view('frontend.contact');
    }

    // Search Page
    public function search(Request $request)
    {
        publishSchedulePost();
        $data = $request->all();
        $content['brand'] = Brand::where('id', '!=', 1)->get();
        $content['products'] = ServiceProduct::where(function ($search) use ($data) {
            // Search Input Check
            if (!empty($data['s']) && $data['s'] != '' && $data['s'] != "undefined") {
                $search->where(function ($search) use ($data) {
                    $search->where('name', 'like', '%' . $data['s'] . '%')
                        ->orWhereHas('rel_to_type', function ($query) use ($data) {
                            $query->where('name', 'like', '%' . $data['s'] . '%');
                        });
                });
            }
        })->get();
        return view('frontend.search', $content);
    }
    // Search Page
    public function blogs($slug)
    {
        publishSchedulePost();
        $data['brand']    = Brand::where('id', '!=', 1)->get();
        $data['b']        = Brand::where('name', $slug)->first();
        $data['products'] = ServiceProduct::where('brand', $data['b']->id)->get();
        return view('frontend.brand', $data);
    }
}
