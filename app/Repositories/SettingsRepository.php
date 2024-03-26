<?php

namespace App\Repositories;

use App\Models\Admin\Settings;
use App\Repositories\Abstract\AbstractRepository;

class SettingsRepository extends AbstractRepository
{
    protected $modelClass = Settings::class;
}
