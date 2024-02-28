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
    <form class="tableForm" action="/changeAcess"  method="POST">
        @csrf
<div class=" overflow-x-auto flex flex-col ">

        <input type="hidden" name="arrayFinal" id="arrayFinal" class="arrayFinal">
    <section class="flex flex-col justify-center items-center">

        <!-- Modal toggle -->
        <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
            </svg>
        </button>


        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">

                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            <label for="search">Procure o Usuario : </label>
                            <input class="rounded-xl" type="text" name="search" id="search" placeholder="Digite Nome ou Email">
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <a data-modal-hide="default-modal" href="#" id="searchByName" type="button" class="text-white cursor-pointer bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mr-5 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Procurar Por Nome</a>
                        <a data-modal-hide="default-modal" href="#" id="searchByEmail" type="button" class="text-white cursor-pointer bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Procurar Por Email</a>
                    </div>
                    <script>
                        document.getElementById('searchByName').addEventListener("click", function () {
                            const input = document.getElementById('search').value;
                            this.href = '/painel?name=' + encodeURIComponent(input);
                            document.getElementById('search').value = ''; // Limpa o campo de pesquisa
                        });
                        document.getElementById('searchByEmail').addEventListener("click", function () {
                            const input = document.getElementById('search').value;
                            this.href = '/painel?search=' + encodeURIComponent(input);
                            document.getElementById('search').value = ''; // Limpa o campo de pesquisa
                        });
                    </script>
                </div>
            </div>
        </div>

    </section>
    <table class=" text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-2xl">
                    Id
                </th>
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
            @foreach ($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{($user->id)}}
                </td>
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{($user->name)}}
                </td>
                <td class="px-6 py-4">
                    {{$user->email}}
                </td>
                <td class="px-6 py-4">
                    @if (!empty($user->group['name']))
                        <p class="text-" >Grupo Atual : {{$user->group['name']}} </p>
                        <select name="group" id="gruop" class="group">
                        @foreach ($DisponibleGroups as $Group)
                            <option value="{{$Group->name}}" {{$user->group['name'] == $Group->name ? 'selected' : ''}}>
                                {{$Group->name}}
                            </option>
                        @endforeach
                    @else
                        <p class="text-" >Grupo Atual : Usuario Sem Grupo </p>
                                @foreach ($DisponibleGroups as $Group)
                                    <option value="{{$Group->name}}">
                                        {{$Group->name}}
                                    </option>
                        @endforeach
                    @endif



                </td>
                <td class="px-6 py-4">
                    @php
                        if (!$user->permissions->first->first()){
                            $userPermission = 'sem permissão';
                        }else{
                            $userPermission =  $user->permissions->first->first()->permission;
                        }
                    @endphp
                    <p>Permissão Atual : {{$userPermission}} </p>
                    <select name="permission" id="permission">
                    @foreach ($DisponiblePermissions as $Permission)
                        <option value="{{$Permission->permission}}" {{$user->permissions->first->first() == $Permission->permission ? 'selected' : ''}}>
                            {{$Permission->permission}}
                        </option>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
      </table>
</div>
</form>

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
                const userId = this.closest('tr').querySelector('td:nth-child(1)').textContent.trim();
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
                const userId = this.closest('tr').querySelector('td:nth-child(1)').textContent.trim();
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
{{-- Exibir isFinded --}}


</body>
</html>
