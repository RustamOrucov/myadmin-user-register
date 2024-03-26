<?php

namespace App\Repositories;

use App\Models\Admin\Privacy;
use App\Repositories\Abstract\AbstractRepository;


class PrivacyRepository extends AbstractRepository
{
    protected $modelClass = Privacy::class;
}
