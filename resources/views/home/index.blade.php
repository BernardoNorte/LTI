@extends('layouts.layout')

@section('main')
<hr>
<hr>
<hr>
    <h2>Login Credentials</h2>
    <form id="form-login" action="{{ route('update_login_credentials', ['loginName' => '', 'loginPassword' => '']) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="loginName">Username</label>
        <input type="text" class="form-control" id="loginName" name="loginName" value="{{ $loginName ?? '' }}" onchange="updateAction()">
    </div>
    <div class="form-group">
        <label for="loginPassword">Password</label>
        <input type="password" class="form-control" id="loginPassword" name="loginPassword" value="{{ $loginPassword ?? '' }}" onchange="updateAction()">
    </div>
    <hr>
    <button form="form-login" type="submit" class="btn btn-primary">Update Credentials</button>
</form>


        <hr>
    <h2>List of Neighbors</h2>
    <hr>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @if(count($neighbors) > 0)
        @foreach($neighbors as $neighbor)
        <div class="col">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Neighbor Info</h5>
                    @if(isset($neighbor['address']))
                        <p class="card-text">
                            <strong>IP Address:</strong> {{ $neighbor['address'] }}
                        </p>
                    @else
                        <p class="card-text">
                            <strong>IP Address:</strong> 0.0.0.0
                        </p>
                    @endif
                    <p class="card-text">
                        <strong>MAC:</strong> {{ $neighbor['mac-address'] }}
                    </p>
                    <p class="card-text">
                        <strong>Identity:</strong> {{ $neighbor['identity'] }}
                    </p>
                    <p class="card-text">
                        <strong>Version:</strong> {{ $neighbor['version'] }}
                    </p>
                    <p class="card-text">
                        <strong>Platform:</strong> {{ $neighbor['platform'] }}
                    </p>
                    <form action="{{ route('update_router_ip', ['newIp' => $neighbor['address'] ?? '0.0.0.0']) }}" method="POST">
                        @csrf
                        <button type="submit">Set IP Address</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    
        @endif
        <div class="col">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Neighbor Info</h5>
                    <p class="card-text">
                        <strong>MAC:</strong> 
                    </p>
                    <p class="card-text">
                        <strong>IP Address:</strong> 192.168.1.143
                    </p>
                    <p class="card-text">
                        <strong>Identity:</strong> 
                    </p>
                    <p class="card-text">
                        <strong>Version:</strong> 
                    </p>
                    <p class="card-text">
                        <strong>Platform:</strong> 
                    </p>
                    <form action="{{ route('update_router_ip', ['newIp' => '192.168.1.143'])}}" method="POST">
                        @csrf
                        <button type="submit">Update Router IP</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
    function updateAction() {
        var loginName = document.getElementById('loginName').value;
        var loginPassword = document.getElementById('loginPassword').value;
        var form = document.getElementById('form-login');
        form.action = "{{ route('update_login_credentials') }}" + '?loginName=' + encodeURIComponent(loginName) + '&loginPassword=' + encodeURIComponent(loginPassword);
    }
</script>
@endsection
