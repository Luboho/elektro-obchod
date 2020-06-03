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
            <h2>Existujúci zákazník</h2>
            <div class="spacer"></div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                <input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="Heslo" required autofocus>
            
                <div class="login-container">
                    <button type="submit" class="auth-button">Prihlásiť</button>
                    <label>  
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Zapamätať
                    </label>      
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
            <a href="{{ route('guestCheckout.index') }}" class="auth-button-hollow">Pokračovať bez registrácie.</a>
            <div class="spacer"></div>
            <div class="spacer"></div>
            &nbsp;
            <div class="spacer"></div>
            <p><strong>Ušetrite si čas.</strong></p>
            <p>Nemusíte vypĺňať fakturačné údaje.</p>
            <p><strong>Ušetrite si čas neskôr.</strong></p>
            <p>Vytvorte si účet pre rýchly prístup k svojím uskutočneným objednávkam.</p>
            <div class="spacer"></div>
            <a href="{{ route('register') }}" class="auth-button-hollow">Vytvoriť účet.</a>
        </div>
    </div>


@endsection
