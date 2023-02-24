@extends('admin.layout.app')
@section('content')
    <div role="document">
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col p-md-0" >

                        {{--                    modal uchun button--}}
                        <button type="button" id="showModal" style="margin: 30px;" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Yaratish</button>

                        <table class="table table-hover">
                            <thead>
                            <tr>

                                <th>
                                    Id
                                </th>
                                <th>
                                    Group nomi
                                </th>
                                <th>
                                    Department id
                                </th>
                                <th>
                                    Tutor id
                                </th>
                                <th>
                                    Operation
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)

                                <tr>
                                    <td>{{$group->id}}</td>
                                    <td>{{$group->name}}</td>
                                    <td>{{$group->dname}}</td>
                                    <td>{{$group->tutor_id}}</td>
                                    <td>
                                        <form action="{{route('group.destroy', $group->id)}}" method="POST">
                                            <a onclick="document.getElementById('fid').value='{{$group->id}}';
                                             document.getElementById('fname').value='{{$group->name}}';
                                             document.getElementById('fdepartment_id').value='{{$group->department_id}}';
                                             document.getElementById('ftutor_id').value='{{$group->tutor_id}}'" id="showModal" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-pencil"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>


                    </div>

                </div>

            </div>
        </div>


        {{--    create modal uchun--}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('group.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="title">Group nomini kiriting</label>
                            <input type="text" id="title" name="name" class="form-control" required>

                            <select class="custom-select" style="margin-top: 20px;" required name="department_id">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>

                            <select class="custom-select" style="margin-top: 20px;" required name="tutor_id">
                                @foreach($tutors as $tutor)
                                    <option value="{{$tutor->id}}">{{$tutor->name}}</option>
                                @endforeach
                            </select>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
                                <button type="submit" class="btn btn-primary">Saqlash</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>


        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('group.update',1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input id="fid" style="display: none" name="id" required>

                            <label for="fname">Department nomini yangilash</label>
                            <input id="fname" type="text"  name="name" class="form-control" required>

                            <select class="custom-select" style="margin-top: 20px;" required name="department_id" id="fdepartment_id">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>

                            <select class="custom-select" style="margin-top: 20px;" required name="tutor_id" id="ftutor_id">
                                @foreach($tutors as $tutor)
                                    <option value="{{$tutor->id}}">{{$tutor->name}}</option>
                                @endforeach
                            </select>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
                                <button type="submit" class="btn btn-primary">Tahrirlash</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

@endsection
