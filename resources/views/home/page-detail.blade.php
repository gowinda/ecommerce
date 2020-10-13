@extends('layouts.home')
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{ asset('uploads/page/Thumb-'.$page_detail->image) }});">
        <h2 class="ltext-105 cl0 txt-center">
            {{ $page_detail->title }}
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            <div class="row p-b-148">
                <div class="col-md-12 col-lg-12">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        {!! $page_detail->description !!}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
