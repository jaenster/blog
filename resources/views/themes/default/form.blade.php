@extends($theme->layout)
@section('content')

    <div class="col-md-8 col-md-offset-2">
        <form method="post" action={{$url}}>
            @if (isset($blog))
                <input type="hidden" name="_method" value="PUT">
            @endif
            <div class="form-group">

                @if ($errors->has('title'))
                    <div class="alert-danger">{{$errors->get('title')[0]}}</div>
                @endif
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{$blog->title or ''}}">

            </div>
            <div class="form-group">

                @if ($errors->has('body'))
                    <div class="alert-danger">{{$errors->get('body')[0]}}</div>
                @endif
                <textarea class="form-control" id="body" name="body" placeholder="Body">{{$blog->body or ''}}</textarea>

            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary">{{$buttonName}}</button>
        </form>
    </div>

    <script>
        document.onreadystatechange = () =>
        {
            if (document.readyState === 'complete') {
                // The page is fully loaded
                console.log("ready!");
                var simplemde = new SimpleMDE({element: document.getElementById("body")});
            }
        }

    </script>

@endsection
