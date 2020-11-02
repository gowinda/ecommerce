
<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Women
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Men
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Shoes
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Watches
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Track Order
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Returns
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Shipping
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on
                    (+1) 96 716 6879
                </p>

                <div class="p-t-27">
                    <div class="addthis_inline_share_toolbox"></div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
                               placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <div class="flex-c-m flex-w p-b-18">
                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
                </a>
            </div>

            <p class="stext-107 cl6 txt-center">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                    href="https://colorlib.com" target="_blank">Colorlib</a>


            </p>
        </div>
    </div>

</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-chevron-up"></i>
		</span>
</div>

<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@yield('scripts')

<script>

    function addToCart(elem){
        var product_id = $(elem).data('product_id');
        var quantity = $('#quantity').val();

        cartProcess(product_id, quantity);
    }

    function cartProcess(product_id, quantity){
        $.ajax({
            url: "{{ route('add-to-cart') }}",
            type: "post",
            data: {
                product_id: product_id,
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            },
            success: function (response){
                if(typeof(response) != "object"){
                    response = JSON.parse(response);
                }
                if(response.status){
                    Swal.fire('Cart Updated!', response.msg, 'success').then(function(){
                        document.location.href = document.location.href;
                    });
                }
            }

        });
    }
</script>



<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f58c4c05bf5b354"></script>
</body>
</html>
