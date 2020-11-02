<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category = null;
    protected $product = null;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function getAllCategoryProducts(Request $request){
        $this->category = $this->category->with('category_products')->where('slug',$request->slug)->firstOrFail();
        return view('home.cat-products')
            ->with('product_list',$this->category->category_products);
    }

    public function getAllSubCategoryProducts(Request $request){
        $this->category = $this->category->with('sub_category_products')->where('slug',$request->slug)->firstOrFail();
        return view('home.cat-products')
            ->with('product_list',$this->category->sub_category_products);
    }

    public function getChildCategory(Request $request){
        if($request->cat_id == null){
            return response()->json(['data'=>null,'img'=>'no child category','status'=>false],200);

        }
       $child_cats = $this->category->where('parent_id',$request->cat_id)->pluck('title','id');
       if($child_cats->count() > 0){
           return response()->json(['data'=>$child_cats,'img'=>'success','status'=>true],200);
       }else{
           return response()->json(['data'=>null,'img'=>'no child category','status'=>false],200);

       }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->category = $this->category->with('parent_info')->orderBy('id','DESC')->paginate('10');
        return view('admin.category')->with('data',$this->category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = $this->category->where('parent_id',null)->pluck('title','id');
        return view('admin.category-form')->with('parent_cat',$parent_cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->category->getRules();
        $request->validate($rules);

        $data = $request->except('image');

        $data['added_by'] = $request->user()->id;
        $data['slug'] = $this->category->getSlug($request->title);

        if($request->image){
            $image_name = uploadImage($request->image, 'category', '1280x200');
            if($image_name){
                $data['image'] = $image_name;
            }
        }
        $this->category->fill($data);
        $status = $this->category->save();
       if ($status){
           $request->session()->flash('success','Category Added successfully');
       }else{
           $request->session()->flash('error','Sorry! There is a problem while adding category');
       }
       return redirect()->route('category.index');
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
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error','Category not found.');
            return redirect()->route('category.index');
        }
        $parent_cats = $this->category->where('parent_id',null)->pluck('title','id');
        return view('admin.category-form')
            ->with('data',$this->category)
            ->with('parent_cat',$parent_cats);
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

        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error','Category not found.');
            return redirect()->route('category.index');
        }

        $rules = $this->category->getRules();
        $request->validate($rules);

        $data = $request->except('image');

        if($request->image){
            $image_name = uploadImage($request->image, 'category', '1280x200');
            if($image_name){
                $data['image'] = $image_name;
                if ($this->category->image != null){
                    deleteImage($this->category->image,'category');
                }
            }
        }
        $this->category->fill($data);
        $status = $this->category->save();
        if ($status){
            $request->session()->flash('success','Category Updated successfully');
        }else{
            $request->session()->flash('error','Sorry! There is a problem while Updaing category');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category = $this->category->find($id);
        if(!$this->category){
            request()->session()->flash('error','Category not found.');
            return redirect()->route('category.index');
        }

        $image = $this->category->image;
        $del = $this->category->delete();
        if($del){
            deleteImage($image,'category');
            request()->session()->flash('success','Category Deleted Successfully.');
        }else{
            request()->session()->flash('error','Sorry! There is problem while deleting category.');
        }
        return redirect()->route('category.index');
    }
}
