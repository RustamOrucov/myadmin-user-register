<?php

namespace App\Services\RepositoryService;

use App\Http\Requests\SettingRequest;
use App\Models\Admin\Settings;
use App\Repositories\SettingsRepository;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    protected SettingsRepository $repository;
    protected FileUploadService $fileUploadService;
    public function __construct(SettingsRepository $repository, FileUploadService $fileUploadService)
    {
        $this->repository = $repository;
        $this->fileUploadService = $fileUploadService;
    }
    public static function clearCached()
    {
        Cache::forget('Settings');
    }

    public function dataAllWithPaginate()
    {
        return $this->repository->paginate(10);
    }
    public function store(SettingRequest $request)
    {

        $data = $request->validated();



        if ($request->has('logo')) {
            $data['logo'] = $this->fileUploadService->uploadFile($request->logo, 'Settings');
        }
        if ($request->has('favicon')) {
            $data['favicon'] = $this->fileUploadService->uploadFile($request->favicon, 'Settings');
        }



        $model = $this->repository->save($data, new Settings());

        self::clearCached();

        return $model;
    }
    public function update($request,$model)
    {
        $data=$request->all();


        if ($request->has('logo')) {
            $data['logo'] = $this->fileUploadService->replaceFile($request->logo, $model->logo, 'Settings');
        }
        if ($request->has('favicon')) {
            $data['favicon'] = $this->fileUploadService->replaceFile($request->favicon, $model->favicon, 'Settings');
        }
        $model=$this->repository->save($data,$model);
        self::ClearCached();
        return $model;
    }
}
