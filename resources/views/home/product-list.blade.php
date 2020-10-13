@extends('layouts.home')

@section('content')
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
