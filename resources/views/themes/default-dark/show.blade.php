@extends($theme->layout)
@section('content')

    <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default panel-dark">
                <div class="panel-heading panel-dark-title">
                    <h2>{{$blog->title}}

                    @if(Auth::check())
                        <a href="{{route('blog_delete',['id' => $blog->id])}}"  class="btn btn-sm btn-danger pull-right">Delete</a>
                        <a href="{{route('blog.edit',['id' => $blog->id])}}"  class="btn btn-sm btn-primary pull-right">Edit</a>
                    @endif
                    </h2>
                </div>
                <div class="panel-body">
                    {!!$blog->body!!}

                </div>
            </div>

    </div>
@endsection