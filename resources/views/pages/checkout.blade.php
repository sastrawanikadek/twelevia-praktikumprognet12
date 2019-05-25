@extends('layouts.pages', ['quantity' => isset($quantity) ? $quantity : null, 'carts' => isset($carts) ? $carts : null])

@section('title')
    Checkout
@endsection

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset("img/breadcumb.jpg") }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <form action="/checkout" method="post">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="checkout_details_area clearfix">

                            <div class="cart-page-heading mb-30">
                                <h5>Billing Address</h5>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="weight">Weight</label>
                                    <input type="text" class="form-control mb-3" id="weight" value="{{ $weight }} Gram" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="address">Address <span>*</span></label>
                                    <input type="text" class="form-control mb-3" id="address" name="address" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="regency">Regency <span>*</span></label>
                                    <select id="regency" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($results as $result)
                                            <option value="{{ $result['city_id'] }}" data-province-id="{{ $result['province_id'] }}" data-province="{{ $result['province'] }}">{{ $result['city_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control mb-3" name="province" id="province" value="" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="courier">Courier <span>*</span></label>
                                    <select name="courier" id="courier" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($couriers as $courier)
                                            <option value="{{ $courier->id }}">{{ $courier->courier }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                        <div class="order-details-confirmation">

                            <div class="cart-page-heading">
                                <h5>Your Order</h5>
                                <p>The Details</p>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Product</span> <span>Total</span></li>
                                @php
                                    $price = 0;
                                    $id = [];

                                    if(isset($product)){
                                        $price += intval($product->price);
                                        array_push($id, $product->id);
                                    } else {
                                        foreach ($carts as $cart) {
                                            $price += intval($cart->price);
                                            array_push($id, $cart->product_id);
                                        }
                                    }
                                @endphp

                                @isset($product)
                                    <li><span>{{ $product->product_name }}</span><span class="price">{{ $product->price }}</span></li>
                                @else
                                    @foreach ($carts as $cart)
                                        <li><span>{{ $cart->product_name }}</span><span class="price">{{ $cart->price }}</span></li>
                                    @endforeach
                                @endisset

                                <li><span>Subtotal</span> <span class="sub price">{{ $price }}</span></li>
                                <li><span>Shipping</span> <span class="shipping price">0</span></li>
                                <li><span>Total</span> <span class="total price">{{ $price }}</span></li>
                            </ul>
                            
                            <input type="hidden" name="product_id" value="{{ implode(',', $id) }}" />
                            <input type="hidden" id="regency_name" name="regency" value="" />

                            <div class="btn-container">
                                <button type="button" class="btn essence-btn danger">Calculate Shipping</button>
                                <button type="submit" class="btn essence-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->
@endsection

@section('script')
    <script>
        $('.order-details-form .price').each(function(index, element){
            const price = parseInt(element.innerText);

            element.innerText = 'Rp' + price.toLocaleString(['ban','id']);
        });

        $("#regency").change(function(){
            const selectedOption = $(this).children("option:selected");
            $("#regency_name").val(selectedOption.text());
            $("#province").val(selectedOption.data("province"));
        });

        $('.btn-container .essence-btn').eq(0).click(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/shipping',
                dataType: 'json',
                data: {
                    'origin': '17',
                    'destination': $("#regency").children("option:selected").val(),
                    'weight': parseInt($("#weight").val().substr(0, $("#weight").val().length - 5)),
                    'courier': $('#courier').children("option:selected").text().toLowerCase()
                },
                success: function(result){
                    const courier = result[0].code.toUpperCase();
                    const costs = result[0].costs;

                    const div = $("<div class='col-12 mb-3'></div>");
                    const label = $("<label for='shipping'>Shipping <span>*</span></label>");
                    const select = $("<select name='shipping' id='shipping' class='form-control'><option value=''>None</option></select>");
                    
                    costs.map(function(cost){
                        const service = cost.service;
                        const price = cost.cost[0].value;
                        const etd = cost.cost[0].etd + " Days";

                        const option = $("<option value='" + price + "'>" + courier + " " + service + " (" + etd + ")</option>");
                        select.append(option);
                    });

                    div.append(label);
                    div.append(select);

                    $(".checkout_details_area .row").eq(0).append(div);

                    $("#shipping").change(function(){
                        const selectedOption = $(this).children("option:selected");
                        $(".shipping.price").eq(0).text('Rp' + parseInt(selectedOption.val()).toLocaleString(['ban', 'id']));
                        $(".total.price").eq(0).text('Rp' + (parseInt($(".sub.price").eq(0).text().substr(2).replace(/\./g, "")) + parseInt(selectedOption.val())).toLocaleString(['ban','id']));
                    });
                }
            });
        });

        $('.btn-container .essence-btn').eq(1).click(function(){
            if($("#shipping").val() === ''){
                alert("Calculate Shipping First");
            }
        });
    </script>
@endsection