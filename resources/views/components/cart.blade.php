<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <div class="cart-button">
        <a href="#" id="rightSideCart"><img src="{{ asset("img/bag.svg") }}" alt=""> <span>{{ isset($quantity) ? $quantity : '' }}</span></a>
    </div>

    <div class="cart-content d-flex">

        <!-- Cart List Area -->
        <div class="cart-list">
            @isset($carts)
                @foreach ($carts as $cart)
                    <!-- Single Cart Item -->
                    <div class="single-cart-item">
                        <form action="/cart/{{ $cart->id }}" class="product-remove" method="POST">
                            @csrf
                            @method("DELETE")

                            <button type="submit" name="submit-btn" value="{{ $cart->id }}"><i class="fa fa-close" aria-hidden="true"></i></button>
                        </form>
                        
                        <a href="#" class="product-image">
                            <img src="{{ $cart->image_name }}" class="cart-thumb" alt="">
                            <!-- Cart Item Desc -->
                            <div class="cart-item-desc">
                                <h6>{{ $cart->product_name }}</h6>
                                <p class="size">Berat: {{ $cart->weight }}Kg</p>
                                <p class="price">{{ $cart->price }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endisset
        </div>

        <!-- Cart Summary -->
        <div class="cart-amount-summary">
            @isset($carts)
                @if (count($carts) > 0)
                    @php
                        $subtotal = 0;
                        $weight = 0;
                        $total = 0;

                        foreach ($carts as $cart) {
                            $subtotal += intval($cart->price);
                            $weight += floatval($cart->weight);
                            $total += intval($cart->price);
                        }
                    @endphp

                    <h2>Summary</h2>

                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span class="subtotal">{{ $subtotal }}</span></li>
                        <li><span>weight:</span> <span class="weight">{{ $weight }}Kg</span></li>
                        <li><span>discount:</span> <span>-15%</span></li>
                        <li><span>total:</span> <span class="total">{{ $total }}</span></li>
                    </ul>
                    <div class="checkout-btn mt-100">
                        <a href="/checkout" class="btn essence-btn">check out</a>
                    </div>
                @else
                    <h2>Cart Is Empty</h2>
                @endif
            @else
                <h2>Login First</h2>
            @endisset
        </div>
    </div>
</div>