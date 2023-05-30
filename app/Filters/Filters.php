<?php

namespace Config;

use App\Filters\AuthFilter;
use App\Filters\CourseFilter;
use App\Filters\LoginFilter;
use App\Filters\RegFilter;

class Filters extends \CodeIgniter\Filters\Filters
{
    public function __construct()
    {
        $this->aliases['login'] = LoginFilter::class;
        $this->aliases['reguser']=RegFilter::class;
        $this->aliases['auth']=AuthFilter::class;
        $this->aliases['course']=CourseFilter::class;
    }
}
