<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SettingRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Settings;
use App\Services\RepositoryService\CategoryService;
use App\Services\RepositoryService\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct(protected SettingsService $service)
    {}

    public function store(SettingRequest $request){


        $this->service->store($request);
        return redirect()->route('settings.index');

    }
    public function edit(Settings $setting)
    {
        $settings=Settings::first();
        return view('admin.pages.siteSetting.index',['model'=>$setting, 'settings'=>$settings]);
    }
    public function update(SettingRequest $settingsrequest, Settings $setting)
    {
        $this->service->update($settingsrequest,$setting);
        return redirect()->back()->with('success', 'Update edildi !');
    }
}
