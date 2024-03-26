<?php

namespace App\Services\RepositoryService;

use App\Http\Requests\CategoryRequest;
use App\Models\Admin\Category;
use App\Repositories\CategoryRepository;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoryService
{
    protected CategoryRepository $repository;
    protected FileUploadService $fileUploadService;

    public function __construct(CategoryRepository $repository, FileUploadService $fileUploadService)
    {
        $this->repository = $repository;
        $this->fileUploadService = $fileUploadService;
    }

    public static function clearCached()
    {
        Cache::forget('Category');
    }

    public function dataAllWithPaginate()
    {
        return $this->repository->paginate(10);
    }

    public function store(CategoryRequest $request)
    {

        $data = $request->validated();

        foreach (config('app.languages') as $lang) {

            if (isset($data[$lang])) {

                foreach ($data[$lang] as $key => $name) {
                    $data[$lang]['slug'] = Str::slug($data[$lang]['name']);
                }
            }
        }

        if ($request->has('img')) {
            $data['img'] = $this->fileUploadService->uploadFile($request->img, 'Category');
        }

        if ($request->has('status')) {
            $data['status'] = $request->input('status') === 'on' ? 1 : 0;
        }
        if ($request->has('f_status')) {
            $data['f_status'] = $request->input('f_status') === 'on' ? 1 : 0;
        }

        $model = $this->repository->save($data, new Category());

        self::clearCached();

        return $model;
    }
    public function delete($model)
    {
        self::ClearCached();
        return $this->repository->delete($model);
    }
    public function update($request,$model)
    {
        $data=$request->all();
        foreach (config('app.languages') as $lang) {

            if (isset($data[$lang])) {

                foreach ($data[$lang] as $key => $name) {
                    $data[$lang]['slug'] = Str::slug($data[$lang]['name']);
                }
            }
        }

        if ($request->has('status')) {
            $data['status'] = $request->input('status') ? 1 : 0;
        }

        if ($request->has('f_status')) {
            $data['f_status'] = $request->input('f_status') ? 1 : 0;
        }
        if ($request->has('img')) {
            $data['img'] = $this->fileUploadService->replaceFile($request->img, $model->img, 'Category');
        }
        $model=$this->repository->save($data,$model);
        self::ClearCached();
        return $model;
    }
}
