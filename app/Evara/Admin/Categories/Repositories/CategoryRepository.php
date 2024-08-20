<?php

namespace Evara\Admin\Categories\Repositories;

use Evara\Base\Repositories\Repository;
use Evara\Admin\Categories\Models\Category;

class CategoryRepository extends Repository
{
    public function __construct(Category $category)
    {
        $this->setModel($category);
    }
}
