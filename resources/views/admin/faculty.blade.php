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
                                Fakultet nomi
                            </th>
                            <th>
                               Operation
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($faculties as $faculty)

                            <tr>
                                <td>{{$faculty->id}}</td>
                                <td>{{$faculty->name}}</td>
                                <td>
                                    <form action="{{route('faculty.destroy', $faculty->id)}}" method="POST" id="deleteFacultyForm">
                                        <a onclick="document.getElementById('fid').value='{{$faculty->id}}'; document.getElementById('fname').value='{{$faculty->name}}'" id="showModal" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-pencil"></i></a>
                                        @csrf
                                        @method('DELETE')
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
                <form action="{{route('faculty.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="title">Fakultet nomini kiriting</label>
                        <input type="text" id="title" name="name" class="form-control" required>

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
                <form action="{{route('faculty.update',1)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input id="fid" style="display: none" name="id" required>
                        <label for="title">Fakultet nomini kiriting</label>
                        <input id="fname" type="text" id="title" name="name" class="form-control" required>

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
            form = document.getElementById('deleteFacultyForm');
            function del(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ha o\'chirilsin!',
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

