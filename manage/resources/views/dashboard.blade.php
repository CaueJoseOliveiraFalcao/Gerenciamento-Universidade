<x-app-layout>
    <h1>Página Principal</h1>
    <p>Bem-vindo, {{ Auth::user()->permissions }}!</p>
    {{ $user->permissions }}
</x-app-layout>