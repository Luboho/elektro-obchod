@extends('layout')

@section('title', 'My Profile')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Domov</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Môj profil</span>
    @endcomponent

    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="profile-section container">
        <div class="sidebar">
            <ul>
                <li class="active"><a href="{{ route('users.edit') }}">Môj profil</a></li>
                <li><a href="{{ route('orders.index') }}">Moje objednávky</a></li>
            </ul>
        </div> <!-- end sidebar -->
        <div class="my-profile">
            <div class="profile-header">
                <h1 class="stylish-heading">Môj profil</h1>
            </div>

                <form action="{{ route('users.update') }}" method="POST">
                    @method('patch')
                    @csrf
                    
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" required>
                
                    <input id="email" type="text" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
                
                    <input id="password" type="password" name="password" placeholder="Heslo">
                    <div>Zachovať aktuálne heslo.</div>
                
                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Potvrdiť heslo">
                
                    <button type="submit" class="my-profile-button">Upraviť profil</button>
                    
                </form>

            <div class="spacer"></div>
        </div>
    </div><!-- end profile -->

@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
