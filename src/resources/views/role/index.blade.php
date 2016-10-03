@extends('users::layouts.master')

@section('content')

    <div style="margin-bottom: 15px">
        <a href="{{ route('role.create') }}" class="btn btn-success">Adicionar</a>
    </div>

    @if (! $roles->count())

        <div>Nenhuma função cadastrada.</div>

    @else

        <div class="row table-responsive">
        
        <div class="col-md-12">
            
            <table class="table table-striped">
                
                <thead>
                
                    <th>Nome</th>
                    <th>Usuários</th>
                    <th></th>

                </thead>

                <tbody>

                    @foreach($roles as $role)

                        <tr>

                            <td>{{ $role->name }}</td>
                            <td>{{ $role->users->count() }}</td>

                            <td class="action-column">

                                <form method="POST" action="{{ route('role.destroy', $role->id) }}" onsubmit="return confirm('Deseja realmente excluir esta função e seus usuários?')">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button class="btn btn-danger btn-sm" type="submit">
                                        excluir
                                    </button>
                                </form>

                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-default btn-sm">
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