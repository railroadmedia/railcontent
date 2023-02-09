<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Railroad\Railcontent\Events\ContentCreated;

class UpdateRoutinesFebruary2023 extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'UpdateRoutinesFebruary2023';

    protected $signature = 'UpdateRoutinesFebruary2023';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update routines - February 2023';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting UpdateRoutinesFebruary2023.');
        Log::info('Starting UpdateRoutinesFebruary2023.');

        //update existing routines
        $routineContentRows =
            $this->musoraDB()
                ->from('railcontent_content')
                ->where('type', 'routine')
                ->where('brand', 'singeo')
                ->get();

        foreach ($routineContentRows as $routineContentRow) {
            $this->info('Updating '.$routineContentRow->title);
            Log::info('Updating '.$routineContentRow->title);

            switch ($routineContentRow->slug) {
                case 'transition-routine-for-blenders':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/3d86c3bd-4408-4c53-92e9-b9336db29500/public';
                    break;
                case 'routine-for-no-chest-voice':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/68ec202a-0960-4d57-9095-8ebc9ffc9c00/public';
                    break;
                case 'transition-routine-for-no-chest-voice':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/9e8c201e-1abd-4c65-9dc7-638078189100/public';
                    break;
                case 'routine-for-a-morning-vocal-warm-up':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/9ba275ca-6fe9-4fea-78e8-ee899ec71700/public';
                    break;
                case '5-minute-pitch-training-routine':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/65d682b7-a964-4f9c-50c8-333cbb07f300/public';
                    break;
                case 'routine-for-flippers':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/43a5c877-bfdb-4864-7a16-2777e2dc7b00/public';
                    break;
                case 'routine-for-improving-your-voice':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/c398eedb-2510-42d2-641c-70f04994d600/public';
                    break;
                case 'the-free-voice':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/d2e98ecc-76fd-447e-191d-3a98ac7f2000/public';
                    break;
                case '10-minute-warm-up':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/65986548-63d7-44a2-5695-4e87f8c95200/public';
                    break;
                case 'transition-routine-for-flippers':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/0abedda7-c48c-45b1-1a67-23a029cec700/public';
                    break;
                case 'transition-routine-for-chest-pullers':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/9be4c8c7-dda2-4b6c-d5f9-c7bc0a6af500/public';
                    break;
                case 'full-warm-up-or-cooldown-routine':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/871bd0dc-2b61-4258-4097-abc5dad3ee00/public';
                    break;
                case 'routine-for-a-complete-warm-up':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/6e3f0968-33b7-476d-6994-733b33a71100/public';
                    break;
                case 'routine-for-chest-pullers':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/36839d5b-d2a0-4e97-ff61-4a6de8ce8100/public';
                    break;
                case 'building-balance':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/489e9f97-0d2c-44e3-7425-bd40bdc87400/public';
                    break;
                case 'range-building-routine':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/7052051d-8b6f-488d-0699-72c89d436600/public';
                    break;
                case 'routine-for-blenders':
                    $newThumb =
                        'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/6118caf8-5f96-4ba8-aa8d-db669b730000/public';
                    break;
            }

            if ($newThumb) {
                //set new thumbnail_url
                $this->updateOrInsertAndGetFirst('railcontent_content_data', [
                    'content_id' => $routineContentRow->id,
                    'key' => 'thumbnail_url',
                    'position' => 1,
                ],                               [
                                                     'value' => $newThumb,
                                                 ]);
                event(new ContentCreated($routineContentRow->id));
            }
        }

        $this->info('---------------------------------------------------');
        $this->info('Finished UpdateRoutinesFebruary2023!');
        Log::info('Finished UpdateRoutinesFebruary2023!');

        return true;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return object
     */
    private function updateOrInsertAndGetFirst($table, array $attributes, array $values = [])
    {
        $this->musoraDB()
            ->from($table)
            ->updateOrInsert($attributes, $values);

        return $this->getFirst($table, $attributes, $values);
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return object
     */
    private function getFirst($table, array $attributes)
    {
        return $this->musoraDB()
            ->from($table)
            ->where($attributes)
            ->get()
            ->first();
    }

    private function musoraDB()
    {
        return \DB::connection(config('railcontent.database_connection_name'))
            ->query();
    }
}
