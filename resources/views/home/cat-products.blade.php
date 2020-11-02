@extends('layouts.home')

@section('content')
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Product Overview
                </h3>
            </div>

            <div class="row isotope-grid">
                @include('home._product_list')
            </div>


        </div>
    </section>

@endsection
