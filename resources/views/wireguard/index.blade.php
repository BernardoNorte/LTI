@extends('layouts.layout')

@section('main')
    <h2>Dados WireGuard</h2>
    <hr>
    @if(!empty($wireguard))
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Disabled</th>
                <th scope="col">Listen Port</th>
                <th scope="col">MTU</th>
                <th scope="col">Name</th>
                <th scope="col">Private Key</th>
                <th scope="col">Public Key</th>
                <th scope="col">Running</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wireguard as $vpn)
                <tr>
                    <td>{{ $vpn['.id'] }}</td>
                    <td>{{ $vpn['disabled'] }}</td>
                    <td>{{ $vpn['listen-port'] }}</td>
                    <td>{{ $vpn['mtu'] }}</td>
                    <td>{{ $vpn['name'] }}</td>
                    <td>{{ str_repeat('*', strlen($vpn['private-key'])) }}</td>
                    <td>{{ $vpn['public-key'] }}</td>
                    <td>{{ $vpn['running'] }}</td>
                    <td class="d-flex">
                        <a href="{{ route('wireguard.edit', ['id' => $vpn['.id']]) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" action="{{ route('wireguard.delete', ['id' => $vpn['.id']]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info" role="alert">
        No WireGuard Servers. <a href="{{route('wireguard.create')}}" class="alert-link">Add WireGuard Server</a>.
    </div>
@endif
@endsection
