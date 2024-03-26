<?php

namespace App\Services\RepositoryService;


use App\Http\Requests\BlogRequest;
use App\Models\Admin\Blog;
use App\Repositories\BlogRepository;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class BlogService
{
    protected BlogRepository $repository;
    protected FileUploadService $fileUploadService;

    public function __construct(BlogRepository $repository, FileUploadService $fileUploadService)
    {
        $this->repository = $repository;
        $this->fileUploadService = $fileUploadService;
    }

    public static function clearCached()
    {
        Cache::forget('Blog');
    }

    public function dataAllWithPaginate()
    {
        return $this->repository->paginate(10);
    }

    public function store(BlogRequest $request)
    {

        $data = $request->validated();

        $userId = Auth::id();

        $data['user_id'] = $userId;



        foreach (config('app.languages') as $lang) {

            if (isset($data[$lang])) {

                foreach ($data[$lang] as $key => $name) {
                    $data[$lang]['slug'] = Str::slug($data[$lang]['name']);
                }
            }
        }

        if ($request->has('img')) {
            $data['img'] = $this->fileUploadService->uploadFile($request->img, 'Blog');
        }

        if ($request->has('status')) {
            $data['status'] = $request->input('status') === 'on' ? 1 : 0;
        }
        if ($request->has('f_status')) {
            $data['f_status'] = $request->input('f_status') === 'on' ? 1 : 0;
        }
        if ($request->order == null) {
            $data['order'] = 0;
        }

        $model = $this->repository->save($data, new Blog());
       ;
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

        if ($request->has('img')) {
            $data['img'] = $this->fileUploadService->replaceFile($request->img, $model->img, 'Category');
        }
        $model=$this->repository->save($data,$model);
        self::ClearCached();
        return $model;
    }

}
