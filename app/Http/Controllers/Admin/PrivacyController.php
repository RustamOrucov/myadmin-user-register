<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrivacyRequest;
use App\Http\Requests\SettingRequest;
use App\Models\Admin\Privacy;
use App\Models\Admin\Settings;
use App\Services\RepositoryService\PrivacyService;
use App\Services\RepositoryService\SettingsService;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function __construct(protected PrivacyService $service)
    {}


    public function edit(Privacy $privacy)
    {
        $privacies=Privacy::first();
        return view('admin.pages.siteSetting.privacy_index',['model'=>$privacy, 'privacies'=>$privacies]);
    }
    public function update(PrivacyRequest $privacyrequest,Privacy $privacy)
    {

        $this->service->update($privacyrequest,$privacy);
        return redirect()->back()->with('success', 'Update edildi !');
    }
}
