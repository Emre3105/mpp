@extends('base')
@section('content')
<div class="w-full flex justify-center">
    <div class="card">
        <p>Connexion admin</p>
        <hr>
        <div>
            <form method="POST" class="form" action="{{ route('auth.adminlogin') }}">
                @csrf
                <div class="form-group">
                    <label for="inputUsername">Nom d'utilisateur</label>
                    <input class="form-text-input" type="text" placeholder="Nom d'utilisateur" id="inputUsername" name="username" required autofocus>
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputPassword">Mot de passe</label>
                    <input class="form-text-input" type="password" id="inputPassword" placeholder="Mot de passe" name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn-primary w-96">Se connecter</button>
                @if ($errors->has('incorrect'))
                    <p class="text-danger text-center text-base">{{ $errors->first('incorrect') }}</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection