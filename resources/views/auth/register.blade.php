@extends('layout')

@section('content')

<div class="auth-pages">
    <div class="auth-left">
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
        <h2>Registrovať</h2>
        <div class="spacer"></div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <input id="name" type="name" name="name" value="{{ old('name') }}" placeholder="Meno" required autofocus>

            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

            <input id="password" type="password" name="password" value="" placeholder="Heslo" required autofocus>
        
            <input id="password-confirm" type="password" class="" name="password_confirmation" placeholder="Potvrdiť heslo" required autofocus>
        
            <div class="login-container">
                <button type="submit" class="auth-button">
                    {{ __('Registrovať') }}
                </button>      
            </div>

            <div class="spacer"></div>

            <a href="{{ route('password.request') }}">
                Zabudnuté heslo?
            </a>

        </form>
    </div>

    <div class="auth-right">
        <h2>Nový zákazník</h2>
        <div class="spacer"></div>
        <p><strong>Výhody</strong></p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem ratione cum asperiores, at pariatur odit!</p>
        <div class="spacer"></div>
        &nbsp;
        <div class="spacer"></div>
        <p><strong>Zľavy</strong></p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nulla earum perferendis porro qui necessitatibus! Totam, hic..</p>
        <div class="spacer"></div>
    </div>
</div>

@endsection
