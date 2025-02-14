@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="row">
        <div class="col-sm-9">
            <h1>Menu <span class="count">{{ $totalMenu }}</span></h1>
        </div>

        <div class="col-sm-3 ">
            <div class=" float-end">
                <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addMenuItem">Add Menu</button>

                <a href="javascript:void(0)" class="addBtn btn btn-primary">Add Category</a>

                <div class="smallForm">
                    <form action="" method="post" id="categoryForm" name="categoryForm" class="form" >
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
                            <p></p>
                            <input type="hidden" name="slug" id="slug">
                            <button type="submit" class="tickBtn">
                                <svg fill="#000000" width="23px" height="23px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,1A11,11,0,1,0,23,12,11.013,11.013,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9.011,9.011,0,0,1,12,21ZM17.737,8.824a1,1,0,0,1-.061,1.413l-6,5.5a1,1,0,0,1-1.383-.03l-3-3a1,1,0,0,1,1.415-1.414l2.323,2.323,5.294-4.853A1,1,0,0,1,17.737,8.824Z"/></svg>
                            </button>
                        </div>
                        <a href="javascript:void(0)" class="removeBtn" >
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.16998 14.83L14.83 9.17004" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14.83 14.83L9.16998 9.17004" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </form>
                </div>
            </div>                
        </div>
    </div>
</section>

<section>
    @include('admin.layouts.message')

        <div class="modal fade drawer right-align" id="addMenuItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="modal-body">                  
                        <div class="form-group">
                            <label for="name">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a category</option>
                                @if($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>
                                                        
                        <div class="form-group">
                            <label for="name">Menu Name</label>
                            <input type="text" name="name" id="item_name" class="form-control" placeholder="Menu Name">
                            <p></p>
                        </div> 

                        <input type="hidden" name="slug" id="item_slug" class="form-control" placeholder="Slug">

                        <div class="form-group">
                            <label for="image">Picture</label>
                            <input type="file" class="form-control" name="image" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        @if ($categories->isNotEmpty())
            @foreach ($categories as $value)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs_{{ $value->id }}" role="tab">{{ $value->name }} 
                        {{-- {{ $value->name->count('name') }} --}}
                        @if($value->total_products > 0)
                            <span class="count-sub">{{ $value->total_products }}</span>    
                        @endif                                
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
        
    <div class="tab-content">
        @if ($categories->isNotEmpty())
            @foreach ($categories as $value)
                <div class="tab-pane" id="tabs_{{ $value->id }}" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="row ">
                                @if ($value->menus->isNotEmpty())
                                    @foreach ($value->menus as $value)
                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <b>{{ $value->name }}</b>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="productPic">
                                                    <div class="editControl">
                                                        <a href="{{ route('menu.edit', $value->id ) }}">
                                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="#" onclick="deleteMenuItem({{ $value->id }})" class="text-danger w-4 h-4 mr-1">
                                                            <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <img style="width:100%" src="{{ asset('uploads/menu/'.$value->image) }}" alt="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    
</section>
@endsection

@section('customJs')
<script>    

$("#addingMenuForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("categories.store_menu") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);

                if(response["status"] == true){
                    window.location.href="{{ route('categories.index') }}"
                    $('#name').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors']
                    if(errors['name']){
                        $('#name').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
                }
            }, error: function(jqXHR, exception) {
                console.log("Something event wrong");
            }
        })
    });   


    //DELETE
    function deleteMenuItem(id){
        var url = '{{ route("menu.delete","ID") }}'
        var newUrl = url.replace("ID",id)

        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    window.location.href="{{ route('categories.index') }}"
                }
            });
        }
    }


  
    $("#categoryForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("categories.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);

                if(response["status"] == true){
                    window.location.href="{{ route('categories.index') }}"
                    $('#name').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors']
                    if(errors['name']){
                        $('#name').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
                }
            }, error: function(jqXHR, exception) {
                console.log("Something event wrong");
            }
        })
    });      

    

    $('#item_name').change(function(){
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
                    $("#item_slug").val(response["slug"]);
                }
            }
        });
    })

    $('#name').change(function(){
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
                    $("#slug").val(response["slug"]);
                }
            }
        });
    })

    //DELETE
    function deleteCategory(id){
        var url = '{{ route("categories.delete","ID") }}'
        var newUrl = url.replace("ID",id)

        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    window.location.href="{{ route('categories.index') }}"
                }
            });
        }
    }

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
    </script>
@endsection
