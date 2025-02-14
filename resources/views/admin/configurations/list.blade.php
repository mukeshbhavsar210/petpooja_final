@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Configurations</h1>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
    @include('admin.layouts.message')

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Restaurant Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Branch</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Payments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Reservation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">GST</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Your Plan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">About us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-8" role="tab">Customer Website</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
            @include('admin.configurations.step1')
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <h4>Restaurant branches</h4>
                            <div class="row">
                                @if($branches->isNotEmpty())
                                    @foreach ($branches as $value)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <b>{{ $value->area_name }}</b>
                                                </div>
                                                <div class="card-body">
                                                    <p>Tables: {{ $value->seat->count() }}</p>
                                                    <a href="{{ route('areas.index') }}" class="outlineBtn btn-secondary mt-1">Add Table</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header pb-2">
                                    <h5>Create branch</h5>
                                </div>
                                <div class="card-body">                                    
                                    <form action="{{ route('areas.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="area_name" id="area_name" class="form-control" placeholder="Name">
                                            <input type="hidden" name="area_slug" id="area_slug" class="form-control" placeholder="Name">
                                            @error('area_name')
                                                <p class="text-red-400 font-small">Enter New Restaurant</p>
                                            @enderror
                                        </div>                                        
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <h1>Payments</h1>
                </div>
            </div>                
        </div>
        <div class="tab-pane" id="tabs-4" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <h1>Reservation</h1>
                </div>
            </div>                
        </div>
        <div class="tab-pane" id="tabs-5" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    {{ $configurations->pluck('taxes')->implode('') }}
                    {{ $configurations->pluck('percentages')->implode('') }} %
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tabs-6" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    {{ $configurations->pluck('plan')->implode('') }}
                </div>
            </div>                
        </div>
        <div class="tab-pane" id="tabs-7" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <h1>Customer Website</h1>
                </div>
            </div>                
        </div>
        <div class="tab-pane" id="tabs-8" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <h1>Customer Website</h1>
                </div>
            </div>                
        </div>
    </div>
    </div>
</div>
@endsection
        
@section('customJs')
<script type="text/javascript">
    $('#area_name').change(function(){
        element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);
                if(response["status"] == true){
                    $("#area_slug").val(response["slug"]);
                }
            }
        });
    })

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
                    window.location.href="{{ route('configurations.index') }}"
                }
            });
        }
    }
</script>
@endsection