@extends('layout')

@section('title', 'Editar Usuario')

@section('content')

    <br>
    <h4>Editar usuario {{ $user->name }}</h4>

    <form method="POST" action="{{ url("users/{$user->id}") }}" class="needs-validation" novalidate>
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="input-group">
	        <span>
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            </span>
            <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ old('name', $user->name) }}" />
        </div>
        @if ($errors->has('name'))
            <div class="alert alert-danger">
                <p>{{ $errors->first('name') }}</p>
            </div>
        @endif
        <br>
        <div class="input-group">
	        <span>
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
            <input type="text" name="email" class="form-control" placeholder="Correo electrónico" value="{{ old('email', $user->email) }}" />
        </div>
        @if ($errors->has('email'))
            <div class="alert alert-danger">
                <p>{{ $errors->first('email') }}</p>
            </div>
        @endif
        <br>
        <div class="input-group">
	        <span>
                <i class="fa fa-briefcase" aria-hidden="true"></i>
            </span>
            <input type="number" name="profession_id" class="form-control" placeholder="Id de profesión" value="{{ old('profession_id', $user->profession_id) }}" />
        </div>
        @if ($errors->has('profession_id'))
            <div class="alert alert-danger">
                <p>{{ $errors->first('profession_id') }}</p>
            </div>
        @endif
        <br>
        <div class="input-group">
	        <span>
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <input type="password" name="password" class="form-control" placeholder="Contraseña" />
        </div>
        @if ($errors->has('password'))
            <div class="alert alert-danger">
                <p>{{ $errors->first('password') }}</p>
            </div>
        @endif
        <br>
        <button type="submit">Actualizar usuario</button>
    </form>

    <p>
        <a href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
    </p>

@endsection
