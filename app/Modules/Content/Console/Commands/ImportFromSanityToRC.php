<?php

namespace App\Modules\Content\Console\Commands;

use App\Modules\Content\ApiGateways\SanityGateway;

class ImportFromSanityToRC extends \Illuminate\Console\Command
{
    protected $signature = 'sanity:import-permission-from-sanity {sanityId}';

    protected $description = 'Import Permission from Sanity in DB';

    public function handle(): int
    {
        $id = $this->argument('sanityId');
        try {
            $sanityGateway = app()->make(SanityGateway::class);
            $document      = $sanityGateway->sanity->getDocument($id);
            $lessonType    = $document['_type'];
            if ($lessonType === 'permission') {
                $query = \App\Modules\Content\Models\Permission::query();
                if (isset($document['railcontent_id'])) {
                    $permission = $query->where('id', '=', $document['railcontent_id'])->first();
                } else {
                    $permission = $query->where('name', '=', $document['name'])->first();
                }
                if (!$permission) {
                    $permission = new \App\Modules\Content\Models\Permission();
                }
                $permission->name       = $document['name'];
                $permission->brand      = $document['brand'];
                $permission->sanity_ref = str_replace('drafts.', '', $document['_id']);

                $permission->save();
                $this->info('Permission was synchronized in our Database  :::');
                $this->info( $permission);
                return $permission->id;
            }
        } catch (\Exception $e) {
            dd('Permission was not imported ', $e);
        }
    }
}
