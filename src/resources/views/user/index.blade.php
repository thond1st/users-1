@extends('users::layouts.master')

@section('content')

    <div style="margin-bottom: 15px">
        <a href="{{ route('user.create') }}" class="btn btn-success">Adicionar</a>
    </div>

    <form action="" method="GET">

        <div class="row" style="margin-bottom: 20px">

            <div class="col-md-3">
                <label>E-mail</label>
                <input type="text" name="email" value="{{ $filter['email'] }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Nome</label>
                <input type="text" name="name" value="{{ $filter['name'] }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Telefone</label>
                <input type="text" name="phone" value="{{ $filter['phone'] }}" class="form-control">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-default" style="margin-top: 27px;">Filtrar</button>
            </div>

        </div>

    </form>

    @if (! $users->count())

        <div>Nenhum usuário encontrado.</div>

    @else

        <div class="row table-responsive">
        
        <div class="col-md-12">
            
            <table class="table table-striped">
                
                <thead>
                
                    <th>Nome</th>
                    <th>Função</th>
                    <th>Email</th>
                    <th>DDD</th>
                    <th>Telefone</th>
                    <th></th>

                </thead>

                <tbody>

                    @foreach($users as $user)

                        <tr>

                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_prefix }}</td>
                            <td>{{ $user->phone_number }}</td>

                            <td class="action-column">

                                <form method="POST" action="{{ route('user.destroy', $user->id) }}" onsubmit="return confirm('Deseja realmente arquivar esse registro?')">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button class="btn btn-danger btn-sm" type="submit">
                                        excluir
                                    </button>
                                </form>

                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-default btn-sm">
                                    editar
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    @endif

@endsection