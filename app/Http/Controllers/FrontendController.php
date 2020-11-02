<?php

namespace App\Http\Controllers;

use App\Mail\SendContactUs;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Mail;
use Illuminate\View\View;
use PhpParser\Node\Stmt\Return_;

class FrontendController extends Controller
{
    protected $slider = null;
    protected $category = null;
    protected $product = null;
    public function __construct(Slider $slider,Category $category,Product $product)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
    }

    public function contactusPage(){
        return View('home.contact-us');
    }
    public function contactSubmit(Request $request){
        Mail::to(env('ADMIN_EMAIL','lamichhane.gobinda@gmail.com'))->send(new SendContactUs($request->all()));

        $request->session()->flash('success','Thankyou For your Feedback.');
        return redirect()->back();
    }

    public function homePage(){
        $this->slider = $this->slider->where('status','active')->orderBy('id','DESC')->limit(5)->get();
        $this->category = $this->category->where('status','active')->where('parent_id', null)->orderBy('id','DESC')->limit(8)->get();
        $this->product = $this->product->where('status','active')->with('images')->orderBy('id','DESC')->paginate(30);
        return view('home.index')
            ->with('category', $this->category)
            ->with('product_list',$this->product)
            ->with('slider',$this->slider);
    }
}
