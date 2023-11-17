<x-app-layout>
    <h1>Página Principal</h1>


    @foreach (Auth::user()->permissions as $permission)
        <div>
            <p>Nome da permissão: {{ $permission->name }}</p>
        </div>
    @endforeach

</x-app-layout>