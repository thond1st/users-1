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

    <form method="POST" action="{{ route('role.store') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control">
                </div>
            </div>

        </div>

        <div style="margin-top:15px">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>

    </form>

@endsection