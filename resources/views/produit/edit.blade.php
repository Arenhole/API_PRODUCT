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

<h1>Edit {{ $produit->title }}</h1>

{{ Form::model($produit, array('route' => array('path.updateView', $produit->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('stock', 'Stock') }}
        {{ Form::text('stock', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Modifier le produit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

{{ HTML::ul($errors->all()) }}


</div>
</body>
</html>