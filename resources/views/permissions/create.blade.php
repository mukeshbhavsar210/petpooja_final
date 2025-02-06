@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Create Permission</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('create permissions')
                    <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back</a>
                @endcan                
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" >Name</label>
                            <input value="{{ old('name') }}" name="name" placeholder="Permission name" type="text" class="form-control"/>
                            @error('name')
                                <p class="text-red-400 font-small">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</section>
@endsection

