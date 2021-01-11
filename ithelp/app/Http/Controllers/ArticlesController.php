<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        // $articles = Article::all();
        $articles = Article::orderBy('id', 'desc')->paginate(3);
        return view('articles/index', ['articles' => $articles]);
    }

    public function show($id)
    {
        $article = Article::find($id);
        return view('articles/show', ['article' => $article]);
    }

    public function create()
    {
        return view('articles/create');
    }

    public function store(Request $request)
    {
        $content = $request->validate([
            'title' => 'required',
            'content' => 'required|min:10'
        ]);

         auth()->user()->articles()->create($content);
         return redirect('/')->with('success', '文章新增成功!');
    }

    public function edit($id)
    {
        // $article = Article::find($id);
        $article = auth()->user()->articles->find($id);
        return view('articles/edit', ['article' => $article]);
    }

    public function update(Request $request, $id)
    {
        $article = auth()->user()->articles->find($id);

        $content = $request->validate([
            'title' => 'required',
            'content' => 'required|min:10'
        ]);

        $article->update($content);
        return redirect('/')->with('success', '文章更新成功!');
    }
}
