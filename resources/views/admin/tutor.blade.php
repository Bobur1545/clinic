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
                                    Manzili
                                </th>
                                <th>
                                    Faculty_id
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
                            @foreach($tutors as $tutor)

                                <tr>
                                    <td>{{$tutor->id}}</td>
                                    <td>{{$tutor->name}}</td>
                                    <td>{{$tutor->tel_number}}</td>
                                    <td>{{$tutor->address}}</td>
                                    <td>{{$tutor->faculty_id}}</td>
                                    <td><img style="height: 100px" src="{{asset($tutor->image)}}"></td>
                                    <td>
                                        <form action="{{route('tutor.destroy', $tutor->id)}}" id="deleteTutorForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a onclick="document.getElementById('fid').value='{{$tutor->id}}';
                                            document.getElementById('fname').value='{{$tutor->name}}';
                                            document.getElementById('ftel_number').value='{{$tutor->tel_number}}';
                                            document.getElementById('faddress').value='{{$tutor->address}}';
                                            document.getElementById('ffaculty_id').value='{{$tutor->faculty_id}}';" id="showModal" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            </form>
                                        <button onclick="del()" class="btn btn-danger"><i class="fa fa-trash"></i></button>

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
                    <form action="{{route('tutor.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="title">Tutor nomini kiriting</label>
                            <input type="text" id="title" name="name" class="form-control" required>

                            <label for="tel_number">Telefon raqamni kiriting</label>
                            <input type="number" id="tel_number" name="tel_number" class="form-control" required>

                            <label for="address">Manzilni kiriting</label>
                            <textarea id="address" name="address" class="form-control" required></textarea>

                            <select class="custom-select" style="margin-top: 20px;" required name="faculty_id">
                                <option selected>Fakultetni tanlang</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{$faculty->id}}">{{$faculty->name}}</option>
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
                    <form action="{{route('tutor.update',1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input id="fid" style="display: none" name="id" required>

                            <label for="title">Tutor nomini yangilash</label>
                            <input type="text" id="fname" name="name" class="form-control" required>

                            <label for="tel_number">Telefon raqamni yangilash</label>
                            <input type="number" id="ftel_number" name="tel_number" class="form-control" required>

                            <label for="address">Manzilni yangilash</label>
                            <textarea id="faddress" name="address" class="form-control" required></textarea>


                            <select id="ffaculty_id" class="custom-select" style="margin-top: 20px;" required name="faculty_id">
                                @foreach($faculties as $faculty)
                                    <option value="{{$faculty->id}}">{{$faculty->name}}</option>
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
        @section('script')
            <script>
                form = document.getElementById('deleteTutorForm');
                function del(){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ha o\'chsin!',
                        cancelButtonText: 'Bekor qilish'

                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })}



            </script>

            @if (session('success'))

                <script>

                    $(document).ready(function() {

                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,

                            title:'{{session('success')}}',
                            icon:'success',

                        });
                    });
                </script>

    @endif
@endsection

