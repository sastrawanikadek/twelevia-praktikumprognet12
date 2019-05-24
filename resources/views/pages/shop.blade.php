@extends('layouts.pages', ['quantity' => isset($quantity) ? $quantity : null, 'carts' => isset($carts) ? $carts : null])

@section('title')
    Shop
@endsection

@section('css')
   <style>
       .collapse.in{
           display: block !important;
       }
   </style> 
@endsection

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{ asset("img/breadcumb.jpg") }}">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        @if (isset($category))
                            <h2>{{ $category }} ({{ $type }})</h2>
                        @else
                            <h2>Shop</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Categories</h6>
                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#women">
                                        <a href="#">Women</a>
                                    <ul class="sub-menu collapse {{ isset($type) && $type == 'Women' ? 'in' : '' }}" id="women">
                                            @foreach ($categories as $item)
                                                @if ($item->category_type == "1")
                                                    <li><a href="/shop/Women/{{ $item->category_name }}">{{ $item->category_name }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#men" class="collapsed">
                                        <a href="#">Men</a>
                                        <ul class="sub-menu collapse {{ isset($type) && $type == 'Men' ? 'in' : '' }}" id="men">
                                            @foreach ($categories as $item)
                                                @if ($item->category_type == "2")
                                                    <li><a href="/shop/Men/{{ $item->category_name }}">{{ $item->category_name }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#kid" class="collapsed">
                                        <a href="#">Kid</a>
                                        <ul class="sub-menu collapse {{ isset($type) && $type == 'Kid' ? 'in' : '' }}" id="kid">
                                            @foreach ($categories as $item)
                                                @if ($item->category_type == "3")
                                                    <li><a href="/shop/Kid/{{ $item->category_name }}">{{ $item->category_name }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>{{ count($products) }}</span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="value">Highest Rated</option>
                                                <option value="value">Newest</option>
                                                <option value="value">Price: $$ - $</option>
                                                <option value="value">Price: $ - $$</option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                            @foreach ($products as $product)
                            <!-- Single Product -->
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="single-product-wrapper">
                                        <!-- Product Image -->
                                        <div class="product-img">
                                            <img src="{{ $product->image_name }}" alt="{{ $product->product_name }}" style="height: 300px; width: 100%; object-fit: contain;">
                                            <!-- Hover Thumb -->
                                            <img class="hover-img" src="{{ $product->image_name }}" alt="{{ $product->product_name }}">
    
                                            <!-- Product Badge -->
                                            <div class="product-badge offer-badge">
                                                <span>-30%</span>
                                            </div>
                                            <!-- Favourite -->
                                            <div class="product-favourite">
                                                <a href="#" class="favme fa fa-heart"></a>
                                            </div>
                                        </div>
    
                                        <!-- Product Description -->
                                        <div class="product-description">
                                            <span>topshop</span>
                                            <a href="single-product-details.html">
                                                <h6>{{ $product->product_name }}</h6>
                                            </a>
                                            <p class="product-price"><span class="old-price">75.00</span><span class="new-price">{{ $product->price }}</span></p>
    
                                            <!-- Hover Content -->
                                            <div class="hover-content">
                                                <!-- Add to Cart -->
                                                <div class="add-to-cart-btn">
                                                    <form action="/cart" method="POST">
                                                        @csrf
                                                        
                                                        <button type="submit" name="product_id" class="btn essence-btn" value="{{ $product->id }}"><i class="fa fa-shopping-bag"></i> Add</button>
                                                    </form>
                                                </div>
                                                <div class="buy-now-btn">
                                                    <a href="/checkout?item={{ $product->id }}" class="btn essence-btn danger"><i class="fa fa-truck"></i> Buy</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Pagination -->
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->
@endsection

@section('script')
    <script>
        $('.old-price').each(function(index, element){
            const price = parseInt(element.innerText);

            element.innerText = 'Rp' + price.toLocaleString(['ban','id']);
        });

        $('.new-price').each(function(index, element){
            const price = parseInt(element.innerText);

            element.innerText = 'Rp' + price.toLocaleString(['ban','id']);
        });
    </script>
@endsection