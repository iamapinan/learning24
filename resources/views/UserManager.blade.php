@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                 <!-- Default panel contents -->
                <div class="panel-heading">User manager</div>
                <div class="panel-body">
                
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Group</th>
                                <th>Grade</th>
                                <th>Last Modify</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>{{$u->role_id}}</td>
                                <td>{{$u->group_id}}</td>
                                <td>{{$u->grade_id}}</td>
                                <td>{{$u->created_at}}</td>
                                <td>
                                    <button class="btn btn-link"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-link"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection