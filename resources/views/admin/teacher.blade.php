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
                                    Telefon nomeri
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Mutaxassisligi
                                </th>
                                <th>
                                    Department_id
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
                            @foreach($teachers as $teacher)

                                <tr>
                                    <td>{{$teacher->id}}</td>
                                    <td>{{$teacher->name}}</td>
                                    <td>{{$teacher->tel_number}}</td>
                                    <td>{{$teacher->email}}</td>
                                    <td>{{$teacher->speciality}}</td>
                                    <td>{{$teacher->department_id}}</td>
                                    <td><img style="height: 100px" src="{{asset($teacher->image)}}"></td>
                                    <td>
                                        <form action="{{route('teacher.destroy', $teacher->id)}}" method="POST">
                                            <a onclick="document.getElementById('fid').value='{{$teacher->id}}';
                                            document.getElementById('fname').value='{{$teacher->name}}';
                                            document.getElementById('ftel_number').value='{{$teacher->tel_number}}';
                                            document.getElementById('femail').value='{{$teacher->email}}';
                                            document.getElementById('fspeciality').value='{{$teacher->speciality}}';
                                            document.getElementById('fdepartment_id').value='{{$teacher->department_id}}'" id="showModal" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-pencil"></i></a>
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
                    <form action="{{route('teacher.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="title">Teacher nomini kiriting</label>
                            <input type="text" id="title" name="name" class="form-control" required>

                            <label for="tel_number">Telefon raqamni kiriting</label>
                            <input type="number" id="tel_number" name="tel_number" class="form-control" required>

                            <label for="email">Emailini kiriting</label>
                            <input type="email" id="email" name="email" class="form-control" required>

                            <label for="speciality">Mutaxassisligini kiriting</label>
                            <input type="text" id="speciality" name="speciality" class="form-control" required>

                            <select class="custom-select" style="margin-top: 20px;" required name="department_id">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
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
                    <form action="{{route('teacher.update',1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input id="fid" style="display: none" name="id" required>
                            <label for="fname">Teacher nomini kiriting</label>
                            <input type="text" id="fname" name="name" class="form-control" required>

                            <label for="ftel_number">Telefon raqamni kiriting</label>
                            <input type="number" id="ftel_number" name="tel_number" class="form-control" required>

                            <label for="femail">Emailini kiriting</label>
                            <input type="email" id="femail" name="email" class="form-control" required>

                            <label for="fspeciality">Mutaxassisligini kiriting</label>
                            <input type="text" id="fspeciality" name="speciality" class="form-control" required>

                            <select class="custom-select" style="margin-top: 20px;" required name="department_id" id="fdepartment_id">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>

                            <label for="ffile">Rasmni kiriting</label>
                            <input type="file" name="image" id="ffile" class="form-control">

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
