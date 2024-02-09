<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
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

    .w-full {
  width: 100% !important; /* Garante que a largura seja sempre 100% */
}

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 5px;
    }
    th {
        background-color: #f2f2f2;
    }
    ul{
        padding: 0;
        margin: 0;
    }

    .tableForm{
        display: flex;
        width: 1100px;
        border-style: solid;
        border-radius: 10px;
        flex-direction: column;
        justify-content: center;
    }
    .ButtonConfirmDelete{
        width: 150px;
        height: 60px;
        margin:  0 auto;
        background: darkred;
        color: white;
        border-style: none;
        border-radius: 5px;
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
    <x-error-alert/>
    


    <div class="main-form-div flex justify-center align-itens-center w-full">
        <form class="tableForm" action="/changeAcess"  method="POST">
        @csrf
        @if(auth()->user()->hasPermissionTo('admin') == 1)
            <h1 style="text-align: center">Lista de Usuários</h1>
            <ul>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                DELETAR
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Permissão
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Grupo
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allUsersWithPermission as $user)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium flex flex-collumn justify-center items-center text-gray-900 whitespace-nowrap dark:text-white">
                                <input style="margin: 29px" value=`{{$user['id']}}` name='selected_users[]' type="checkbox">
                            </th>
                            <td class="px-6 py-4">
                                {{$user['id']}}
                            </td>
                            <td class="px-6 py-4">
                                {{$user['name']}}
                            </td>
                            <td class="px-6 py-4">
                                {{$user['email']}}
                            </td>
                            <td class="px-6 py-4">
                                <h1 class="text-center" >Permissiao Atual : {{$user['permission']}}</h1>
                            <select name="permission" id="permission">
                                @foreach ($allDisponiblePermissions as $permission)
                                        <option  value="{{$permission}}" {{$user['permission'] == $permission ? 'selected' : ''}}>
                                            {{$permission}}
                                        </option>
                                @endforeach
                            </select>
                            </td>
                            <td class="px-6 py-4">
                                <h1 class="text-center" >Grupo Atual : {{$user['group']}}</h1>
                            <select name="group" id="gruop" class="group">
                                @foreach ($allDisponibleGroups as $group)
                                    <option value="{{$group}}" {{$user['group'] == $group ? 'selected' : ''}}>
                                        {{$group}}
                                    </option>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </ul>
            <input type="hidden" name="arrayFinal" class="arrayFinal">
            <div style="display: flex; justify-content:center; align-itens:center;">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Salvar</button>
            </div>
        </form>

        @else
            <p>Você não é um admin</p>
        @endif

    </div>
    <section class="groupForm">
        <h1>Criação de Grupos</h1>
        
        <form action="{{ route('storeGroup')}}" method="POST">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </section>
    <script>
        if (!window.selectedValues){
            window.selectedValues = [];
        }
        function updateFinalInput(){
            const arrayfinal = document.querySelector('.arrayFinal');
            arrayfinal.value = JSON.stringify(selectedValues);
            console.log(arrayfinal.value);
        } 
        document.querySelectorAll('#permission').forEach(function(select) {
            select.addEventListener('change' , function(){
                console.log(this);
                const userId = this.closest('tr').querySelector('td:nth-child(2)').textContent;
                console.log(userId);
                row = this.closest('tr');
                col = this.closest('td');
                row.classList.add('bg-blue-100');
                col.classList.add('bg-blue-200');
                selectedValues.push({userId: userId , permissionValue : this.value})
                updateFinalInput();

            });
        });
        document.querySelectorAll('.group').forEach(function(select) {
            select.addEventListener('change' , function(){
                console.log(this);
                const userId = this.closest('tr').querySelector('td:nth-child(2)').textContent;
                console.log(userId);
                row = this.closest('tr');
                col = this.closest('td');
                row.classList.add('bg-blue-100');
                col.classList.add('bg-blue-200');
                selectedValues.push({userId: userId , groupValue : this.value})
                updateFinalInput();

            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

</body>
</html>