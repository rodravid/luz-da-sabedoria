<html>
<head>
    <title>Teste</title>
</head>
<body>

@foreach($products as $product)

    @include('website::layouts.partials.product.cards.default', ['product' => $product])

@endforeach

</body>
</html>