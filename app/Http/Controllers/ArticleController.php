<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $newsRepository; 
    private $newsCatRepository; 

    public function __construct(
    NewsRepository $newsRepository,  
    NewsCategoryRepository $newsCatRepository 
    )

    { 
        $this->newsRepository = $newsRepository;
        $this->newsCatRepository = $newsCatRepository;
    }

    public function index()
    {
        $news = $this->newsRepository->get();
        return view("dashboard.article.index", compact("news"));
    }
    public function showByCategory($category_title)
    {
        $category = $this->newsCatRepository->getByTitle($category_title);
        $news = $this->newsRepository->getByCategory($category->id);
        // Footer
        return view("dashboard.article.category", compact("category", "news"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $news = $this->newsRepository->getBySlug($slug);
        $categories = $this->newsCatRepository->get();

        return view("dashboard.article.detail", compact("news", "categories"));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
