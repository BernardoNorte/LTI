@extends('layouts.layout')

@section('main')
    <h2>Dados da Interface</h2>
    <div class="text-end mb-3">
        <a href="" class="btn btn-primary">Adicionar</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                
                <th scope="col">MAC</th>
                <th scope="col">Protocol</th>
                
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($interfaces as $interface)
                <tr>
                    <td>{{ $interface['name'] }}</td>
                    
                    <td>{{ $interface['mac-address'] }}</td>
                    <td>{{ $interface['protocol-mode'] }}</td>
                    
                    <td>
                        <a href="" class="btn btn-sm btn-primary">Editar</a>
                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Remover</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
