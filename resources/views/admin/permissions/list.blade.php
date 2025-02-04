@extends('admin.layouts.app')

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

<div class="container-fluid">
    @include('admin.layouts.message')
        <table class="table border">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>                        
                    <th>Email</th>    
                    <th>Action</th>                                
                </tr>
            </thead>
            <tbody class="bg-white">                    
                @if($permissions->isNotEmpty())
                    @foreach ($permissions as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</td>
                            <td>
                                @can('edit permissions')
                                    <a href="{{ route("users.edit", $value->id) }}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                @endcan   
                                @can('delete permissions')
                                    <a href="javascript:void(0)" onclick="deletePermission({{ $value->id }})" class="text-danger w-4 h-4 mr-1">
                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>    
                                @endcan                                 
                            </td>
                        </tr>
                    @endforeach
                @endif                            
            </tbody>
        </table>
        <div class="my-3">
            {{ $permissions->links() }}
        </div>
    </div>
</div>

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