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
                        <th>Frequency</th>
                        <th>Actions</th>
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
                            <td>{{ $interface['ssid'] }}</td>
                            <td>
                                <form method="POST" action="{{ route('wireless.enable', ['id' => $interface['.id']]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Enable</button>
                                </form>
                                <form method="POST" action="{{ route('wireless.disable', ['id' => $interface['.id']]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Disable</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
