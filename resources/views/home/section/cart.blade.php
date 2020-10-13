<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="fa fa-times-circle"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @php $total_amount = 0; @endphp
                @if(session('cart'))

                    @foreach(session('cart') as $cart_items)
                        @php $total_amount += $cart_items['total_amount']; @endphp
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="{{ $cart_items['image'] }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="{{ $cart_items['product_link'] }}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                   {{ $cart_items['title'] }}
                                </a>

                                <span class="header-cart-item-info">
								{{ $cart_items['quantity'] }} x NPR. {{ $cart_items['after_discount'] }}
							</span>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: NPR. {{ number_format($total_amount) }}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                   @if(session('cart'))
                        <a href="{{ route('cart') }}"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View Cart
                        </a>

                        <a href="{{ route('checkout') }}"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </a>
                       @endif
                </div>
            </div>
        </div>
    </div>
</div>
