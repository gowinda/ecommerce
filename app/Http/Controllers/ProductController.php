<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $category = null;
    protected $user = null;
    protected $product = null;
    protected $review = null;
    public function __construct(Category $category, User $user, Product $product, ProductReview $review)
    {
        $this->category = $category;
        $this->user = $user;
        $this->product = $product;
        $this->review = $review;
    }

    public function getAllFeaturedProducts(){
        $this->category = $this->category->where('parent_id',null)->where('status','active')->orderBy('title','ASC')->get();
        $this->product = $this->product->where('status','active')->where('is_featured',1)->with('images')->orderBy('id','DESC')->paginate('40');
        return view('home.product-list')
            ->with('category',$this->category)
            ->with('product_list',$this->product);

    }

    public function getAllProducts(){
        $this->category = $this->category->where('parent_id',null)->where('status','active')->orderBy('title','ASC')->get();
        $this->product = $this->product->where('status','active')->with('images')->orderBy('id','DESC')->paginate('40');
        return view('home.product-list')
            ->with('category',$this->category)
            ->with('product_list',$this->product);
    }

    public function getSearchResult(Request $request){
        $this->category = $this->category->where('parent_id',null)->where('status','active')->orderBy('title','ASC')->get();
        $this->product = $this->product
            ->where('status','active');

        if(isset($request->search)){
            $keyword = $request->search;

            $this->product = $this->product->where('title','LIKE','%'.$keyword.'%');
        }

        if(isset($request->price)){
            // 0-1000
            list($min_price,$max_price) = explode('-',$request->price);
            $this->product = $this->product->where('price','>=', $min_price)->where('price','<=', $max_price);
        }

        $this->product = $this->product->with('images')
                     ->orderBy('id','DESC')
                    ->paginate('40');
               return view('home.product-list')
            ->with('category',$this->category)
            ->with('product_list',$this->product);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->product = $this->product->with(['cat_info','sub_cat_info','seller_info','images'])->paginate();
        return view('admin.product')->with('data',$this->product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = $this->category->where('parent_id',null)->orderBy('title','ASC')->pluck('title','id');
       $seller = $this->user->where('role','seller')->orderBy('name','ASC')->pluck('name','id');
        return view('admin.product-form')->with('category',$parent_cats)->with('seller',$seller);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->product->getRules();
        $request->validate($rules);

        $data = $request->except('image');
        $data['added_by'] = $request->user()->id;

        $data['slug'] = $this->product->getSlug($request->title);

        $this->product->fill($data);
        $status = $this->product->save();
        if($status){
            if($request->image){
                foreach ($request->image as $image_file){
                    $image_name = uploadImage($image_file,'product','200x200');
                    if($image_name){
                        $temp_data = array(
                            'product_id' => $this->product->id,
                            'image_name' => $image_name
                        );
                        $product_image = new ProductImage();
                        $product_image->fill($temp_data);
                        $product_image->save();
                    }
                }
            }
            $request->session()->flash('success','Product added successfully.');
        }else{
            $request->session()->flash('error','Problem while adding product.');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->product = $this->product->where('status','active')
            ->with(['images','cat_info','sub_cat_info','seller_info','reviews','related'])
            ->where('slug',$slug)->firstOrFail();
        $quantity = 0;
        if(session('cart')){
            foreach(session('cart') as $cart_items){
                if($cart_items['product_id'] == $this->product->id){
                    $quantity = $cart_items['quantity'];
                    break;
                }
            }
        }

        return view('home.product-detail')
            ->with('quantity', $quantity)
            ->with('product_detail',$this->product);
    }

    public function storeReview(Request $request){
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['product_id'] = $request->id;
        $data['status'] = 'active';

        $this->review->fill($data);
        $status = $this->review->save();

        if($status){
            $request->session()->flash('success','Your review has been added successfully');
        }else{
            $request->session()->flash('error','Sorry! your review cound not be added at this time. Please try again later');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->product = $this->product->with('images')->find($id);
        if(!$this->product){
            request()->session()->flash('error','Product does not exists');
            return redirect()->route('product.index');
        }
        $parent_cats = $this->category->where('parent_id',null)->orderBy('title','ASC')->pluck('title','id');
        $seller = $this->user->where('role','seller')->orderBy('name','ASC')->pluck('name','id');
        return view('admin.product-form')
            ->with('category',$parent_cats)
            ->with('data',$this->product)
            ->with('seller',$seller);
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
        $this->product = $this->product->with('images')->find($id);
        if(!$this->product){
            request()->session()->flash('error','Product does not exists');
            return redirect()->route('product.index');
        }

        $rules = $this->product->getRules();
        $request->validate($rules);

        $data = $request->except('image');

        $this->product->fill($data);
        $status = $this->product->save();

        if($status){

            if($request->image){
                foreach ($request->image as $image_file){
                    $image_name = uploadImage($image_file,'product','200x200');
                    if($image_name){
                        $temp_data = array(
                            'product_id' => $this->product->id,
                            'image_name' => $image_name
                        );
                        $product_image = new ProductImage();
                        $product_image->fill($temp_data);
                        $product_image->save();
                    }
                }
            }

            if(isset($request->del_image) && !empty($request->del_image)){
                foreach ($request->del_image as $del_image_info){
                    $prod_img = new ProductImage();
                    $prod_img = $prod_img->where('image_name', $del_image_info)->first();
                    $del = $prod_img->delete();
                    if($del){
                        deleteImage($del_image_info, 'product');
                    }

                }
            }

            $request->session()->flash('success','Product added successfully.');
        }else{
            $request->session()->flash('error','Problem while adding product.');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product = $this->product->with('images')->find($id);
        if(!$this->product){
            request()->session()->flash('error','Product does not exists');
            return redirect()->route('product.index');
        }

        $images = $this->product->images;

        $del = $this->product->delete();
        if($del){
            if($images->count() > 0){
                foreach($images as $del_image){
                    deleteImage($del_image->image_name, 'product');
                }
            }
            request()->session()->flash('success','Product deleted successfully.');

        }else{
            request()->session()->flash('error','Sorry! There was problem while deleting product from table.');
        }
        return redirect()->route('product.index');
    }
}
