@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-sm-12 mx-auto">
            <div class="h3 text-left"><i class="fas fa-building"></i> Organization manager</div>
                 <!-- Default panel contents -->
                 <ul class="nav mt-5">
                    <li class="nav-item">
                        <form class="input-group rounded-xl">
                            <input type="search" class="form-control rounded-left" id="seach-input" placeholder="ค้นหา" name="s" value='{{@request()->get("s")}}'>
                            <div class="input-group-append">
                                <input type="submit" value="🔍 ค้นหา" class='btn btn-dark'>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item"><a href="/org-create" class="ml-2 nav-link btn btn-info rounded-xl btn-sm"><i class="fas fa-plus"></i> สร้างองค์กร</a></li>
                </ul>
                <table class="table table-striped table-hover p-3 shadow mt-5 rounded">
                    <thead>
                        <tr>
                            <th>Organization</th>
                            <th>Verified</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($org as $o)
                        <tr data-id="{{$o->id}}">
                            <td id="org_{{$o->id}}">{{$o->title}} <a onclick="edit_org({{$o->id}},'{{$o->title}}')" class="badge badge-warning"><i class="fa fa-pen"></i></a></td>
                            <td><span class="text-{{$o->status == 1 ? 'success':'danger'}}">{{$o->status == 1 ? 'ปกติ': 'ยกเลิก'}}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center flex-row mt-5">
                {{ $org->links() }}
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

                const edit_org = (id,title) => {
                    $('#org_' + id).html(`<input value="${title}" id="org_${id}_value"><a onclick="update_org(${id})"> <i class="fa fa-check-circle"></a>`)
                }

                const update_org = (id) => {
                    let value = $('#org_'+id+'_value').val();
                    $.ajax({
                        url: '/org-update',
                        type: 'PATCH',
                        data: {
                            _token: '{{csrf_token()}}',
                            org_value: value,
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

            </script>
        </div>
    </div>
</div>
@endsection
