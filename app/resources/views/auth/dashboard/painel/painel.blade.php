<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel Administrador</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <h1>Painel</h1>
    <p>{{ $isFinded}}</p>
    @foreach ($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
    

<div class=" overflow-x-auto flex flex-col ">
    <table class=" text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-2xl">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Grupo
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
            </tr>
        </thead>
        <tbody>
            <p>{{ $user->name }}</p>
            @foreach ($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$user->name}}
                </th>
                <td class="px-6 py-4">
                    {{$user->email}}
                    DisponiblePermissions
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm-2" >Grupo Atual : {{$user->group['name']}} </p>
                    <select name="group" id="gruop" class="group">
                    @foreach ($DisponibleGroups as $Group)
                        <option value="{{$Group->name}}" {{$user->group['name'] == $Group->name ? 'selected' : ''}}>
                            {{$Group->name}}
                        </option>
                    @endforeach

                </td>
                <td class="px-6 py-4">
                    @php
                        $userPermission = $user->permissions->first->first()->permission
                    @endphp
                    <p>Permissão Atual : {{$userPermission}} </p>
                    <select name="permission" id="permission" class="permission">
                    @foreach ($DisponiblePermissions as $Permission)
                        <option value="{{$Permission->permission}}" {{$user->group['name'] == $Permission->permission ? 'selected' : ''}}>
                            {{$Permission->permission}}
                        </option>
                    @endforeach
                </td>
            </tr>
        @endforeach
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    Laptop
                </td>
                <td class="px-6 py-4">
                    $2999
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Microsoft Surface Pro
                </th>
                <td class="px-6 py-4">
                    White
                </td>
                <td class="px-6 py-4">
                    Laptop PC
                </td>
                <td class="px-6 py-4">
                    $1999
                </td>
            </tr>
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Magic Mouse 2
                </th>
                <td class="px-6 py-4">
                    Black
                </td>
                <td class="px-6 py-4">
                    Accessories
                </td>
                <td class="px-6 py-4">
                    $99
                </td>
            </tr>
        </tbody>
    </table>
</div>



{{-- Exibir isFinded --}}


</body>
</html>