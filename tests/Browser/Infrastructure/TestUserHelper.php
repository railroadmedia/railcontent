<?php

namespace Tests\Browser\Infrastructure;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use Illuminate\Support\Facades\DB;

class TestUserHelper
{
    public array $members;
    public array $plusMembers;
    public array $basicMembers;

    public array $drumeoLTM;
    public array $otherLTM;

    public function __construct()
    {
        //todo: we are testing random user conditions here, this could be improved for long term maintainability
        $this->members = [];
        $this->plusMembers = [];
        $this->basicMembers = [];

        $this->basicMembers[] = 558522; //basic subscription
        $this->plusMembers[] = 515857; //plus subscription
        $this->drumeoLTM[] = 409386; //drumeo lifetime
        $this->otherLTM[] = 366375; //pianote lifetime

        $this->basicMembers = array_merge($this->basicMembers, $this->drumeoLTM, $this->otherLTM);
        $this->members = array_merge($this->basicMembers, $this->plusMembers);
    }
}
