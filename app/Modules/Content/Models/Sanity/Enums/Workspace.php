<?php

namespace App\Modules\Content\Models\Sanity\Enums;

enum Workspace: string
{
    case Publishing = 'publishing';
    case Marketing = 'marketing';

    public function title(): string
    {
        return ucfirst($this->value)." Workspace";
    }

    public function workspaceName(): string
    {
        return "$this->value-workspace";
    }

    public function basePath(): string
    {
        return "/admin/studio/$this->value";
    }

    public function icon(): string
    {
        // TODO pick real icons
        return match ($this) {
            Workspace::Publishing => 'RobotIcon',
            Workspace::Marketing => 'RocketIcon',
        };
    }
}
