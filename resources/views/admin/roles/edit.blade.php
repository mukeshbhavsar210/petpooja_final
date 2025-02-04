@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Permission</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('admin.layouts.message')
            <form action="{{ route('roles.update',$role->id) }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">                    
                        <div class="form-group">                            
                            <label for="" >Name</label>
                            <input value="{{ old('name', $role->name) }}" name="name" placeholder="Permission name" type="text" class="form-control"/>
                            @error('name')
                                <p class="text-red-400 font-small">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row">
                            @if($permissions->isNotEmpty())
                                @foreach ($permissions as $value)
                                    <div class="col-md-3">
                                        <input {{ ($hasPermissions->contains($value->name)) ? 'checked' : '' }} type="checkbox" id="permission_{{ $value->id }}" class="rounded" name="permission[]" value="{{ $value->name }}" />
                                        <label for="permission_{{ $value->id }}">{{ $value->name }}</label>
                                    </div>        
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form> 
            </div>               
        </div>
    </section>
@endsection
