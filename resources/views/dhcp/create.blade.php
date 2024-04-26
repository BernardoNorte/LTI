@extends('layouts.layout')

@section('main')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="form_dhcp" method="POST" action="{{ route('dhcp.store') }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
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
                <label for="inputLeaseTime">Lease Time</label>
                <input type="text" class="form-control form-control-sm input-text" name="lease-time" id="inputLeaseTime" value="00:30:00">
                @error('lease-time')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputAuthoritative">Authoritative</label>
                <select class="form-control form-control-sm" name="authoritative" id="inputAuthoritative">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    <option value="after 2s delay">After 2s Delay</option>
                    <option value="after 10s delay">After 10s Delay</option>
                </select>
                @error('authoritative')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputBootpSupport">Bootp Support</label>
                <select class="form-control form-control-sm" name="bootp-support" id="inputBootpSupport">
                    <option value="static">Static</option>
                    <option value="none">None</option>
                    <option value="dynamic">Dynamic</option>
                </select>
                @error('bootp-support')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputUseRadius">Use Radius</label>
                <select class="form-control form-control-sm" name="use-radius" id="inputUseRadius">
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                    <option value="accounting">Accounting</option>
                </select>
                @error('use-radius')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok" form="form_dhcp">Save</button>
                <a href="{{ route('dhcp') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
