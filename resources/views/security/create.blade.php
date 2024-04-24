@extends('layouts.layout')

@section('main')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="form-security" method="POST" action="{{ route('security.store') }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
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
                    <option value="none">None</option>
                    <option value="dynamic-keys">Dynamic Keys</option>
                    <option value="static-keys-optional">Static Keys Optional</option>
                    <option value="static-keys-required">Static Keys Required</option>
                </select>
            </div>
            
            <div id="authentication-types" class="form-group" style="display: none;">
                <hr>
                <label>Authentication Types</label><br>
                <div>
                    <input class="form-check-input" type="checkbox" name="authentication-types" id="wpa-psk" value="wpa-psk">
                    <label class="form-check-label" for="wpa-psk">WPA PSK</label>
                    <input class="form-check-input" type="checkbox" name="authentication-types" id="wpa2-psk" value="wpa2-psk">
                    <label class="form-check-label" for="wpa2-psk">WPA2 PSK</label> 
                    <input class="form-check-input" type="checkbox" name="authentication-types" id="wpa-eap" value="wpa-eap">
                    <label class="form-check-label" for="wpa-eap">WPA EAP</label>
                    <input class="form-check-input" type="checkbox" name="authentication-types" id="wpa2-eap" value="wpa2-eap">
                    <label class="form-check-label" for="wpa-eap">WPA2 EAP</label>  
                </div>
            </div>
            
            <div class="form-group" id="wpa-pre-shared-key" style="display: none;">
                <label for="wpa-pre-shared-key">WPA Pre-Shared Key</label>
                <input type="password" class="form-control" name="wpa-pre-shared-key" id="wpa-pre-shared-key">
            </div>

            <div class="form-group" id="wpa2-pre-shared-key" style="display: none;">
                <label for="wpa2-pre-shared-key">WPA2 Pre-Shared key</label>
                <input type="password" class="form-control" name="wpa2-pre-shared-key" id="wpa2-pre-shared-key">
            </div>

            <div class="form-group" id="supplicant-identity" style="display: none;">
                <label for="supplicant-identity">Supplicant Identity</label>
                <input type="password" class="form-control" name="supplicant-identity" id="supplicant-identity">
            </div>

            <div id="unicast-ciphers" class="form-group" style="display: none;">
                <hr>
                <label>Unicast Ciphers</label><br>
                <input class="form-check-input" type="checkbox" name="unicast-ciphers" id="aes-ccm" value="aes-ccm">
                <label class="form-check-label" for="aes-ccm">aes ccm</label>
                <input class="form-check-input" type="checkbox" name="unicast-ciphers" id="tkip" value="tkip">
                <label class="form-check-label" for="aes-ccm">tkip</label> 
            </div>
            
            <div id="group-ciphers" class="form-group" style="display: none;">
                <hr>
                <label>Group Ciphers</label><br>
                <input class="form-check-input" type="checkbox" name="group-ciphers" id="aes-ccm2" value="aes-ccm">
                <label class="form-check-label" for="aes-ccm2">aes ccm</label>
                <input class="form-check-input" type="checkbox" name="group-ciphers" id="tkip2" value="tkip">
                <label class="form-check-label" for="tkip2">tkip</label>
                <hr>
            </div>
            
            <div class="form-group">
                <label for="group-key-update">Group Key Update (HH:MM:SS)</label>
                <input type="text" class="form-control form-control-sm input-text" name="group-key-update" id="group-key-update" value="00:05:00">
            </div>
            
            <div class="form-group">
                <label for="management-protection">Management Protection</label>
                <select class="form-control form-control-sm input-text form-select" name="management-protection" id="management-protection">
                    <option value="disabled">Disabled</option>
                    <option value="allowed">Allowed</option>
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
                <button type="submit" class="btn btn-success" name="ok" form="form-security">Submit</button>
                <a href="{{ route('security.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("mode").addEventListener("change", function() {
            var authenticationTypes = document.getElementById("authentication-types");
            var unicastCiphers = document.getElementById("unicast-ciphers");
            var groupCiphers = document.getElementById("group-ciphers");
            if (this.value === "dynamic-keys") {
                authenticationTypes.style.display = "block";
                unicastCiphers.style.display = "block";
                groupCiphers.style.display = "block";
            } else {
                authenticationTypes.style.display = "none";
                unicastCiphers.style.display = "none";
                groupCiphers.style.display = "none";
            }
        });

        document.querySelectorAll('input[type="checkbox"][name="authentication-types"]').forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                var wpaPreSharedKey = "wpa-psk";
                var wpa2PreSharedKey = "wpa2-psk";
                var supplicantIdentity = "wpa-eap";
                var passwordFieldId;

                if (this.value === wpaPreSharedKey) {
                    passwordFieldId = "wpa-pre-shared-key";
                } else if (this.value === wpa2PreSharedKey) {
                    passwordFieldId = "wpa2-pre-shared-key";
                } else if (this.value === supplicantIdentity) {
                    passwordFieldId = "supplicant-identity";
                }

                var passwordField = document.getElementById(passwordFieldId);

                if (this.checked) {
                    passwordField.style.display = "block";
                } else {
                    passwordField.style.display = "none";
                    passwordField.querySelector('input[type="password"]').value = "";
                }
            });
        });

        document.getElementById("disable-pmkid").addEventListener("click", function() {
            alert("PMKID disabled!");
        });

        
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                var passwordField = this.closest('.form-group').querySelector('input[type="password"]');
                if (!this.checked) {
                    passwordField.value = "";
                }
            });
        });
    </script>
@endsection
