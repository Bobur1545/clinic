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
                                    Group id
                                </th>
                                <th>
                                    Subject id
                                </th>
                                <th>
                                    Operation
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groupSubjects as $groupSubject)

                                <tr>
                                    <td>{{$groupSubject->id}}</td>
                                    <td>{{$groupSubject->group_id}}</td>
                                    <td>{{$groupSubject->subject_id}}</td>
                                    <td>
                                        <form action="{{route('groupSubject.destroy', $groupSubject->id)}}" method="POST">
                                            <a onclick="document.getElementById('fid').value='{{$groupSubject->id}}';
                                             document.getElementById('fid2').value='{{$groupSubject->group_id}}';
                                             document.getElementById('fid3').value='{{$groupSubject->subject_id}}';" id="showModal" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-pencil"></i></a>
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
                    <form action="{{route('groupSubject.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <select class="custom-select" style="margin-top: 20px;" required name="group_id">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>

                            <select class="custom-select" style="margin-top: 20px;" required name="subject_id">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
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
                    <form action="{{route('groupSubject.update',1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input id="fid" style="display: none" name="id" required>

                            <select class="custom-select" style="margin-top: 20px;" required name="group_id" id="fid2">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>

                            <select class="custom-select" style="margin-top: 20px;" required name="subject_id" id="fid3">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
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
