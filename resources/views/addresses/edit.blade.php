@extends('layouts.layout')

@section('main')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form id="form_address" method="POST" action="{{ route('address.update', ['id' => $address['.id']]) }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" name="address" id="inputAddress" value="{{ old('address', $address['address']) }}">
            @error('address')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputNetwork">Network</label>
            <input type="text" class="form-control" name="network" id="inputNetwork" value="{{ old('network', $address['network']) }}">
            @error('network')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok" id="form_address">Save</button>
            <a href="{{ route('addresses') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
