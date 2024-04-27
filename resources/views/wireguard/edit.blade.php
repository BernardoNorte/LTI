@extends('layouts.layout')

@section('main')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form id="form_wireguard" method="POST" action="{{ route('wireguard.update', ['id' => $wireguard['.id']]) }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name', $wireguard['name']) }}">
            @error('name')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputMTU">MTU</label>
            <input type="text" class="form-control" name="mtu" id="inputMTU" value="{{ old('mtu', $wireguard['mtu']) }}">
            @error('mtu')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputListenPort">Listen Port</label>
            <input type="text" class="form-control" name="listen-port" id="inputListenPort" value="{{ old('listen-port', $wireguard['listen-port']) }}">
            @error('listen-port')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok" id="form_wireguard">Save</button>
            <a href="{{ route('wireguard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
