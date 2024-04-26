@extends('layouts.layout')

@section('main')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form id="form_dhcp" method="POST" action="{{ route('dhcp.update', ['id' => $dhcp['.id']]) }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name', $dhcp['name']) }}">
            @error('name')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputAddressPool">Address Pool</label>
            <input type="text" class="form-control" name="address-pool" id="inputAddressPool" value="{{ old('address-pool', $dhcp['address-pool']) }}">
            @error('address-pool')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="selectAuthoritative">Authoritative</label>
            <select class="form-control" name="authoritative" id="selectAuthoritative">
                <option value="yes" {{ $dhcp['authoritative'] == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $dhcp['authoritative'] == 'no' ? 'selected' : '' }}>No</option>
                <option value="after 2s delay" {{ $dhcp['authoritative'] == 'after 2s delay' ? 'selected' : '' }}>After 2s Delay</option>
                <option value="after 10s delay" {{ $dhcp['authoritative'] == 'after 10s delay' ? 'selected' : '' }}>After 10s Delay</option>
            </select>
            @error('authoritative')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="inputLeaseTime">Lease Time</label>
            <input type="text" class="form-control" name="lease-time" id="inputLeaseTime" value="{{ old('lease-time', $dhcp['lease-time']) }}">
            @error('lease-time')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="selectUseRadius">Use Radius</label>
            <select class="form-control" name="use-radius" id="selectUseRadius">
                <option value="no" {{ $dhcp['use-radius'] == 'no' ? 'selected' : '' }}>No</option>
                <option value="accounting" {{ $dhcp['use-radius'] == 'accounting' ? 'selected' : '' }}>Accounting</option>
                <option value="yes" {{ $dhcp['use-radius'] == 'yes' ? 'selected' : '' }}>Yes</option>
            </select>
            @error('use-radius')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <input type="hidden" name="interface" value="{{ $dhcp['interface'] }}">

        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok" id="form_dhcp">Save</button>
            <a href="{{ route('dhcp') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection
