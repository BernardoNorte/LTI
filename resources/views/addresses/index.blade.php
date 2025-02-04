@extends('layouts.layout')

@section('main')
    <h2>Dados dos Endereços IP</h2>
    <hr>
    <div class="mb-3">
        <a href="{{ route('address.create') }}" class="btn btn-primary" >Add</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Actual Interface</th>
                <th scope="col">Address</th>
                <th scope="col">Disabled</th>
                <th scope="col">Dynamic</th>
                <th scope="col">Interface</th>
                <th scope="col">Invalid</th>
                <th scope="col">Network</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($addresses as $ip)
                <tr>
                    <td>{{ $ip['.id'] }}</td>
                    <td>{{ $ip['actual-interface'] }}</td>
                    <td>{{ $ip['address'] }}</td>
                    <td>{{ $ip['disabled'] }}</td>
                    <td>{{ $ip['dynamic'] }}</td>
                    <td>{{ $ip['interface'] }}</td>
                    <td>{{ $ip['invalid'] }}</td>
                    <td>{{ $ip['network'] }}</td>
                    <td class="d-flex"> 
                        <a href="{{ route('address.edit', ['id' => $ip['.id']]) }}" class="btn btn-sm btn-primary me-1">Edit</a>
                        <form method="POST" action="{{ route('address.delete', ['id' => $ip['.id']]) }}">
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
