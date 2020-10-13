<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $slider = null;
   public function __construct(Slider $slider)
   {
       $this->slider = $slider;
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->slider = $this->slider->with('created_by')->OrderBy('id','DESC')->get();
        return view('admin.slider')->with('data',$this->slider);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->slider->getRules();
        $request->validate($rules);

        $data = $request->except('image');

        if($request->image){
          $image_name = uploadImage($request->image, 'slider','1280x720');
          if($image_name){
              $data['image'] = $image_name;
          }
        }
        $data['added_by'] = $request->user()->id;
        $this->slider->fill($data);
        $success = $this->slider->save();
        if ($success){
            $request->session()->flash('success','Slider Added Successfully.');
        }else{
            $request->session()->flash('error','Sorry! There was problem while adding Slider.');
        }
        return redirect()->route('slider.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->slider = $this->slider->find($id);
        if(!$this->slider){
            request()->session()->flash('error','Slider does not exists.');
            return redirect()->route('slider.index');
        }

        return view('admin.slider-form')->with('data',$this->slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->slider = $this->slider->find($id);
        if(!$this->slider){
            request()->session()->flash('error','Slider does not exists.');
            return redirect()->route('slider.index');
        }

        $rules = $this->slider->getRules("update");
        $request->validate($rules);

        $data = $request->except('image');

        if($request->image){
            $image_name = uploadImage($request->image, 'slider','1280x720');
            if($image_name){
                $data['image'] = $image_name;
                deleteImage($this->slider->image, 'slider');
            }
        }
        $this->slider->fill($data);
        $success = $this->slider->save();
        if ($success){
            $request->session()->flash('success','Slider Updated Successfully.');
        }else{
            $request->session()->flash('error','Sorry! There was problem while updating Slider.');
        }
        return redirect()->route('slider.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->slider = $this->slider->find($id);
        if(!$this->slider){
            request()->session()->flash('error','Slider does not exists.');
           return redirect()->route('slider.index');
        }
        $image = $this->slider->image;
        $del = $this->slider->delete();
        if($del){
            deleteImage($image,'slider');
            request()->session()->flash('success','Slider Deleted Successfully.');
        }else{
            request()->session()->flash('error','Sorry! There was problem while deleting Slider.');

        }
        return redirect()->route('slider.index');
    }
}
