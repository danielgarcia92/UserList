@extends('layout')

@section('title', 'Crear Usuario')

@section('content')

    <div class="card">
        <h4 class="card-header">Crear usuario</h4>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6>Por favor corregir los siguiente errores:</h6>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ url('users') }}" class="needs-validation" novalidate>
                {!! csrf_field() !!}

                <div class="inner-addon left-addon">
                    <span>
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                    </span>
                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}" />
                </div>
                <br>
                <div class="input-group">
                    <span>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <input type="text" name="email" class="form-control" placeholder="Correo electrónico" value="{{ old('email') }}" />
                </div>
                <br>
                <div class="input-group">
                    <span>
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                    </span>
                    <input type="number" name="profession_id" class="form-control" placeholder="Id de profesión" value="{{ old('profession_id') }}" />
                </div>
                <br>
                <div class="input-group">
	                <span>
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" />
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Crear usuario</button>
                <a href="{{ route('users.index') }}" class="btn btn-link">Regresar al listado de usuarios</a>
            </form>
        </div>
    </div>

@endsection
