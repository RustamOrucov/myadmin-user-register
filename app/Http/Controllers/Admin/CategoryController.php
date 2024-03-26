<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Admin\Category;
use App\Services\RepositoryService\CategoryService;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function __construct(protected CategoryService $service)
    {}

    public function index()
    {
        $models=$this->service->dataAllWithPaginate();
      return view('admin.pages.category.index',['models'=>$models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.pages.category.form',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $this->service->store($request);
        return redirect()->route('category.index')->with('success', 'Kategorya uğurla əlavə edildi');
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
    public function edit(Category $category)
    {
        $categories=Category::all();
        return view('admin.pages.category.form',['model'=>$category, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $categoryrequest, Category $category)
    {
        $this->service->update($categoryrequest,$category);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $this->service->delete($category);
        return redirect()->route('category.index')->with('success', 'Kategorya silindi');
    }
    public function updateStatus(Request $request, $id)
    {
        $model =Category::findOrFail($id);
        $model->status = $request->status;
        $model->save();
        return response()->json(['message' => 'Status uğurla dəyişdirildi']);
    }
    public function updatefStatus(Request $request, $id)
    {
        $model =Category::findOrFail($id);
        $model->f_status = $request->f_status;
        $model->save();
        return response()->json(['message' => 'Featured Status uğurla dəyişdirildi']);
    }
}
