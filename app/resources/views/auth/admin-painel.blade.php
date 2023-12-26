<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<style>
    body{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    header{
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row;
        background-color: darkblue;
        color: white
    }
    .title{
        font-family: Arial, Helvetica, sans-serif;
        text-align: center
    }
    .logout-icon{
        width: 40px;
        height: 40px;
        cursor: pointer;
    }
</style>
<body>
    <header>
        <h1 class="title">Painel de Adm</h1>
        <form action="{{ route('logout')}}" METHOD='POST'>
        @csrf
        <button type="submit">
            <svg class="logout-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-1 h-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
              </svg>
        </button>
        </form> 
    </header>
    @php
         $userId = 5;
         $permissions = \App\Models\User::consultPermission($userId);   
    @endphp
    {{$permissions}}
    <div class="container">
        @if(auth()->user()->hasPermissionTo('admin') == 1)
            <h1>Lista de Usuários:</h1>
            <ul>
                <table class="table-fixed">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Emaiç</th>
                      </tr>
                    </thead>
                    <tbody>
                @foreach ($allUsers as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                    </tr>
                @endforeach
                    </tbody>
                </table>

            </ul>
        @else
            <p>Você não é um admin</p>
        @endif

    </div>

</body>
</html>