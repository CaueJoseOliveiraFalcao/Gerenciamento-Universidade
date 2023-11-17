@php

    $userIf = Auth::user()->permissions;
    $data = json_decode($userIf, true);
    if ($data !== null) {

        foreach ($data as $item) {
            $isAdmin = $item['isAdmin'];
        }
    } else {
        echo "Erro ao decodificar a string JSON.";
    }
    echo $isAdmin
@endphp

<x-app-layout>
    <h1>Página Principal</h1>
    <p>Bem-vindo, {{ Auth::user()->permissions}}!</p>

</x-app-layout>