<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include("layouts.head")
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title',"SpaceEtablissement")</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    span#unread {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 656px;
                top: 17px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }
    </style>

    
</head>
<body>
<!--
     filter: blur(2px); -webkit-filter: blur(2px);
-->
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-gray shadow-lg navbar-inverse" style="position:fixed;width:100%;z-index:9999">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.create') }}">{{ __('Contactez Nous') }}</a>
                    </li> 
                    @guest
                      
                    @else
                        <li>
                             <span class="nav-item dropdown nav-link caret">|</span> 
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                        </li>       
                        <li>
                             <span class="nav-item dropdown nav-link caret">|</span> 
                        </li>  
                        @if(Auth::user()->stagiaire)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('modules') }}">{{ __('Modules') }}</a>
                            </li>
                        @endif   
                        @if(Auth::user()->formateur)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('filieres.index') }}">{{ __('Filieres') }}</a>
                            </li>
                        @endif   
                        @if(Auth::user()->admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('AdminFilieres.index') }}">{{ __('Filieres') }}</a>
                            </li>
                            <li>
                             <span class="nav-item dropdown nav-link caret">|</span> 
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('AdminFormateurs.index') }}">{{ __('Formateurs') }}</a>
                            </li>
                            <li>
                             <span class="nav-item dropdown nav-link caret">|</span> 
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('AdminStagiaires.index') }}">{{ __('Stagiaires') }}</a>
                            </li>
                        @endif   
                        <li>
                             <span class="nav-item dropdown nav-link caret">|</span> 
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chat') }}">{{ __('Messages') }}
                            @if(App\Message::where('to',Auth::user()->id)->where("read",0)->get()->count())
                                <span id="unread" {{Auth::user()->admin?"style=right:458px;":""}}>
                                    {{App\Message::where('to',Auth::user()->id)->where("read",0)->get()->count()}}
                                </span>
                            @endif
                            </a>
                            
                        </li>       
                        
                    @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nom }} <span class="caret"></span>
                                </a>
                            </li>
                            <span class="nav-item dropdown nav-link caret">|</span>
                            <li>
                                     <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form  id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>
    </div>
</body>
</html>
