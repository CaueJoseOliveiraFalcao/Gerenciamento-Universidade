<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
@php
    if (!empty($user->permissions->first->first()->permission)) {
        $userPermission = $user->permissions->first->first()->permission;
    }
    else {
        $userPermission = 'Nenhuma';
    }
@endphp
<body>
    
    <h1>Pagina de Dashboard </h1>
    @if(Auth::user()->can('admin'))
    <a href="/painel">Painel Administrador</a>

    @else
    <p>Nao pode Acesar  Admin</p>

    @endif
    <form action="/logout" method="POST">
        @csrf
        <input type="submit" value="Logout">
    </form>
</body>
</html>