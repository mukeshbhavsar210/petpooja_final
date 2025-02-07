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
                    2
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
                    @foreach ($configurations as $value)
                        <h4>{{ $value->taxes }} - {{ $value->percentages }}%</h4>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tabs-6" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    {{-- {{ $value->plan }} --}}
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
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                console.log(response)
            }
        });



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