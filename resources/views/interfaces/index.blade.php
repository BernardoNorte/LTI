@extends('layouts.layout')

@section('main')
    <div class="container">
        <h1>Interfaces do Dispositivo</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>MAC Address</th>
                        <th>MTU</th>
                        <th>Type</th>
                        <th>Running</th>
                        <th>RX Byte</th>
                        <th>RX Packet</th>
                        <th>TX Byte</th>
                        <th>TX Packet</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($interfaces as $interface)
                        <tr>
                            <td>{{ $interface['name'] }}</td>
                            <td>{{ $interface['mac-address'] }}</td>
                            <td>{{ $interface['mtu'] }}</td>
                            <td>{{ $interface['type'] }}</td>
                            <td>{{ $interface['running'] }}</td>
                            <td>{{ $interface['rx-byte'] }}</td>
                            <td>{{ $interface['rx-packet'] }}</td>
                            <td>{{ $interface['tx-byte'] }}</td>
                            <td>{{ $interface['tx-packet'] }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
