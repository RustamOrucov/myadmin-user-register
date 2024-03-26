<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Admin\Blog;
use App\Models\Admin\Category;
use App\Services\RepositoryService\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(protected BlogService $service)
    {}

    public function index()
    {

        $models=$this->service->dataAllWithPaginate();
        return view('admin.pages.blog.index',['models'=>$models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.pages.blog.form',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {

        $this->service->store($request);
        return redirect()->route('blog.index')->with('success', 'Blog uğurla əlavə edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories=Category::all();

        return view('admin.pages.blog.form',['model'=>$blog, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $blogrequest, Blog $blog)
    {

        $this->service->update($blogrequest,$blog);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {

        $this->service->delete($blog);
        return redirect()->route('blog.index')->with('success', 'Blog silindi');
    }
    public function updateStatus(Request $request, $id)
    {

        $model =Blog::findOrFail($id);
        $model->status = $request->status;
        $model->save();
        return response()->json(['message' => 'Status uğurla dəyişdirildi']);
    }
}
