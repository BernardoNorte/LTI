@extends('layouts.layout')

@section('main')
    <h2>Configurações de DNS</h2>
    <hr>
    <div class="mb-3">
        <!-- Configurar DNS -->
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Endereço</th>
                <th scope="col">Desabilitado</th>
                <th scope="col">Dinâmico</th>
                <th scope="col">Nome</th>
                <th scope="col">TTL</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dns as $server)
                <tr>
                    <td>{{ $server['.id']}}</td>
                    <td>{{ $server['address']}}</td>
                    <td>{{ $server['disabled']}}</td>
                    <td>{{ $server['dynamic']}}</td>
                    <td>{{ $server['name']}}</td>
                    <td>{{ $server['ttl']}}</td>
                    <td>
                        <form method="POST" action="{{ route('dns.enable', ['id' => $server['.id']]) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Enable</button>
                        </form>
                        <form method="POST" action="{{ route('dns.disable', ['id' => $server['.id']]) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Disable</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
