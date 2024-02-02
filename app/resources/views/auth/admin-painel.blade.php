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
    .container {
        overflow-x: hidden;
        width: 100%;
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
        width: 100%;
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
    <div class="container">
        <form class="tableForm" action="/changeAcess"  method="POST">
            @csrf
        @if(auth()->user()->hasPermissionTo('admin') == 1)
            <h1 style="text-align: center">Lista de Usuários</h1>
            <ul>
                <table class="table-fixed">
                    <thead>
                      <tr>
                        <th>Select</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Permission</th>
                        <th>Grupo</th>
                      </tr>
                    </thead>
                    <tbody>
                @foreach ($allUsersWithPermission as $user)
                    <tr>
                        <td style="text-align: center"><input  value=`{{$user['id']}}` name='selected_users[]' type="checkbox"></td>
                        <td>{{$user['id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td><h1 class="text-center" >Permissiao Atual : {{$user['permission']}}</h1>
                            <select name="permission" id="permission">
                                @foreach ($allDisponiblePermissions as $permission)
                                        <option  value="{{$permission}}" {{$user['permission'] == $permission ? 'selected' : ''}}>
                                            {{$permission}}
                                        </option>

                                @endforeach
                            </select></td>
                        <td><h1 class="text-center" >Grupo Atual : {{$user['group']}}</h1>
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
            <input type="hidden" class="arrayFinal">
            <div style="display: flex; justify-content:center; align-itens:center;">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Salvar</button>
            </div>

<!-- Modal toggle -->

  
    
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
            document.querySelector('.arrayFinal').value = JSON.stringify(selectedValues);
            console.log(selectedValues);
        } 
        document.querySelectorAll('#permission').forEach(function(select) {
            select.addEventListener('change' , function(){
                console.log(this);
                const userId = this.closest('tr').querySelector('td:nth-child(2)').textContent;
                console.log(userId);
                row = this.closest('tr');
                row.classList.add('bg-blue-100');
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
                row.classList.add('bg-blue-100');
                selectedValues.push({userId: userId , groupValue : this.value})
                updateFinalInput();

            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

</body>
</html>