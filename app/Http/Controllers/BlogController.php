<?php

namespace App\Http\Controllers;

use App\Events\BlogPostPublished;
use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\Markdown\Facades\Markdown;

class BlogController extends Controller
{
    private $theme;
    public function __construct()
    {
        $this->theme = resolve('theme');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('themes.'.$this->theme->name.'.index',[
            'blogs' => $blogs,
            'theme'=>$this->theme
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return Redirect(route('blog.index'));
        }

        return view('themes.'.$this->theme->name.'.form',[
            'url'=> route('blog.store'),
            'buttonName'=>'Submit',
            'theme'=>$this->theme
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return Response('Access denied',403);
        }
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()['id'];
        $data['published'] = true;

        $blog = new Blog($data);
        event(new BlogPostPublished($blog));
        $blog->save();

        return Redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blog->body = Markdown::convertToHtml($blog->body);
        return view('themes.'.$this->theme->name.'.show',[
            'blog'=>$blog,
            'theme'=>$this->theme
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        if (!Auth::check()) {
            return Redirect(route('blog.show',$blog->id));
        }
        return view('themes.'.$this->theme->name.'.form',[
            'url'=> route('blog.update', ['id' => $blog->id]),
            'blog' => $blog,
            'buttonName'=>'Update',
            'theme'=>$this->theme
            ]
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return Response('Access denied',403);
        }
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $blog = (new Blog())->find($id);
        $blog->title = $request->get('title');
        $blog->body = $request->get('body');
        $blog->update();

        return Redirect(route('blog.show',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Blog $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if (!Auth::check()) {
            return Response('Access denied',403);
        }
        $blog->delete();
        return Redirect(route('blog.index'));

    }
}
