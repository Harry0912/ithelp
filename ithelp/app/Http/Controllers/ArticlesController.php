<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $articles = Article::all();
        return view('articles/index', ['articles' => $articles]);
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
}
