@extends('layouts.home')

@section('content')
    <!-- Slider -->
    @if($slider)
        <section class="section-slide">
            <div class="wrap-slick1">
                <div class="slick1">

                @foreach($slider as $slider_data)
                    <!-- <a href="{{$slider_data->link}}"> -->
                        <div class="item-slick1 img img-fluid" style="background-image: url({{ asset('uploads/slider/Thumb-'.$slider_data->image) }}); height: 50%">
                            <div class="container h-full">
                                <div class="flex-col-l h-full p-t-100 p-b-30 respon5">
                                    <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									{{ $slider_data->title }}
								</span>
                                    </div>

                                    <div class="layer-slick1 animated visible-false " data-appear="rotateInUpRight" data-delay="800">
                                        <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                            New arrivals
                                        </h2>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                                        <a href="##" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if($category)
        <!-- Banner -->
        <div class="sec-banner bg0 p-t-80 p-b-50">
            <div class="container">
                <div class="row">
                    @foreach($category as $cat_data)
                        <div class="col-md-3 col-xl-3 p-b-30 m-lr-auto">
                            <!-- Block1 -->
                            <div class="block1 wrap-pic-w">
                                <img src="{{asset('uploads/category/Thumb-'.$cat_data->image)}}" alt="IMG-BANNER">

                                <a href="{{route('cat-product', $cat_data->slug)}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                    <div class="block1-txt-child1 flex-col-l">
									<span class="block1-name ltext-102 trans-04 p-b-8">
										{{$cat_data->title}}
									</span>


                                    </div>

                                    <div class="block1-txt-child2 p-b-4 trans-05">
                                        <div class="block1-link stext-101 cl0 trans-09">
                                            Shop Now
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @endif
    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Product Overview
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        All Products
                    </button>

                   @if(isset($category))
                       @foreach($category as $cat_list)
                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $cat_list->id }}">
                                {{ $cat_list->title }}
                            </button>
                        @endforeach
                       @endif
                </div>

                <div class="flex-w flex-c-m m-tb-10">

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 fa fa-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 fa fa-times-circle dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <form action="{{ route('search') }}" method="get">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="fa fa-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search"
                               placeholder="Search">
                    </div>
                    </form>
                </div>


            </div>

            <div class="row isotope-grid">
                @include('home._product_list')
            </div>


        </div>
    </section>

@endsection
