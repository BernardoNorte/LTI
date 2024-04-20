@extends('layouts.layout')

@section('main')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form id="form_bridge" method="POST" action="{{ route('bridge.update', ['id' => $bridge['.id']]) }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="inputNome">Name</label>
            <input type="text" class="form-control" name="name" id="inputNome" value="{{ old('name', $bridge['name']) }}">
            @error('name')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputMTU">MTU</label>
            <input type="number" class="form-control" name="mtu" id="inputMTU" value="{{ old('mtu', $bridge['mtu']) }}">
            @error('mtu')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="arp">ARP Option</label>
            <select class="form-control" name="arp" id="arp">
                <option value="disabled" {{ $bridge['arp'] == 'disabled' ? 'selected' : '' }}>Disabled</option>
                <option value="enabled" {{ $bridge['arp'] == 'enabled' ? 'selected' : '' }}>Enabled</option>
                <option value="local-proxy-arp" {{ $bridge['arp'] == 'local-proxy-arp' ? 'selected' : '' }}>Local Proxy ARP</option>
                <option value="proxy-arp" {{ $bridge['arp'] == 'proxy-arp' ? 'selected' : '' }}>Proxy AMP</option>
                <option value="reply-only" {{ $bridge['arp'] == 'reply-only' ? 'selected' : '' }}>Reply Only</option>
                
            </select>
            @error('arp')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputAgeingTime">Ageing Time</label>
            <input type="text" class="form-control" name="ageing-time" id="inputAgeingTime" value="{{ old('ageing-time', $bridge['ageing-time']) }}">
            @error('ageing-time')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="igmp-snooping" id="igmpSnooping" {{ $bridge['igmp-snooping'] == 'true' ? 'checked' : '' }}>
                <label class="form-check-label" for="igmpSnooping">IGMP Snooping</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="dhcp-snooping" id="dhcpSnooping" {{ $bridge['dhcp-snooping'] == 'true' ? 'checked' : '' }}>
                <label class="form-check-label" for="dhcpSnooping">DHCP Snooping</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="fast-forward" id="fastForward" {{ $bridge['fast-forward'] == 'true' ? 'checked' : '' }}>
                <label class="form-check-label" for="fastForward">Fast Forward</label>
            </div>
        </div>



        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok" id="form_bridge">Save</button>
            <a href="{{ route('interfaces/bridge') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection
