<?php

namespace App\Repositories;

use App\Models\Admin\Blog;
use App\Repositories\Abstract\AbstractRepository;

class BlogRepository extends AbstractRepository

{
    protected $modelClass = Blog::class;
}
