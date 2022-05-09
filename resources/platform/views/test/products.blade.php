<div>
    @foreach($products as $product)
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->productType->name }}</p>
    @endforeach
</div>
