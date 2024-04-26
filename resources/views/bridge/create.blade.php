@extends('layouts.layout')

@section('main')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="form_bridge" method="POST" action="{{ route('bridge.store') }}" class="form-group" enctype="multipart/form-data" style="width: 400px;">
            @csrf
            <hr>
            @if ($errors->any())
            <div class="alert alert-danger">
                {{$errors->first('error')}}
            </div>
            @endif
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
                <label for="arp">ARP Option</label>
                <select class="form-control form-control-sm input-text form-select" name="arp" id="arp">
                    <option value="disabled">Disabled</option>
                    <option selected value="enable">Enable</option>
                    <option value="local-proxy-arp">Local Proxy ARP</option>
                    <option value="proxy-amp">Proxy AMP</option>
                    <option value="reply-only">Reply Only</option>
                </select>
            </div>

            <div class="form-group">
                <label for="inputAgeingTime">Ageing Time </label>
                <input type="text" class="form-control form-control-sm input-text" name="ageing-time" id="inputAgeingTime" value="00:05:00">
            </div>

            <div class="form-group">
                <label>Additional Options</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="igmp-snooping" id="igmpSnooping">
                        <label class="form-check-label" for="igmpSnooping">IGMP Snooping</label>
                        
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="dhcp-snooping" id="dhcpSnooping">
                        <label class="form-check-label" for="dhcpSnooping">DHCP Snooping</label>
                        
                    </div>
                    <div class="form-check" id="dhcpSnoopingGroup" style="display: none;">
                        <input class="form-check-input" type="checkbox" name="dhcp-snooping82" id="dhcpSnooping82">
                        <label class="form-check-label" for="dhcpSnooping2">DHCP Snooping 2</label>
                        
                    </div>
                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" name="fast-forward" id="fastForward" value="true">
                        <label class="form-check-label" for="fastForward"> Fast Forward</label>
                        
                    </div>
                    
                </div>
            </div>

            <hr>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok" form="form_bridge">Save</button>
                <a href="{{ route('interfaces/bridge') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        // Se "DHCP Snooping" for selecionado, mostra o campo correspondente
        document.getElementById("dhcpSnooping").addEventListener("change", function() {
            var dhcpSnoopingGroup = document.getElementById("dhcpSnoopingGroup");
            dhcpSnoopingGroup.style.display = this.checked ? "block" : "none";
        });

        // Atualiza os valores dos campos de snooping antes de enviar o formulário
        document.getElementById("form_bridge").addEventListener("submit", function() {
            document.getElementById("igmpSnooping").value = document.getElementById("igmpSnooping").checked ? "true" : "false";
            document.getElementById("dhcpSnooping").value = document.getElementById("dhcpSnooping").checked ? "true" : "false";
            document.getElementById("dhcpSnooping2").value = document.getElementById("dhcpSnooping2").checked ? "true" : "false";
            document.getElementById("fastForward").value = document.getElementById("fastForward").checked ? "true" : "false";
        });
    </script>
@endsection
