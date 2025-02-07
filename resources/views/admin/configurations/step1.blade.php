<div class="card">
    <div class="card-body">
        @if ($configurations->count())
            @foreach ($configurations as $value)
                <div class="row">
                    <div class="col-md-2">
                        {{ $value->logo }}
                    </div>
                    <div class="col-md-10">
                        <h4>{{ $value->name }}</h4>
                        <p>Address: {{ $value->address }}<br />
                        Email: {{ $value->email }}<br />
                        Mobile: {{ $value->phone }}</p>
                        <p>Theme: {{ $value->theme }}</p>
                        <a href="{{ route("configurations.edit", $value->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            @endforeach
            @else
            <form action="{{ route('configurations.store') }}" method="post" >
                @csrf
                    <div class="row">   
                         

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" type="text" class="form-control" placeholder="Restaurant Name" value="{{ old('name') }}" />
                                @error('name')
                                    <p class="text-red-400 font-small">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" id="image_id" name="image_id" value=" ">
                                <label for="image">Logo</label>
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" placeholder="email" type="email" class="form-control" value="{{ old('email') }}" />
                                @error('email')
                                    <p class="text-red-400 font-small">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input name="phone" placeholder="Phone" type="text" class="form-control" value="{{ old('phone') }}" />
                                @error('phone')
                                    <p class="text-red-400 font-small">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" placeholder="Restaurant address" type="text" cols="3" rows="4" class="form-control">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-red-400 font-small">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Theme</label>
                                <input name="theme" placeholder="theme" type="text" class="form-control" value="{{ old('theme') }}" />
                                @error('theme')
                                    <p class="text-red-400 font-small">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            @endif                   
    </div>
</div>