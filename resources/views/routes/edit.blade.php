@extends('layouts.layout')

@section('main')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <form id="form_route" method="POST" action="{{ route('route.update', ['id' => $routes['.id']]) }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="inputDstAddress">Destination Address</label>
            <input type="text" class="form-control" name="dst-address" id="inputDstAddress" value="{{ old('dst-address', $routes['dst-address']) }}">
            @error('dst-address')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputGateway">Gateway</label>
            <input type="text" class="form-control" name="gateway" id="inputGateway" value="{{ old('gateway', $routes['gateway']) }}">
            @error('gateway')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok" id="form_route">Save</button>
            <a href="{{ route('routes/static') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
