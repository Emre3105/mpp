@extends('head')
@section('base')
<?php
if (Auth::guard('user')->check()) {
    $urlHome = route('home.index');
    $items = array(
        (object) array(
            "url" => route('home.index'),
            "icon" => "fa-solid fa-table",
            "name" => "Ligues"
        ), (object) array(
            "url" => route('basketballer.index'),
            "icon" => "fa-solid fa-person-circle-question",
            "name" => "Basketteurs"
        ), (object) array(
            "url" => route('transfer_market.index'),
            "icon" => "fa-solid fa-cart-shopping",
            "name" => "Mercato"
        ), (object) array(
            "url" => route('auth.logout'),
            "icon" => "fa-solid fa-arrow-right-from-bracket",
            "name" => "Déconnexion"
        )
    );
} else if(Auth::guard('admin')->check()) {
    $urlHome = route('admin.index');
    $items = array(
        (object) array(
            "url" => route('admin.index'),
            "icon" => "fa-solid fa-desktop",
            "name" => "Portail"
        ), (object) array(
            "url" => route('basketballer.index'),
            "icon" => "fa-solid fa-person-circle-question",
            "name" => "Basketteurs"
        ), (object) array(
            "url" => route('auth.logout'),
            "icon" => "fa-solid fa-arrow-right-from-bracket",
            "name" => "Déconnexion"
        )
    );
}
else {
    $urlHome = route('welcome');
    $items = array(
        (object) array(
            "url" => route('welcome'),
            "icon" => "fa-solid fa-house",
            "name" => "Accueil"
        ), (object) array(
            "url" => route('basketballer.index'),
            "icon" => "fa-solid fa-person-circle-question",
            "name" => "Basketteurs"
        ), (object) array(
            "url" => route('auth.login.index'),
            "icon" => "fa-solid fa-arrow-right-to-bracket",
            "name" => "Connexion"
        )
    );
}
?>
    <navbar url-home="{{$urlHome}}" :items="{{ json_encode($items) }}"></navbar>
    <div class="min-h-screen py-8 px-4">
        @yield('content')
    </div>
    <footer class="bg-white dark:bg-gray-darkest text-gray-darkest dark:text-white px-4 py-2">
        <div class="container mx-auto text-center">
            MPP - Développé par Emre, Nour Eddine et Anthony
        </div>
    </footer>
@endsection