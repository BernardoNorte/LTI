@extends('layouts.layout')

@section('main')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="form_wireguard" method="POST" action="{{ route('wireguard.store') }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
            @csrf
            <hr>
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first('error')}}
                </div>
            @endif

            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" class="form-control form-control-sm input-text" name="name" id="inputName" value="">
                @error('name')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputMTU">MTU</label>
                <input type="text" class="form-control form-control-sm input-text" name="mtu" id="inputMTU" value="">
                @error('mtu')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputListenPort">Listen Port</label>
                <input type="text" class="form-control form-control-sm input-text" name="listen-port" id="inputListenPort" value="">
                @error('listen-port')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok" form="form_wireguard">Save</button>
                <a href="{{ route('wireguard') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
