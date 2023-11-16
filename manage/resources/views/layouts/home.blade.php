
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite('resources/css/app.css')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            // Initialization for ES Users
            import {
            Collapse,
            Dropdown,
            initTE,
            } from "tw-elements";

            initTE({ Collapse, Dropdown });
        </script>
    </head>
    <body>
    <!-- Main navigation container -->
    <nav
        class="relative flex w-full flex-wrap items-center justify-between bg-[#FBFBFB] py-2 text-neutral-500 shadow-lg hover:text-neutral-700 focus:text-neutral-700 dark:bg-neutral-600 lg:py-4">
        <div class="flex w-full flex-wrap items-center justify-between px-3 py-4">
            <div class=" w-full flex items-center justify-between">
            <a
                class="mx-2 my-1 flex items-center  text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 lg:mb-0 lg:mt-0"
                href="#">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>   
                <span class="font-medium dark:text-neutral-200">FACU-GEB</span> 
                </a>
                

                <div>
                    <a href="/login" class="bg-white   hover:bg-gray-100 text-gray-800 font-semibold py-4 px-6 border border-gray-400 rounded shadow">
                        Login
                    </a>
                    
                    <a href="/register" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-4 px-6 border border-gray-400 rounded shadow">
                        Register
                    </a>
                </div>  
            </div>
        </div>
    </nav>   
    <main style="display: flex;align-items:center;justify-content:space-around;background-color:rgba(28,28,28,255);color:white; flex-wrap;wrap">
        <div>
            <x-application-logo width="200" height="200" />
        </div>
        <div>
            <h1 class="font-extralight">Bem-vindo ao Sistema de Gerenciamento de Matrículas</h1>
        </div>
    </main>
    
    </body>
</html>