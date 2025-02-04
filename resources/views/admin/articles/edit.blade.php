@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Article</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('articles.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('layouts.message')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('articles.update',$article->id) }}" method="post">
                        @csrf
                        <div>
                            <div class="my-3">
                                <label for="" >Name</label><br />
                                <input value="{{ old('title', $article->title) }}" name="title" placeholder="Title" type="text" class="form-control"/>
                                @error('title')
                                    <p class="text-red-400 font-small">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="" >Content</label><br />
                                <textarea cols="10" rows="4" id="text" name="text" placeholder="Content" type="text" class="form-control">{{ old('text', $article->text) }}</textarea>
                            </div>

                            <div class="my-3">
                                <label for="" >Author</label><br />
                                <input value="{{ old('author', $article->author) }}" name="author" placeholder="Author" type="text" class="form-control"/>
                                @error('author')
                                    <p class="text-red-400 font-small">{{ $message }}</p>
                                @enderror
                            </div>
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection