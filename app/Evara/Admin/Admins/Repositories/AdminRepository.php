<?php

namespace Evara\Admin\Admins\Repositories;

use Evara\Admin\Admins\Models\Admin;
use Evara\Base\Repositories\Repository;

class AdminRepository extends Repository
{
    public function __construct(Admin $admin)
    {
        $this->setModel($admin);
    }
}
