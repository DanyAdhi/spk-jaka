@extends('layouts.admin')

@section('heading', 'Period')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Overall Period</h6>
            <a href="{{url('admin/period/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Add Period</a>
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
                            <th>Status</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($periods as $period)
                            <tr>
                                <td>{{ $period->year }}</td>
                                <td>{{ $period->group }}</td>
                                <td>
                                    <form class="d-inline" method="POST" action="{{url('admin/period/update-status', [$period->id])}}" >
                                        @method('PUT')
                                        @csrf   
                                        @if ($period->status=='Inactive')
                                            <button class='btn btn-sm btn-secondary'> <i class='fa fa-times'></i> Inactive </button>
                                        @else
                                            <button class='btn btn-sm btn-primary'> <i class='fa fa-check'></i> Active </button>
                                        @endif    
                                    </form>
                                </td>
                                <td>
                                    
                                    <a href="{{url('admin/period', [$period->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{url('admin/period', [$period->id]) }}')">
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