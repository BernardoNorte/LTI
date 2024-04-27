@extends('layouts.layout')

@section('main')
    <h2>Dados dos Servidores DHCP</h2>
    <hr>
    <div class="mb-3">
        <a href="{{ route('dhcp.create') }}" class="btn btn-primary" >Add</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Address Pool</th>
                <th scope="col">Authoritative</th>
                <th scope="col">Disabled</th>
                <th scope="col">Dynamic</th>
                <th scope="col">Interface</th>
                <th scope="col">Lease Time</th>
                <th scope="col">Name</th>
                <th scope="col">Use Radius</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dhcp as $server)
                <tr>
                    <td>{{ $server['.id'] }}</td>
                    <td>{{ $server['address-pool'] }}</td>
                    <td>{{ $server['authoritative'] }}</td>
                    <td>{{ $server['disabled'] }}</td>
                    <td>{{ $server['dynamic'] }}</td>
                    <td>{{ $server['interface'] }}</td>
                    <td>{{ $server['lease-time'] }}</td>
                    <td>{{ $server['name'] }}</td>
                    <td>{{ $server['use-radius'] }}</td>
                    <td class="d-flex">
                        <a href="{{ route('dhcp.edit', ['id' => $server['.id']]) }}" class="btn btn-sm btn-primary me-1">Edit</a>
                        <form method="POST" action="{{ route('dhcp.delete', ['id' => $server['.id']]) }}">
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
