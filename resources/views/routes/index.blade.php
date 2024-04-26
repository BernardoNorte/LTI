@extends('layouts.layout')

@section('main')
    <h2>Dados das Rotas Estáticas</h2>
    <hr>
    <div class="mb-3">
        <a href="{{ route('route.create') }}" class="btn btn-primary" >Add</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Distância</th>
                <th scope="col">Endereço Destino</th>
                <th scope="col">Dinâmica</th>
                <th scope="col">ECMP</th>
                <th scope="col">Gateway</th>
                <th scope="col">HW Offloaded</th>
                <th scope="col">Immediate GW</th>
                <th scope="col">Inativa</th>
                <th scope="col">Tabela de Roteamento</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
                <tr>
                    <td>{{ $route['.id'] }}</td>
                    <td>{{ $route['distance'] }}</td>
                    <td>{{ $route['dst-address'] }}</td>
                    <td>{{ $route['dynamic'] }}</td>
                    <td>{{ $route['ecmp'] }}</td>
                    <td>{{ $route['gateway'] }}</td>
                    <td>{{ $route['hw-offloaded'] }}</td>
                    <td>{{ $route['immediate-gw'] }}</td>
                    <td>{{ $route['inactive'] }}</td>
                    <td>{{ $route['routing-table'] }}</td>
                    <td>
                        <a href="{{ route('route.edit', ['id' => $route['.id']]) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" action="{{ route('route.delete', ['id' => $route['.id']]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection