@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Roles</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('create roles')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">Create</a>
                @endcan                
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('layouts.message')
            <div class="row">
                @if($roles->isNotEmpty())
                    @foreach ($roles as $value)
                        <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><b>{{ $value->name }}</b></div>
                            <div class="card-body">                            
                                {{ $value->permissions->pluck('name')->implode(', ') }}
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            @can('edit roles')
                                                <a href="{{ route("roles.edit", $value->id) }}" class="btn-primary btn">Edit</a>
                                            @endcan
                                            @can('delete roles')
                                                <a href="javascript:void(0)" onclick="deleteRole({{ $value->id }})" class="btn btn-danger">Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif             
            </div>               
            <div class="my-3">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
    
@section('customJs')
    <script type="text/javascript">
        function deleteRole(id) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: '{{ route("roles.destroy") }}',
                    type: 'delete',
                    data: {id:id},
                    dataType: 'json',                    
                    headers: {
                        'x-csrf-token' : '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href="{{ route('roles.index') }}"
                    }
                });
            }
        }
    </script>
@endsection