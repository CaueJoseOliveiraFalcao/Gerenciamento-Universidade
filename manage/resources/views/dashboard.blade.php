<x-app-layout>
    <h1>Página Principal</h1>

    @if(Auth::check() && Auth::user()->permissions)
        <p>Bem-vindo, {{ Auth::user()->name }}!</p>
        <p>Você tem permissão de administrador? {{ Auth::user()->permissions->isAdmin ? 'Sim' : 'Não' }}</p>
    @else
        <p>Bem-vindo, convidado!</p>
    @endif
</x-app-layout>