<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{asset('css/general.css')}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <style>
        .footer-dark {
      padding:50px 0;
      color:#f0f9ff;
      background-color:#282d32;
    }
    
    .footer-dark h3 {
      margin-top:0;
      margin-bottom:12px;
      font-weight:bold;
      font-size:16px;
    }
    
    .footer-dark ul {
      padding:0;
      list-style:none;
      line-height:1.6;
      font-size:14px;
      margin-bottom:0;
    }
    
    .footer-dark ul a {
      color:inherit;
      text-decoration:none;
      opacity:0.6;
    }
    
    .footer-dark ul a:hover {
      opacity:0.8;
    }
    
    @media (max-width:767px) {
      .footer-dark .item:not(.social) {
        text-align:center;
        padding-bottom:20px;
      }
    }
    
    .footer-dark .item.text {
      margin-bottom:36px;
    }
    
    @media (max-width:767px) {
      .footer-dark .item.text {
        margin-bottom:0;
      }
    }
    
    .footer-dark .item.text p {
      opacity:0.6;
      margin-bottom:0;
    }
    
    .footer-dark .item.social {
      text-align:center;
      margin-top: 1.5rem;
    }
    
    @media (max-width:991px) {
      .footer-dark .item.social {
        text-align:center;
        margin-top:20px;
      }
    }
    
    .footer-dark .item.social > a {
      font-size:20px;
      width:36px;
      height:36px;
      line-height:36px;
      display:inline-block;
      text-align:center;
      border-radius:50%;
      box-shadow:0 0 0 1px rgba(255,255,255,0.4);
      margin:0 8px;
      color:#fff;
      opacity:0.75;
    }
    
    .footer-dark .item.social > a:hover {
      opacity:0.9;
    }
    
    .footer-dark .copyright {
      text-align:center;
      padding-top:24px;
      opacity:0.3;
      font-size:13px;
      margin-bottom:0;
    }
    
    </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
                @if(Session::has('success'))
                    <div class="notification" style="cursor: pointer;" id="notification">
                        <p>{{Session::get('success')}}</p>
                    </div>
                @endif
            </main>
    <div class="footer-dark">
            <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 item">
                        <h3>Social Media</h3>
                        <ul>
                            <li><a href="#">INSTAGRAM</a></li>
                            <li><a href="#">FACEBOOK</a></li>
                            <li><a href="#">TWITTER</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 item">
                        <h3>Categories</h3>
                        <ul>
                        @foreach ($categories as $cat)
                        <li>
                        <form action="{{route('search')}}" method="get">
                            <input class="hidden" type="search" name="term" value="{{$cat->name}}">
                            <input class="hidden" type="search" name="is_category" value="true">
                            <button type="submit">{{$cat->name}}</button>
                        </form>
                        </li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 item text">
                        <h3>KHABAR</h3>
                        <p>Khabar - Votre source d'actualités de confiance. Restez informé sur les sujets qui comptent. © 2024 Khabar. </p>
                    <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="copyright">KHABAR © 2024</p>
            </div>
        </footer>
        </div>
            <script>
                let notif=document.getElementById('notification')
                notif.addEventListener('click',function(){
                    notif.classList.add('hidden')
                })
            </script>
             <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
             <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        </div>
    </body>
</html>
