@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-9">
                <h1>Menu Item <span class="count">{{ $menuCount }}</span></h1>
            </div>
            <div class="col-sm-3">
                {{-- <form action="{{ route('views.store') }}" method="post" >
                    @csrf
                    <div class="switch-field">
                        <input type="radio" id="radio-one" name="view" value="Grid" checked/>
                        <label for="radio-one">Grid</label>
                        <input type="radio" id="radio-two" name="view" value="Table" />
                        <label for="radio-two">Table</label>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form> --}}
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addProducts">Add Product</button>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid">
        @include('admin.layouts.message')
        <!-- Modal -->
        <div class="modal fade drawer right-align" id="addProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form {{ route('products.store') }} method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group mb-0">
                                    <label for="name">Item Name</label>
                                </div>
                                <div class="produtName">
                                    <div>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                        <p class="error"></p>
                                        <input type="hidden" name="slug" id="slug" class="form-control" placeholder="slug">
                                    </div>
                                    <div class="vegContainer">
                                        <div class="btn-group" name="veg_nonveg" id="options" data-toggle="buttons">
                                            <label class="btn btn-default active">
                                            <input type="radio" checked name="veg_nonveg" id="option1" class="btn-check" value="Veg">
                                                <div class="innerView">
                                                    <img src="{{ asset('admin-assets/img/veg.svg') }}" alt="" >
                                                </div>                                          
                                            </label>
        
                                            <label class="btn btn-default" >
                                            <input type="radio" name="veg_nonveg" id="option2" class="btn-check" value="Non-veg" >
                                                <div class="innerView">
                                                    <img src="{{ asset('admin-assets/img/non-veg.svg') }}" alt="" >
                                                </div>
                                            </label>
                                            
                                            <label class="btn btn-default" >
                                            <input type="radio" name="veg_nonveg" id="option3" class="btn-check" value="Egg" >
                                                <div class="innerView">
                                                    <img src="{{ asset('admin-assets/img/egg.svg') }}" alt="" >
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control" placeholder="Price">
                                    <p class="error"></p>
                                </div>
                            </div>  
                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="compare_price">Office Price</label>
                                    <input type="number" name="compare_price" id="compare_price" class="form-control" placeholder="Offer Price">
                                    <p class="error"></p>
                                </div>
                            </div>                                                  
                            <div class="col-md-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="category">Choose Menu</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="">Select</option>
                                                @if ($categories->isNotEmpty())
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="menu">Item category</label>
                                            <select name="menu" id="sub_category" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                   
                            <div class="col-md-12 col-12">
                                <div class="form-group">                                                                
                                    <label for="image">Picture</label>
                                    <input type="file" class="form-control" name="image" />
                                </div>                                
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="5" rows="4" class="form-control" placeholder="Description"></textarea>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <?php
            $view = gridTableView()->pluck('view')->implode('');
        ?>

        @if($view == 'Table')
            <table class="table border">
                <tbody>
                    <th>Pic</th>
                    <th>Name</th>
                    <th>Discriptions</th>
                    <th>Category</th>
                    <th>Menu</th>
                    <th>Action</th>
                </tbody>
                <tbody>
                    @if ($products->isNotEmpty())
                        @foreach($products as $value)
                            <tr>
                                <td>
                                    @if (!empty($value->image))
                                        <img src="{{ asset('uploads/product/'.$value->image) }}" style="border-radius: 5px; width:100px;" >
                                        @else
                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" width="50"  />
                                    @endif
                                </td>                           
                                <td>{{ $value->name }}</td>                             
                                <td>{{ $value->description }}</td>
                                <td>{{ $value->category->name }}</td>
                                <td>{{ $value->menu->name }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $value->id) }}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a> 
                                    <a href="#" onclick="deleteProduct( {{ $value->id }} )" class="text-danger deleteProduct">
                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="center">
                                            Records not found
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                </tbody>
            </table>
            {{-- {{ $products->links() }} --}}
        @else
            <div class="row">
                @if ($products->isNotEmpty())
                    @foreach($products as $value)
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-header">
                                <b>{{ $value->name }}</b><br />
                                ₹ {{ $value->price }}.00
                                {{-- {{ $value->category->name }} --}}
                            </div>
                            <div class="productPic">
                                <div class="editControl">
                                    <a href="{{ route('products.edit', $value->id) }}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>                                        
                                    <a href="{{ route('products.delete', $value->id) }}" class="text-danger deleteProduct">
                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>  
                                    @if (!empty($value->image))
                                        <img src="{{ asset('uploads/product/'.$value->image) }}" style="border-radius: 5px; width:100%;" >
                                    @else
                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" width="50"  />
                                    @endif
                                </div>                                
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="center">
                                    Records not found
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>


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


    $("#category").change(function(){
        var category_id = $(this).val();
        $.ajax({
            url: '{{ route("product-subcategories.index") }}',
            type: 'get',
            data: {category_id:category_id},
            dataType: 'json',
            success: function(response) {
                $("#sub_category").find("option").not(":first").remove();
                $.each(response["subCategories"],function(key,item){
                    $("#sub_category").append(`<option value='${item.id}' >${item.name}</option>`)
                })
            },
            error: function(){
                console.log("Something went wrong")
            }
        });
    })
</script>
@endsection