<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['index','show']
        ]);
    }

    public function index(Request $request)
    {
        //接受category参数
        $category=$request->query('category');
//        dd($category);
//        /      /latest（），指按最近的顺序排，就是按时间降序
        $articles=Article::latest();
//        dd($articles);
        if($category){
            $articles=$articles->where('category_id',$category);
//            dd($articles);
        }
        $articles=$articles->paginate(10);
        $categories=Category::all();

        return view('home.article.index',compact('articles','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('home.article.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request,Article $article)
    {
        //获取当前登录用户id
        //dd(auth()->id());

        //dd($request->all());
        $article->title=$request->title;
        $article->category_id=$request->category_id;
        $article->content=$request['content'];
        $article->user_id=auth()->id();
        $article->save();
        return redirect()->route('home.article.index')->with('success','文章发布成功');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('home.article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
//      dd('zhe');
        //验证用户信息，知道路由也进不去,这个和模型策略有关系，是在模型策略的基础上建立的
        $this->authorize('update',$article);
//        dd(111);
        $categories=Category::all();

        return view('home.article.edit',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update',$article);
        $article->title=$request->title;
        $article->category_id=$request->category_id;
        $article->content=$request['content'];
        $article->save();
        return redirect()->route('home.article.index')->with('success','文章编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
//        dd(1);

        $this->authorize('delete',$article);
//        dd(1);
        $article->delete();
        return redirect()->route('home.article.index')->with('success','文章删除成功');
    }
}
