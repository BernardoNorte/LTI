@extends('layouts.layout')

@section('main')
    <div class="container">
        <hr>
        <hr>
        <hr>
        <h1>Security Profiles</h1>
        <div class=" mb-3">
            <a href="{{ route('security.create') }}" class="btn btn-primary" >Add</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th>Name</th>
                        <th>Mode</th>
                        <th>Authentication</th>
                        <th>Unicast Ciphers</th>
                        <th>Group Ciphers</th>
                        <th>WPA Pre-Shared Key</th>
                        <th>WPA2 Pre-Shared Key</th>
                        <th>Actions</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                        <tr>
                            <td>{{ $profile['name'] }}</td>
                            <td>{{ $profile['mode'] }}</td>
                            <td>{{ $profile['authentication-types'] }}</td>
                            <td>{{ $profile['unicast-ciphers'] }}</td>
                            <td>{{ $profile['group-ciphers'] }}</td>
                            <td class="hidetext">{{ $profile['wpa-pre-shared-key'] }}</td>
                            <td class="hidetext">{{ $profile['wpa2-pre-shared-key'] }}</td>
                            <td>Edit</td>
                            <td>Delete</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
<style>
    .hidetext { -webkit-text-security: disc;}
</style>
