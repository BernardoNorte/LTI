@extends('layouts.layout')


@section('main')
    <form id="form_bridge" method="POST" action="{{ route('bridge.store') }}" class="form-group" enctype="multipart/form-data">
        @csrf
        <hr>
        <hr>
        <hr>
        <div class="form-group">
            <label for="inputNome">Name</label>
            <input type="text" class="form-control form-control-sm input-text" name="name" id="inputNome" value="">
            @error('name')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputMtu">MTU</label>
            <textarea class="form-control form-control-sm input-text" name="mtu" id="inputMtu"></textarea>
            @error('mtu')
                <div class="small text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="arp" >ARP Option</label>
            <select class="form-control form-control-sm input-text form-select" name="arp" id="arp">
                <option value="disabled" >Disabled</option>
                <option selected value="enable" >Enable</option>
                <option value="local-proxy-arp" >Local Proxy ARP</option>
                <option value="proxy-amp" >Proxy AMP</option>
                <option value="reply-only" >Reply Only</option>
            </select>
            
        </div>

        <hr>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok" form="form_bridge">Save</button>
            <a href="{{ route('interfaces/bridge') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
