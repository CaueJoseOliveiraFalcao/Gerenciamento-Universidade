
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
    <nav style="position: fixed;background-color:white"
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
                    <a href="/login" class="bg-white   hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Login
                    </a>
                    
                    <a href="/register" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold  py-2 px-4 border border-gray-400 rounded shadow">
                        Register
                    </a>
                </div>  
            </div>
        </div>
    </nav>   
    <main>

    </main>
    <section class="lading1">
        <div>
            <x-application-logo width="200" height="200" />
        </div>
        <div class="divLading">
            <h1 class="h1Landing">Bem-vindo ao Sistema de Gerenciamento de Matrículas</h1>
            <p class="pLading">O nosso sistema oferece uma maneira eficiente e 
                simplificada de gerenciar as matrículas dos alunos.
                Com uma interface amigável e recursos avançados,
                proporcionamos uma experiência completa para administradores,
                professores e alunos.</p>
        </div>
    </section>
    <section class="aboutUs">
        <h1>Sobre Nós</h1>
        <p>
            O Sistema de Gerenciamento de Matrículas é uma plataforma abrangente projetada para facilitar a administração educacional,
            proporcionando uma experiência de usuário eficiente e intuitiva.
            Este sistema permite que os alunos se matriculem em cursos, verifiquem sua
            frequência e agendem provas. Ele oferece uma visão clara do progresso 
            acadêmico do aluno, permitindo que eles acompanhem suas notas, frequência
            e horários de prova de maneira organizada.
            <br>
            <br>
            Os professores têm a capacidade de gerenciar seus alunos, monitorando a
            frequência e programando provas. Eles podem acessar informações detalhadas
            sobre o desempenho do aluno, facilitando a identificação de áreas que precisam
            de atenção adicional. Além disso, os professores podem comunicar-se diretamente
            com os alunos através do sistema, proporcionando feedback oportuno e eficaz.
            <br>
            <br>
            Os coordenadores desempenham um papel crucial na criação de turmas, garantindo
            que os alunos estejam matriculados nos cursos corretos e que os professores 
            estejam alocados de maneira adequada. Eles têm a capacidade de visualizar e 
            gerenciar todas as informações do curso, incluindo horários, locais e matrículas de alunos.
            <br>
            <br>
            Em resumo, o Sistema de Gerenciamento de Matrículas é uma ferramenta poderosa que simplificada
            a administração educacional, melhorando a experiência de todos os envolvidos no processo de
            aprendizagem. Ele promove a eficiência, a comunicação e a transparência, contribuindo para
            um ambiente de aprendizagem mais produtivo e enriquecedor.
        </p>
    </section>
    </body>
    <style>
        body::-webkit-scrollbar {
            display: none;
        }

        /*Lading */
        .h1Landing {
            font-size:23px;
        }
        .pLading{
            max-width: 500px;
            margin-top: 1rem
        }
        .lading1{
            display: flex;
            align-items:center;
            justify-content:space-around;
            background-color:rgba(28,28,28,255);
            color:white; 
            flex-wrap: wrap;
            height: 91vh;
        }
        @media (max-width : 768px){
            .lading1{
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .pLading{
                margin-top: 1rem;
                text-align: center;
                font-size: 12px
            }
            .h1Landing{
                text-align: center
            }
            .divLading{
                display:flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        }
        /*About us*/
        .aboutUs{
            background-color: #fffec4;
            height: 100vh;
            color: black;
            padding-left:12%;
            display: flex;
            flex-direction: column;
            justify-content: center
        }
        .aboutUs h1{
            font-weight: bold;
            font-size: 23px;

        }
        .aboutUs p{
            max-width: 1000px;

        }
        @media (max-width : 768px){
            .aboutUs{
                height: 100%;
                text-align: center;
                padding: 1rem;
            }
            .aboutUs h1{
                 margin:3rem 0;
            }
        }
    </style>
</html>