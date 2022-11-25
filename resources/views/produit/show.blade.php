<!DOCTYPE html>
<html>
<head>
    <title>Produit App</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('view/produit') }}">Produit</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('view/produit') }}">Voir tous les produits</a></li>
        <li><a href="{{ URL::to('view/produit/create') }}">Creer un produit</a></li>
        <li><a href="{{ URL::to('api/documentation') }}">Documentation Swagger</a></li>
    </ul>
</nav>

<h1>Showing {{ $produit->title }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $produit->title }}</h2>
        <p>
            <strong>Stock :</strong> {{ $produit->stock }}
        </p>
    </div>

</div>
</body>
</html>