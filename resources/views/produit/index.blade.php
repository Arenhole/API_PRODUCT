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

<h1>Tous les produits</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Stock dispo</td>
        </tr>
    </thead>
    <tbody>
    @foreach($produits as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->title }}</td>
            <td>{{ $value->stock }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                {{ Form::open(array('url' => 'produit/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Supprimer le produit', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <a class="btn btn-small btn-success" href="{{ URL::to('view/produit/' . $value->id) }}">Montrer ce produit</a>

                <a class="btn btn-small btn-info" href="{{ URL::to('view/produit/' . $value->id . '/edit') }}">Modifier ce produit</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>