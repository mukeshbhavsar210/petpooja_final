<div class="card">
    <div class="card-body">
        @if ($configurations->count())
            <div class="row">
                <div class="col-md-2">
                    <img style="width: 150px;" src="{{ asset('uploads/logo/'.$configurations->pluck('image')->implode('')) }}" />
                </div>
                <div class="col-md-8">
                    <h4>{{ $configurations->pluck('name')->implode('') }}</h4>
                    <p>Address: {{ $configurations->pluck('address')->implode('') }}<br />
                    Email: {{ $configurations->pluck('email')->implode('') }}<br />
                    Mobile: {{ $configurations->pluck('phone')->implode('') }}</p>
                    <a href="{{ route("configurations.update") }}" class="btn btn-primary">Edit</a>
                </div>
                <div class="col-md-2">
                    <p>Applied Theme</p>
                    <div class="flex-wrapper">
                        <div class="theme">
                            <div class="theme-primary" style="background-color: {{ $configurations->pluck('primary_color')->implode('') }}"></div>
                        </div>
                        <div class="theme">
                            <div class="theme-primary" style="background-color: {{ $configurations->pluck('secondary_color')->implode('') }}"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            @else
            <form action="{{ route('configurations.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                    <div class="row">   
                        <div class="col-md-8">
                            <div class="row">   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input name="name" type="text" class="form-control" placeholder="Restaurant Name" value="{{ old('name') }}" />
                                        @error('name')
                                            <p class="text-red-400 font-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" placeholder="email" type="email" class="form-control" value="{{ old('email') }}" />
                                        @error('email')
                                            <p class="text-red-400 font-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" placeholder="Phone" type="text" class="form-control" value="{{ old('phone') }}" />
                                        @error('phone')
                                            <p class="text-red-400 font-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Primary Color</label>
                                        <input name="primary_color" placeholder="theme" type="color" class="form-control" value="{{ old('primary_color') }}" />
                                        @error('primary_color')
                                            <p class="text-red-400 font-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Secondary Color</label>
                                        <input name="secondary_color" placeholder="theme" type="color" class="form-control" value="{{ old('secondary_color') }}" />
                                        @error('secondary_color')
                                            <p class="text-red-400 font-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" placeholder="Restaurant address" type="text" cols="3" rows="4" class="form-control">{{ old('address') }}</textarea>
                                        @error('address')
                                            <p class="text-red-400 font-small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Logo</label>
                                <input type="file" class="form-control" name="image" />
                            </div>
                        </div>                         
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            @endif                   
    </div>
</div>