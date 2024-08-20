<?php

namespace Evara\Admin\Brands\Repositories;

use Evara\Admin\Brands\Models\Brand;
use Evara\Base\Repositories\Repository;

class BrandRepository extends Repository
{
    public function __construct(Brand $brand)
    {
        $this->setModel($brand);
    }
}
