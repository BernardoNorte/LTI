@extends('layouts.layout')

@section('main')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="form_security" method="POST" action="{{ route('security.store') }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
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
                <label for="mode">Mode</label>
                <select class="form-control form-control-sm input-text form-select" name="mode" id="mode">
                    <option value="dynamic-keys">Dynamic Keys</option>
                    <option value="none">None</option>
                    <option value="static-keys-optional">Static Keys Optional</option>
                    <option value="static-keys-required">Static Keys Required</option>
                </select>
            </div>

            <div class="form-group">
                <label for="group_key_update">Group Key Update (HH:MM:SS)</label>
                <input type="text" class="form-control form-control-sm input-text" name="group-key-update" id="group-key-update" value="00:05:00">
            </div>

            <div class="form-group">
                <label for="management_protection">Management Protection</label>
                <select class="form-control form-control-sm input-text form-select" name="management-protection" id="management-protection">
                    <option value="allowed">Allowed</option>
                    <option value="disabled">Disabled</option>
                    <option value="required">Required</option>
                </select>
            </div>
            <hr>
            
            <div class="form-group">
                <input class="form-check-input" type="checkbox" name="disable-pmkid" id="disable-pmkid" >
                <label class="form-check-label" for="disable-pmkid">Disable PMKID</label> 
            </div>
            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="ok" form="form_security">Submit</button>
                <a href="{{ route('security.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        
        document.getElementById("disable_pmkid").addEventListener("click", function() {
            
            alert("PMKID disabled!");
        });
    </script>
@endsection
