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
                    <input class="form-check-input" type="checkbox" name="authentication-types[]" id="wpa-psk" value="wpa-psk">
                    <label class="form-check-label" for="wpa-psk">WPA PSK</label>
                    <input class="form-check-input" type="checkbox" name="authentication-types[]" id="wpa2-psk" value="wpa2-psk">
                    <label class="form-check-label" for="wpa2-psk">WPA2 PSK</label> 
                    <input class="form-check-input" type="checkbox" name="authentication-types[]" id="wpa-eap" value="wpa-eap">
                    <label class="form-check-label" for="wpa-eap">WPA EAP</label>
                    <input class="form-check-input" type="checkbox" name="authentication-types[]" id="wpa2-eap" value="wpa2-eap">
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

            <div id="unicast-ciphers" class="form-group">
                <hr>
                <label>Unicast Ciphers</label><br>
                <input checked class="form-check-input" type="checkbox" name="unicast-ciphers[]" id="aes-ccm" value="aes-ccm" >
                <label class="form-check-label" for="aes-ccm">aes ccm</label>
                <input class="form-check-input" type="checkbox" name="unicast-ciphers[]" id="tkip" value="tkip" >
                <label class="form-check-label" for="tkip">tkip</label> 
            </div>
            
            <div id="group-ciphers" class="form-group" >
                <hr>
                <label>Group Ciphers</label><br>
                <input checked class="form-check-input" type="checkbox" name="group-ciphers[]" id="aes-ccm2" value="aes-ccm" >
                <label class="form-check-label" for="aes-ccm2">aes ccm</label>
                <input class="form-check-input" type="checkbox" name="group-ciphers[]" id="tkip2" value="tkip" >
                <label class="form-check-label" for="tkip2">tkip</label>
                <hr>
            </div>
            
            <div class="form-group">
                <label for="group-key-update">Group Key Update (HH:MM:SS)</label>
                <input readonly type="text" class="form-control form-control-sm input-text" name="group-key-update" id="group-key-update" value="00:05:00">
            </div>
            
            <div class="form-group">
                <label for="management-protection">Management Protection</label>
                <select class="form-control form-control-sm input-text form-select" name="management-protection" id="management-protection">
                    <option value="disabled">Disabled</option>
                    <option value="allowed">Allowed</option>
                    <option value="required">Required</option>
                </select>
            </div>
            <div class="form-group" id="management-protection-key" style="display: none;">
                <label for="management-protection-key">Management Protection Key</label>
                <input type="password" class="form-control" name="management-protection-key" id="management-protection-key">
            </div>
            <hr>
            
            <div class="form-group">
                <input class="form-check-input" type="checkbox" name="disable-pmkid" id="disable-pmkid" value="disable-pmkid">
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
    var groupKeyUpdateField = document.getElementById("group-key-update");

    if (this.value === "dynamic-keys") {
        authenticationTypes.style.display = "block";
        unicastCiphers.style.display = "block";
        groupCiphers.style.display = "block";
        groupKeyUpdateField.removeAttribute("readonly");

        
        toggleCipherFieldsReadOnly(false);
    } else {
        authenticationTypes.style.display = "none"; 
        unicastCiphers.style.display = "none"; 
        groupCiphers.style.display = "none"; 
        groupKeyUpdateField.setAttribute("readonly", "readonly");
        groupKeyUpdateField.value = "00:05:00";

        
        toggleCipherFieldsReadOnly(true);

       
        document.getElementById("aes-ccm").checked = true;
        document.getElementById("aes-ccm2").checked = true;
        document.getElementById("tkip").checked = false;
        document.getElementById("tkip2").checked = false;
    }
});

function toggleCipherFieldsReadOnly(readOnly) {
    var cipherFields = document.querySelectorAll('input[type="checkbox"][name="unicast-ciphers[]"], input[type="checkbox"][name="group-ciphers[]"]');
    cipherFields.forEach(function(field) {
        field.disabled = readOnly;
    });
}


document.querySelectorAll('input[type="checkbox"][name="unicast-ciphers[]"], input[type="checkbox"][name="group-ciphers[]"]').forEach(function(checkbox) {
    checkbox.addEventListener("click", function(event) {
        if (document.getElementById("mode").value !== "dynamic-keys") {
            event.preventDefault();
        }
    });
});

document.getElementById("management-protection").addEventListener("change", function() {
    var managementProtectionKeyField = document.getElementById("management-protection-key");
    if (this.value === "disabled") {
        managementProtectionKeyField.style.display = "none";
        managementProtectionKeyField.value = ""; 
    } else {
        managementProtectionKeyField.style.display = "block";
    }
});


document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
        var passwordField = this.closest('.form-group').querySelector('input[type="password"]');
        if (!this.checked) {
            passwordField.value = "";
        }
    });
});


document.querySelectorAll('input[type="checkbox"][name="authentication-types[]"]').forEach(function(checkbox) {
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
</script>

@endsection
