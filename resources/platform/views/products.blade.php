<div>
    @foreach($products as $product)
        <h1>{{ $product['name'] }}</h1>
        <p>{{ $product['product_type']  }}</p>
    @endforeach
</div>
