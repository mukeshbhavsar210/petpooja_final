@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Articles</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('create articles')
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create</a>
                @endcan                
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('layouts.message')
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Title</th>                        
                        <th>Author</th>    
                        <th width="250">Created</th>
                        <th>Action</th>                                
                    </tr>
                </thead>
                <tbody>
                    @if($articles->isNotEmpty())
                        @foreach ($articles as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->author }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}
                                </td>
                                <td>
                                    @can('edit articles')
                                        <a href="{{ route("articles.edit", $value->id) }}" class="btn-primary btn">Edit</a>    
                                    @endcan
                                    @can('delete articles')
                                        <a href="javascript:void(0)" onclick="deleteArticle({{ $value->id }})" class="btn btn-danger">Delete</a>    
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif                            
                </tbody>
            </table>

            <div class="my-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
        
@section('customJs')
    <script type="text/javascript">
        function deleteArticle(id) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: '{{ route("articles.destroy") }}',
                    type: 'delete',
                    data: {id:id},
                    dataType: 'json',                    
                    headers: {
                        'x-csrf-token' : '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href="{{ route('articles.index') }}"
                    }
                });
            }
        }
    </script>
@endsection