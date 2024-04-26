@extends('layouts.layout')

@section('main')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="form_route" method="POST" action="{{ route('route.store') }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
            @csrf
            <hr>
            @if ($errors->any())
            <div class="alert alert-danger">
                {{$errors->first('error')}}
            </div>
            @endif

            <div class="form-group">
                <label for="inputDstAddress">Destination Address</label>
                <input type="text" class="form-control form-control-sm input-text" name="dst-address" id="inputDstAddress" value="">
                @error('dst-address')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputGateway">Gateway</label>
                <input type="text" class="form-control form-control-sm input-text" name="gateway" id="inputGateway" value="">
                @error('gateway')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok" form="form_route">Save</button>
                <a href="{{ route('routes/static') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
