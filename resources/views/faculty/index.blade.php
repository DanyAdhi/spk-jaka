@extends('layouts.admin')

@section('heading', 'faculty')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Overall Faculty</h6>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#createModal"> Add Faculty</button>
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
                            <th>Name</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($faculties as $faculty)
                            <tr>
                                <td class="name">{{ $faculty->name }}</td>
                                <td>
                                    {{-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="editModal('{{url('admin/faculty', [$faculty->id]) }}')">Edit</button> --}}
                                    <button class="btn btn-sm btn-warning" onclick="editModal('{{url('admin/faculty', [$faculty->id]) }}')">Edit</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteModal('{{url('admin/faculty', [$faculty->id]) }}')">
                                    Delete</button>
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Create-->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Create new data.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="d-inline" method="POST" action="{{url('admin/faculty')}}" >
                    @csrf   
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Enter faculty" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class='btn btn-sm btn-primary' type="submit"> Save </button>    
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit data.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="d-inline" method="POST" id="edit" >
                    @method('put')
                    @csrf   
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Enter faculty" name="name" id="editName" value="">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>   
                        <button class='btn btn-sm btn-warning' type="submit"> Update </button>    
                    </div>
                        
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete-->
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
    function deleteModal(url) {
        $('#hapus').attr('action',url);
    }

    function editModal(url) {
        $('#edit').attr('action',url);
        $('#editModal').modal();
        $.get(url, function (data) {
            $('#editName').val(data.name);
        }) 
    }
</script>
    
@endsection