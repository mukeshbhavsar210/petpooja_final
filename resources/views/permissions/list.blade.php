@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Permissions</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('create permissions')
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create</a>
                @endcan                
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('layouts.message')
            <div class="row">
            @if($permissions->isNotEmpty())
                @foreach ($permissions as $value)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><b>{{ $value->name }}</b></div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    @can('edit permissions')
                                        <a href="{{ route("permissions.edit", $value->id) }}" class="btn-primary btn">Edit</a>
                                    @endcan
                                    @can('delete permissions')
                                        <a href="javascript:void(0)" onclick="deletePermission({{ $value->id }})" class="btn btn-danger">Delete</a>
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
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
        
@section('customJs')
<script type="text/javascript">
    function deletePermission(id) {
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: '{{ route('permissions.destroy') }}',
                type: 'delete',
                data: {id:id},
                dataType: 'json',                    
                headers: {
                    'x-csrf-token' : '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.href="{{ route('permissions.index') }}"
                }
            });
        }
    }
</script>
@endsection