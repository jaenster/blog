@extends($theme->layout)
@section('content')

    <div class="col-md-8 col-md-offset-2">
    @foreach($blogs as $blog)

            <div class="panel panel-default">
                <div class="panel-heading">{{$blog->title}}</div>
                <div class="panel-body">
                    {{str_limit($blog->body,400,'...')}} <a href="{{route('blog.index')}}/{{$blog->id}}" >read more</a>

                </div>
            </div>

        @endforeach
    </div>
@endsection