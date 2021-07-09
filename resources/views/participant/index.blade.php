@extends('layouts.admin')

@section('heading', 'Participant')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Overall Participant</h6>
            <a href="{{url('admin/participant/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Add Participant</a>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Group</th>
                            <th>NPM</th>
                            <th>name</th>
                            <th>Gender</th>
                            <th>Faculty</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($participants as $participant)
                            <tr>
                                <td>{{ $participant->year }}</td>
                                <td>{{ $participant->group }}</td>
                                <td>{{ $participant->npm }}</td>
                                <td>{{ $participant->name }}</td>
                                <td>{{ $participant->gender }}</td>
                                <td>{{ $participant->faculty }}</td>
                                <td>
                                    <a href="{{url('admin/participant', [$participant->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{url('admin/participant', [$participant->id]) }}')">
                                    Delete</button>
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Logout Delete-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Delete data.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure want to delete this data?</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form class="d-inline" method="POST" id="hapus" >
                        @method('delete')
                        @csrf   
                        <button class='btn btn-sm btn-danger' > Delete </button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function deleteConfirm(url) {
        $('#hapus').attr('action',url);
    }
</script>
    
@endsection