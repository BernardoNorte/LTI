@extends('layouts.layout')

@section('main')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="form_address" method="POST" action="{{ route('address.store') }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
            @csrf
            <hr>
            @if ($errors->any())
            <div class="alert alert-danger">
                {{$errors->first('error')}}
            </div>
            @endif

            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control form-control-sm input-text" name="address" id="inputAddress" value="">
                @error('address')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputInterface">Interface</label>
                <select class="form-control form-control-sm" name="interface" id="inputInterface">
                    @foreach ($interfaceNames as $interface)
                        <option value="{{ $interface }}">{{ $interface }}</option>
                    @endforeach
                </select>
                @error('interface')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputNetwork">Network</label>
                <input type="text" class="form-control form-control-sm input-text" name="network" id="inputNetwork" value="">
                @error('network')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok" form="form_address">Save</button>
                <a href="{{ route('addresses') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
