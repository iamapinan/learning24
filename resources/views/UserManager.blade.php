@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="h3 text-left"><i class="fas fa-users"></i> User manager</div>
                 <!-- Default panel contents -->
                 <ul class="nav mt-5">
                    <li class="nav-item">
                        <form class="input-group rounded-xl">
                            <input type="text" class="form-control rounded-left" id="seach-input" placeholder="ค้นหา" name="s" value='{{@request()->get("s")}}'>
                            <div class="input-group-append">
                                <input type="submit" value="🔍 ค้นหา" class='btn btn-dark'>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item"><a href="/create-user" class="ml-2 nav-link btn btn-warning btn-outline-dark rounded-xl btn-sm"><i class="fas fa-plus-circle"></i> สร้างผู้ใช้ใหม่</a></li>
                    <li class="nav-item"><a href="/create-org" class="ml-2 nav-link btn btn-info btn-outline-dark rounded-xl btn-sm"><i class="fas fa-plus"></i> สร้างองค์กร</a></li>
                </ul>
                <table class="table table-striped table-hover p-3 shadow mt-5 rounded">
                    <thead>
                        <tr>
                            <th>Fullname</th>
			    <th>Email</th>
			    <th>Role</th>
                            <th>Initial Password</th>
                            <th>Organization</th>
                            <th>Verified</th>
                            <th>Last Modify</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr data-id="{{$u->id}}">
                            <td><a href="/shelf/{{base64_encode($u->email)}}">{{$u->name}}</a></td>
			    <td>{{$u->email}}</td>
			    <td>{{$u->role_id == 1 ? 'แอดมิน' : 'ผู้ใช้ทั่วไป'}}</td>
                            <td>{{$u->init_password}}</td>
                            <td id="org_{{$u->id}}">{{$u->organization}} <a onclick="edit_org({{$u->id}})" class="badge badge-warning"><i class="fa fa-pen"></i></a></td>
                            <td><span class="text-{{$u->email_verified == 1 ? 'success':'danger'}}">{{$u->email_verified == 1 ? 'ปกติ': 'ห้าม'}}</span></td>
                            <td>{{$u->created_at}}</td>
                            <td>
				<button class="btn btn-outline-dark btn-sm btn-reset" title="reset password" onclick="resetPassword({{$u->id}})"><i class="fas fa-history"></i> รีเซ็ทรหัสผ่าน</button>
				@if($u->role_id==2)
                                <button class="btn btn-sm {{$u->email_verified != 1 ? 'btn-outline-primary':'btn-outline-dark'}} btn-ban" title="ban user" onclick="banUser({{$u->id}}, {{$u->email_verified == 1 ? '0':'1'}})"><i class="fas fa-ban"></i> {{$u->email_verified == 1 ? 'แบน':'ยกเลิก'}}</button>
				<button class="btn btn-outline-dark btn-delete btn-sm" title="delete user" data-id="{{$u->id}}"><i class="fa fa-trash"></i> ลบ</button>
				@endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center flex-row mt-5">
                {{ $users->links() }}
                </div>
            <script>
                $(document).ready(function(){
                    $('.btn-delete').click(function(){
                        if(confirm('Are you sure to delete this user?')){
                            var id = $(this).data('id');
                            $.ajax({
                                url: '/delete-user/'+id,
                                type: 'DELETE',
                                data: {
                                    _token: '{{csrf_token()}}'
                                },
                                success: (response) => {
                                    if (response.status == 'success') {
                                        $("tr[data-id='"+id+"']").remove();
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
                    });
                });

                const edit_org = (id) => {
                    $('#org_' + id).html(`<select id="org_${id}_value">
                    @foreach($org as $o)
                    <option value="{{$o->id}}">{{$o->title}}</option>
                    @endforeach
                    </select><a onclick="update_org(${id})"><i class="fa fa-check-circle"></a>`)
                }

                const update_org = (id) => {
                    let selected_org = $('#org_'+id+'_value').val();
                    $.ajax({
                        url: '/update-user',
                        type: 'PATCH',
                        data: {
                            _token: '{{csrf_token()}}',
                            org_value: selected_org,
                            action: 'org',
                            id: id
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

                const resetPassword = (id) => {
                        if(confirm('Are you sure to reset password to reset password?')){
                            $.ajax({
                                url: '/update-user',
                                type: 'PATCH',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    id: id,
                                    action: 'reset'
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
                    }

                const banUser = (id, ban) => {
                        if(confirm('Are you sure?')){
                            $.ajax({
                                url: '/update-user',
                                type: 'PATCH',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    status: ban,
                                    id: id,
                                    action: 'ban'
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
                    }
            </script>
        </div>
    </div>
</div>
@endsection
