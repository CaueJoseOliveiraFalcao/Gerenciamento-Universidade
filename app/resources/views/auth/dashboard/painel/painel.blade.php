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
        @if ($isFinded === 'notfound')
        <div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
             Usuario Não Encontrado!
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
            <span class="sr-only">Dismiss</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            </button>
        </div>
    @elseif ($isFinded === 'found')
        <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
            Usuario Encontrado !
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
            <span class="sr-only">Dismiss</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            </button>
        </div>
    @endif
        <div class="flex items-center gap-4">
            <!-- search modal -->
            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </button>
            <!-- confirm modal -->
            <button id="ConfirmTableInsert" data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                Confirmar Alterações
            </button>
        </div>
            <section id="CONFIRM-MODAL"> 
                <!-- Main modal -->
                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Confirme as Alterações
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
                                    <table id="TableInsert" class="w-full">
                                        <thead>
                                            <tr>
                                                <th>Id do Usuario</th>
                                                <th>Nome Do Usuario</th>
                                                <th>Alteração</th>
                                                <th>Excluir Alteração</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyInsert" >                                      
                                        </tbody>
                                    </table>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <input type="submit" value="Enviar Alterações" data-modal-hide="default-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                        <p class="font-bold text-xl" >Grupo Atual : {{$user->group['name']}} </p>
                        <select name="group" id="gruop" class="group">
                        @foreach ($DisponibleGroups as $Group)
                            <option value="{{$Group->name}}" {{$user->group['name'] == $Group->name ? 'selected' : ''}}>
                                {{$Group->name}}
                            </option>
                        @endforeach
                    @else
                        <p class="font-bold" >Grupo Atual :  SEM GRUPO </p>
                            <select name="group" id="gruop" class="group">
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
                            $userPermission = 'SEM PERMISSÃO';
                        }else{
                            $userPermission =  $user->permissions->first->first()->permission;
                        }
                    @endphp
                    <p class="font-bold">Permissão Atual : {{$userPermission}} </p>
                    <select name="permission" id="permission">
                    @foreach ($DisponiblePermissions as $Permission)
                    
                        <option  {{$userPermission == $Permission->permission ? 'selected' : ''}}>
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
        const arrayfinal = document.querySelector('.arrayFinal');
        if (!window.selectedValues){
            window.selectedValues = [];
        }
        function updateFinalInput(){
            arrayfinal.value = JSON.stringify(selectedValues);
        }
        document.querySelectorAll('#permission').forEach(function(select) {
            select.addEventListener('change' , function(){
                console.log(this);
                const userId = this.closest('tr').querySelector('td:nth-child(1)').textContent.trim();
                const userName = this.closest('tr').querySelector('td:nth-child(2)').textContent.trim();
                row = this.closest('tr');
                col = this.closest('td');
                selectedValues.push({userId: userId ,userName : userName, permissionValue : this.value});
                updateFinalInput();

            });
        });
        document.querySelectorAll('.group').forEach(function(select) {
            select.addEventListener('change' , function(){
                console.log(this);
                const userId = this.closest('tr').querySelector('td:nth-child(1)').textContent.trim();
                const userName = this.closest('tr').querySelector('td:nth-child(2)').textContent.trim();
                row = this.closest('tr');
                col = this.closest('td');
                selectedValues.push({userId: userId ,userName : userName, groupValue : this.value});
                updateFinalInput();

            });
        });
        // Função para limpar o valor do input
        function limparInput() {
            arrayfinal.value = ''; // Define o valor como uma string vazia
        }

        // Chama a função limparInput quando o documento estiver pronto
        document.addEventListener('DOMContentLoaded', function () {
            limparInput();
        });
        document.getElementById('ConfirmTableInsert').addEventListener('click' , () => {
            console.log(arrayfinal.value);
            if (arrayfinal.value === ''){
                alert('Primeiro escolha as alterações');
            }
            else{

                let tableValues = JSON.parse(arrayfinal.value)
                console.log(typeof(tableValues));

                const tbody = document.getElementById('tbodyInsert');
                tbody.innerHTML ='';
                //INSERÇAO DA TABELA MODEL
                tableValues.forEach(user => {
                    
                    var row = tbody.insertRow();
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);

                    cell1.textContent = user.userId;
                    cell2.textContent = user.userName;
                    cell3.textContent = user.permissionValue || user.groupValue;
                    cell1.className = 'text-center';
                    cell2.className = 'text-center';
                    cell3.className = 'text-center';
                    cell4.className = 'text-center bg-red-600 text-white rounded-md';
                    var exButton = document.createElement('button');

                    //FUNÇAO EXCLUIR

                    exButton.onclick = function(e) {
                        e.preventDefault();
                        row = this.closest('tr')
                        Alteracao = row.cells[2].textContent;
                        UserId = row.cells[0].textContent; 
                        IndexToRemove = -1
                        function Search (){
                            selectedValues.forEach((element , index) => {
                            if (UserId === element.userId && (Alteracao === element.groupValue || Alteracao === element.permissionValue)) {
                                selectedValues.splice(index , 1);
                                console.log(selectedValues);
                                row.parentNode.removeChild(row);
                                updateFinalInput();
                            }
                         })};
                         Search();
                    }
                    cell4.appendChild(exButton);
                    exButton.textContent = 'Excluir Alteração'

                });
            }
        })
    </script>
{{-- Exibir isFinded --}}


</body>
</html>
