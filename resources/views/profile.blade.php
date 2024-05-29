@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-5 shadow mt-5 rounded-xl">
            <h1 class="text-left"><i class="fas fa-pen"></i> Edit profile</h1>
                 <!-- Default panel contents -->
                 @if (session('status'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Status</strong> {{ session('status') }}
                </div>
                @endif
                <form>
                <table class="table my-5 profile-table">
                    <tbody>
                        <tr>
                            <th>Fullname (*)</th>
                            <td><input type="text" class="form-control" id="user_fullname" value="{{$profile->name}}" required></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" class="form-control" value="{{$profile->email}}" disabled></td>
                        </tr>
                        <tr>
                            <th>Organization</th>
                            <td><input type="text" class="form-control" value="{{$profile->organization}}" disabled></td>
                        </tr>
                        <tr>
                            <th>Verify</th>
                            <td>{{$profile->email_verified ? 'Verified':'Not verify'}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><input type="button" onclick="update_org()" value="บันทึกการแก้ไข" class="btn btn-primary rounded-xl"></td>
                        </tr>
                    </tbody>
                </table>
                </form>
            
        </div>
    </div>
</div>
<script>
    const update_org = () => {
        $.ajax({
            url: '/update-user',
            type: 'PATCH',
            data: {
                _token: '{{csrf_token()}}',
                _value: document.getElementById('user_fullname').value,
                action: 'profile_update',
                id: {{$profile->id}}
            },
            success: (response) => {
                if (response.status == 'success') {
                    window.location.reload();
                } else {
                    alert("Something went wrong")
                }
            },
            error: (response) => {
                console.log(response)
                // alert(response.status);
            }
        });
    }
</script>
@endsection