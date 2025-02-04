@extends('layouts.layout')

@section('main')
    <hr>
    <hr>
    <hr>
    <div class=" mb-3">
        <a href="{{ route('bridge.create') }}" class="btn btn-primary" >Add</a>
    </div>
    <h1>Bridge Interfaces</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Bridge Interface</th>
                <th scope="col">MAC</th>
                <th scope="col">Protocol</th>
                <th scope="col">Interface</th>
                <th scope="col">Port Number</th>
                <th scope="col">Actions</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($interfacesWithPorts as $item)
                @php
                    $interface = $item['interface'];
                    $ports = $item['ports'];
                @endphp
                <tr>
                    <td>{{ $interface['name'] }}</td>
                    <td>{{ $interface['mac-address'] }}</td>
                    <td>{{ $interface['protocol-mode'] }}</td>
                    <td>
                        <ul>
                            @foreach($ports as $port)
                                <li>{{ $port['interface'] }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach($ports as $port)
                                <li>(Port {{ $port['port-number'] ?? ''}})</li> 
                            @endforeach
                        <ul>
                            
                        </ul>
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('bridge.edit', ['id' => $interface['.id']]) }}" class="btn btn-sm btn-primary">Edit</a>
                        <td>
                        <form method="POST" action="{{ route('bridge.delete', ['id' => $interface['.id']]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Delete</button>
                        </form>
                        </td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


