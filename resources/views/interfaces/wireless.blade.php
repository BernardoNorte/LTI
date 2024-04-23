@extends('layouts.layout')

@section('main')
    <div class="container">
        <hr>
        <hr>
        <hr>
        <h1>Wireless Interfaces</h1>
        <hr>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Actual MTU</th>
                        <th>MAC Address</th>
                        <th>ARP</th>
                        <th>Mode</th>
                        <th>Band</th>
                        <th>Channel</th>
                        <th>Frequency</th>
                        <th>SSID</th>
                        <th>TX</th>
                        <th>RX</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($interfaces as $interface)
                        <tr>
                            <td>{{ $interface['name'] }}</td>
                            <td>{{ $interface['interface-type'] }}</td>
                            <td>{{ $interface['mtu'] }}</td>
                            <td>{{ $interface['mac-address'] }}</td>
                            <td>{{ $interface['arp'] }}</td>
                            <td>{{ $interface['mode'] }}</td>
                            <td>{{ $interface['band'] }}</td>
                            <td>{{ $interface['channel-width'] }}</td>
                            <td>{{ $interface['frequency'] }}</td>
                            <td>{{ $interface['ssid'] }}</td>
                            <td>{{ $interface['tx-chains'] }}</td>
                            <td>{{ $interface['rx-chains'] }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
