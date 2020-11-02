@if(isset($product_list))
    @foreach($product_list as $ind_product)
        <div class="col-sm-6 col-md-3 col-lg-2 p-b-35 isotope-item {{ $ind_product->cat_id }}">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">

                <img src="{{ asset('uploads/product/Thumb-'.$ind_product->images[0]['image_name']) }}" alt="IMG-PRODUCT">


            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <a href="{{ route('product-detail',$ind_product->slug) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                       {{ \Str::words($ind_product->title, 10, '...') }}
                    </a>

                    <span class="stext-105 cl3">
                        @php
                            $price = $ind_product->price;
                            if ($ind_product->discount > 0){
                                $price = $price-(($price * $ind_product->discount)/100);
                            }
                        @endphp
                            NPR. {{ number_format($price) }}
                        @if($ind_product->discount > 0)
                                <del style="color: #ff0000">
                                    NPR. {{ number_format($ind_product->price) }}
                                </del>
                              @endif
								</span>
                </div>


            </div>
        </div>
    </div>
    @endforeach
@endif
