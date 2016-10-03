@extends('users::layouts.master')

@section('content')

    @if (isset($errors) && count($errors))

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <form method="POST" action="{{ route('user.store') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">

            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="role_id">Função</label>
                    <select class="form-control" name="role_id">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="phone_prefix">DDD</label>
                    <input type="text" name="phone_prefix" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone_number">Telefone</label>
                    <input type="text" name="phone_number" class="form-control">
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="password_confirm">Confirmação da senha</label>
                    <input type="password" name="password_confirm" class="form-control">
                </div>
            </div>

        </div>

        <div style="margin-top:15px">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>

    </form>

@endsection