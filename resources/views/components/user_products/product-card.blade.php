<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
        <img src="{{ asset('assets/images/products/default.jpeg') }}">
        {{-- <img src="{{ $product->image_url }}"
            onerror="this.onerror=null; this.src='{{ asset('assets/images/products/default.jpeg') }}';"> --}}
        {{-- onerror="this.src='{{ asset('assets/images/products/default.jpeg') }}';" alt="#"> --}}
        {{-- onerror="src='{{ asset('assets/images/products/default.jpeg') }}';" alt="#"> --}}
        @if ($product->discount)
            <span class="sale-tag">-{{ $product->discount }}%</span>
        @endif
        @if ($product->new)
            <span class="new-tag">New</span>
        @endif
        <div class="button">
            <a href="{{ route('front.products.show', $product->slug) }}" method='post' class="btn"><i
                    class="lni lni-cart"></i> Add to
                Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{ route('front.products.show', $product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            @foreach (range(1, 5) as $i)
                @if ($i <= $product->rating)
                    <li><i class="lni lni-star-filled"></i></li>
                @else
                    <li><i class="lni lni-star"></i></li>
                @endif
            @endforeach
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            @if ($product->compare_price)
                <span>{{Currency::format($product->compare_price, Cache::get("currency_code")) }}</span>
                <span class="discount-price">{{Currency::format($product->price, Cache::get("currency_code")) }}</span>
            @else
                <span>{{Currency::format($product->price, Cache::get("currency_code")) }}</span>
            @endif
        </div>
    </div>
</div>
<!-- End Single Product -->