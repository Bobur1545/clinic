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
                                    Ismi
                                </th>
                                <th>
                                    Group_id
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Operation
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)

                                <tr>
                                    <td>{{$student->id}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->group_id}}</td>
                                    <td><img style="height: 100px" src="{{asset($student->image)}}"></td>
                                    <td>
                                        <form action="{{route('student.destroy', $student->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a onclick="document.getElementById('fid').value='{{$student->id}}';
                                            document.getElementById('fname').value='{{$student->name}}';
                                            document.getElementById('fgroup_id').value='{{$student->group_id}}';" id="showModal" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2">
                                                <i class="fa fa-pencil"></i>
                                            </a>
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
                    <form action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="title">Student nomini kiriting</label>
                            <input type="text" id="title" name="name" class="form-control" required>

                            <label for="title">Guruh nomini kiriting</label>
                            <select class="custom-select" style="margin-top: 20px;" required name="group_id">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>

                            <label for="file">Rasmni kiriting</label>
                            <input type="file" name="image" id="file" class="form-control" required>

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
                    <form action="{{route('student.update',1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input id="fid" style="display: none" name="id" required>

                            <label for="title">Student nomini yangilash</label>
                            <input type="text" id="fname" name="name" class="form-control" required>

                            <label for="title">Guruh nomini yangilash</label>
                            <select id="fgroup_id" class="custom-select" style="margin-top: 20px;" required name="group_id">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>

                            <label for="file">Rasmni yangilash</label>
                            <input type="file" name="image" id="ffile" class="form-control" >

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
