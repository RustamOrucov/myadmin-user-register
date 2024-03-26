<?php

namespace App\Services\RepositoryService;


use App\Http\Requests\PrivacyRequest;
use App\Models\Admin\Privacy;
use App\Repositories\PrivacyRepository;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Cache;

class PrivacyService
{
    protected PrivacyRepository $repository;
    protected FileUploadService $fileUploadService;
    public function __construct(PrivacyRepository $repository, FileUploadService $fileUploadService)
    {
        $this->repository = $repository;
        $this->fileUploadService = $fileUploadService;
    }
    public static function clearCached()
    {
        Cache::forget('Privacy');
    }

    public function dataAllWithPaginate()
    {
        return $this->repository->paginate(10);
    }
    public function store(PrivacyRequest $request)
    {

        $data = $request->validated();

        $model = $this->repository->save($data, new Privacy());

        self::clearCached();

        return $model;
    }
    public function update($request,$model)
    {
        $data=$request->all();

        $model=$this->repository->save($data,$model);
        self::ClearCached();
        return $model;
    }
}
