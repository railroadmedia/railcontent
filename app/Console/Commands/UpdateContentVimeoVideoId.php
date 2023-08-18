<?php

namespace App\Console\Commands;

use App\Modules\Content\Models\Content;
use Illuminate\Console\Command;
use Railroad\Railcontent\Services\ContentService;

class UpdateContentVimeoVideoId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:update-vimeo-video-id {--execute}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MT-698: Update the vimeo_video_id of the content specified within this command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ContentService $contentService)
    {
        $simulate = $this->option("execute") == false;
        if ($simulate) {
            $this->info("Executing in simulation mode. No changes will be made to the database.  Use --execute to run for real.");
        }

        $bar = $this->output->createProgressBar(count($this->contentWithValue));
        $bar->start();

        $tableHeaders = ["Content ID", "URL", "New Vimeo ID"];
        $tableRows = [];

        $failed = collect();

        foreach ($this->contentWithValue as $contentId => $value) {
            $content = Content::find($contentId);

            if (is_null($content)) {
                $failed->push($contentId);
                continue;
            }

            $content->vimeo_video_id = $value;

            if (!$simulate) {
                $content->update();
            }

            $tableRows[] = [$contentId, get_musora_brand_base_url() . $content->web_url_path, $value];
            $bar->advance();
        }

       if (!$simulate) {
           // make sure to also rebuild the compiled_view_data for all the content IDs
           $contentService->fillCompiledViewContentDataColumnForContentIds(array_keys($this->contentWithValue));
       }

        $bar->finish();
        $this->newLine();

        $this->table($tableHeaders, $tableRows);

        if ($failed->isNotEmpty()) {
            $this->error("The following content IDs could not be found:");
            $failed->each(fn($id) => $this->error($id));
        }

        return self::SUCCESS;
    }

    // the content id and value to set
    protected array $contentWithValue = [
        197012 =>"DoRhldrWIso",
        197057 =>"ekyiYOt-z_o",
        197063 =>"Jw2SUY_Sx0o",
        197067 =>"a_9WGBRpYs8",
        197069 =>"Du769loNdds",
        197071 =>"JJy7RRpEETk",
        197073 =>"mMtkyxvaEUA",
        197080 =>"Nt2nHac1KVM",
        197088 =>"MUVBIkbw7FU",
        197090 =>"tXe1C7q94ow",
        197409 =>"Fv3ZK--50AI",
        218413 =>"bvF0G9LIVyI",
        222631 =>"y0rJ5G6Yyyg",
        222633 =>"WuJyOW9YYko",
        222636 =>"1KuPEnUIUXM",
        222640 =>"bsdcb-TgmCQ",
        222644 =>"oJndHn1JWz8",
        223157 =>"2pX7gCKhdxI",
        223158 =>"lPZET8JwG88",
        223159 =>"V-ssRY1pG7I",
        223160 =>"qfHIoRTKAOk",
        223161 =>"ogAUWnuY0tM",
        223786 =>"pXhh3zRtMtE",
        223787 =>"8iCQo2AoR7Y",
        223788 =>"OInS-DdaYTY",
        223789 =>"uC6aUV98lZM",
        223790 =>"gUDs844fxs4",
        223791 =>"-i75RPC_Cps",
        224078 =>"ubFpeLUt4W8",
        224079 =>"6PqaZQ5DtVQ",
        224080 =>"Ku2vJCiyqfs",
        224081 =>"lyFTwKHa9wY",
        224082 =>"55VoOnFgqIA",
        224511 =>"bCgW7d3Y-tc",
        224512 =>"YXVyN-oNSo8",
        224513 =>"c0mv8iEv0Dc",
        224514 =>"jvggrIIBDsU",
        224515 =>"Iyh9Jst0tFY",
        224806 =>"a8Tq9y_HfeM",
        224807 =>"AR-qyZOBHjs",
        224808 =>"zEXsg3HI8s8",
        224809 =>"gfRehnAhMK8",
        224810 =>"IRs9VS7TGIE",
        224832 =>"UWkNhe_lPHA",
        224833 =>"SZXJhrpTZs4",
        224834 =>"317X9N4pC5g",
        224835 =>"eYfw3h5x7NQ",
        224836 =>"RijB-cGy1uM",
        224838 =>"48rrBBEJmLQ",
        225404 =>"64Hwl5__XAo",
        225405 =>"jRFtaGCJWA0",
        225406 =>"9w7j7wpXokY",
        225407 =>"vBprQGbEyOQ",
        225408 =>"eHNBkDzZfHw",
        225409 =>"ncXzqiRFFcc",
        225410 =>"NhRDLXuu0jQ",
        226070 =>"fFzOJZVsET0",
        226071 =>"h0wd_hTamME",
        226072 =>"osgflNqABXs",
        226073 =>"XESTk6mBCkU",
        226210 =>"yod2AGZHDnw",
        226391 =>"3aQ7tudcX5s",
        226392 =>"bQ1e0fOBZAk",
        226393 =>"mz-25d1uhQs",
        226394 =>"jRlxKzfZeAY",
        226586 =>"pwhpXcjN8qU",
        226587 =>"o3rwy49ujvc",
        226588 =>"JgwLx5s2Uu0",
        226589 =>"9-dAd3gsKJk",
        226590 =>"9IhdAanRo34",
        226816 =>"iTLWWnNpqHI",
        227141 =>"RhZVAeFKJgw",
        227142 =>"S5GwLiVoCoU",
        227143 =>"pyxKArmb14c",
        227144 =>"poU7n8PAZ5E",
        227145 =>"C8gBKHe5kBQ",
        228536 =>"jCcbQFI-ZjY",
        229191 =>"8-Mvl7P_FZk",
        229192 =>"1BPouyNS6cQ",
        229193 =>"6N87CMlNxiM",
        229194 =>"47nAKrkddng",
        229195 =>"qh-KpJ5VWsU",
        229196 =>"VfcJEX0Ict8",
        229357 =>"bgjPjxjgll4",
        230838 =>"Ja1bCvckY-E",
        230839 =>"pv1Mqo3YqZ8",
        230840 =>"OhA3kON0s3g",
        230843 =>"RKbQ4GRv02w",
        231257 =>"lKjGTti_JDk",
        231258 =>"TsO17a7vAYc",
        231259 =>"WRaglmTg1v4",
        231260 =>"_2qVJynztFQ",
        231261 =>"oK7M95BciBk",
        231262 =>"7PisRulcXkg",
        231385 =>"t40RnGxNYiQ",
        231386 =>"5y0tyQgIMog",
        231387 =>"W1tdn3wOrA8",
        231388 =>"8pFfm1C9Ib4",
        231389 =>"Zs0aCE9z6UU",
        231580 =>"c6GYznZxaVM",
        231581 =>"NqT_tpydIg4",
        231582 =>"ZKc2YHuBPEU",
        231583 =>"1Q5hktxc9Gw",
        231584 =>"3ZUECB13bS0",
        232354 =>"9Ph5TZ3PE9U",
        232355 =>"F6sTmbrBqpQ",
        232356 =>"wDGseCvip0s",
        232357 =>"GefmpJSGc4Q",
        232358 =>"fXXGjnt5MlI",
        232945 =>"e09crXNVOBM",
        233587 =>"nH1XToHo-40",
        233588 =>"mzsKp6WU5Z8",
        233589 =>"iRSfs_FRx5s",
        233590 =>"VZgq3SVjbFg",
        234325 =>"3SD13m0HImA",
        234326 =>"36_Vw03ZemA",
        234817 =>"0wEg7aylwLc",
        234818 =>"VDdXH2F2zm4",
        234819 =>"9kXqqA-qaYA",
        234820 =>"bqfshlcwnAI",
        235192 =>"ubLlZIaTEWk",
        235268 =>"oMC3VSvNsXg",
        235683 =>"4TKQnrgG7ME",
        235684 =>"lFw3uE07VTw",
        235685 =>"ensLDDm7ntY",
        235686 =>"0IPGc66R6Sk",
        235969 =>"bo0hSZojneE",
        236072 =>"ePRdKPgSUrE",
        236073 =>"lAMFV6rW9Fg",
        236074 =>"zjA_I-19eK0",
        236075 =>"MUc5SH5A3dY",
        236076 =>"TSCX6UCp8Iw",
        236647 =>"vEMjgQhQLAg",
        236648 =>"Tg5__L2n1ag",
        236649 =>"FAqSV5-fNx8",
        236650 =>"P6DG91PkmgA",
        237149 =>"ZrruKjvIOL0",
        237150 =>"IZWFIIA4sZw",
        237151 =>"WxNNSU1pKw8",
        238704 =>"9XAyA7VHaNA",
        240333 =>"VyyS1h4n9So",
        240335 =>"qP0A7VWDC2g",
        240336 =>"UAP0WVT8ySs",
        240337 =>"LBfLMprJ71o",
        240642 =>"ytNmbf1U8KE",
        240643 =>"UuEOZrcvkYw",
        240644 =>"5aZQ1SRnx88",
        240645 =>"67uJmJc3v5g",
        241182 =>"RiCYjWjS2-Q",
        241183 =>"b2UDxu676lo",
        241184 =>"RXYpSBbX2MY",
        241185 =>"Ej3lalZgNq4",
        241209 =>"ndJ9565SkgA",
        241210 =>"FF1-aVMZdwA",
        241211 =>"XZDxmcPpofs",
        241212 =>"pTHyqUUKD8Y",
        242639 =>"75XuFJ8Xt64",
        242640 =>"MhHt_OJF1qY",
        242641 =>"W-Xs8WgXg28",
        242642 =>"Jr4g1Qmg90c",
        243108 =>"MnwEzov--_E",
        243352 =>"JZKwmL4Gbjo",
        243353 =>"_dZi_86UF_A",
        243354 =>"xCVbyhXolNQ",
        243355 =>"gTEMb22KQJw",
        244523 =>"q_Yi8dJO5kI",
        244524 =>"05qFEtcsHxc",
        244525 =>"q31s6XQ2SWg",
        244528 =>"NGYk7hlnTn8",
        245307 =>"7n93Mizy3no",
        245465 =>"t5hlgR9FdKM",
        245466 =>"i5auMxjUXDY",
        245467 =>"_454fkq-dtQ",
        245468 =>"OBWsLeSsANc",
        245694 =>"Jf7Mk5Foha4",
        245961 =>"upIqPK7hOEI",
        246179 =>"XKuYQCYZwus",
        246232 =>"qzxWNvtrWFU",
        246233 =>"WUQ2jtxNv_A",
        246234 =>"stopvIggyuc",
        246235 =>"Qf_m_I1POvQ",
        246971 =>"X44AnExtkLY",
        246972 =>"EOxzxRZUE7A",
        246973 =>"3SiXMypR774",
        246974 =>"GTJr7sqJguI",
        247472 =>"5-b0foA81Do",
        247473 =>"ZK82UasHPmo",
        247475 =>"SbvB6_RSEX4",
        247733 =>"8BIcSTUcGL4",
        247734 =>"7NhvI3YydMw",
        247735 =>"3djGkoa_WyA",
        247736 =>"rP86iDYPoco",
        248119 =>"BTQ_RDomuew",
        248120 =>"RJ6dkssJRlw",
        248121 =>"uRBunBgYhOM",
        248122 =>"x_XqR6gYlSE",
        248607 =>"EY3KWN__Szw",
        248609 =>"EZ4B2ZhCvig",
        248610 =>"B4ibQRjEonQ",
        248611 =>"dBM9rbeKIa8",
        248612 =>"rBoDeOkKzCk",
        250086 =>"AAmA0vij5EU",
        250326 =>"Tb9IBg8IBFw",
        250327 =>"KbnQ2Brt0jM",
        250328 =>"OFNlfQUpeVY",
        250329 =>"6Hzr6-fY3jM",
        252420 =>"2n7ufJdtv7M",
        252421 =>"4x_MtTQxN0k",
        252422 =>"icHgSjs_zQI",
        252423 =>"GLWLNMvS4fI",
        253541 =>"j559ZoqVFFQ",
        253542 =>"CrTJ9r4PkGM",
        253543 =>"ZQflnRJiU1c",
        253545 =>"wnHNNKHEsxA",
        255245 =>"SMXSgdkOxOs",
        255246 =>"R3JNWp4MNkQ",
        255247 =>"SG0RqkGvkXc",
        255248 =>"-_1fa03BFU8",
        255249 =>"5AgOeYnJYps",
        255250 =>"Io6lEBXJKG4",
        255251 =>"haqQkFx6Sp0",
        255525 =>"Ts92sKbF4lA",
        255530 =>"OLQllZSXhbo",
        256029 =>"87BiJ1vRLTI",
        256030 =>"EOWXt-8EBpw",
        256031 =>"T8UfECMce0o",
        256032 =>"f3H1VsRwiJk",
        257411 =>"6j6JZzgZW68",
        257412 =>"fva_NjjE8Eg",
        257413 =>"Z7AvnqD37GM",
        257414 =>"9Ezc3MYq58o",
        258572 =>"_HiKtOu_Dlw",
        258576 =>"zxVlQxNmJEk",
        258577 =>"YaEYUibk4zI",
        258578 =>"zIGrQf2pnnw",
        259841 =>"jYkatn1Excg",
        259842 =>"aErUOe_RXOs",
        259843 =>"NsykcmdpE6k",
        259844 =>"QLWxCcJJXqY",
        260818 =>"-wZE91zr3N0",
        262336 =>"5rmnKk3ECW8",
        262338 =>"_GYqsgqhWxA",
        262582 =>"dLgXnrAvS6s",
        262877 =>"ez9xCQH8pC8",
        262878 =>"1UE3sjCeJSA",
        262879 =>"JC3ajwRix9o",
        262881 =>"LVvxhrqxUg8",
        262882 =>"HnAYcAkXHj8",
        262883 =>"jhwwLJhHyLs",
        262884 =>"Z3PmBi35UIo",
        262886 =>"esjQewwoel4",
        262887 =>"4jJagE-_9AE",
        262888 =>"cDtqlFlMOuY",
        262889 =>"2pdL_Iz-2bU",
        262890 =>"Ef3j5ozsIAM",
        263062 =>"_kQSe_NoZYo",
        263619 =>"3VpIRvIMrao",
        263851 =>"Ga3Khep4hkk",
        264108 =>"-p2-H2_5VL0",
        264114 =>"98TDl1Bp_6g",
        264204 =>"rB3Och2J9T8",
        265375 =>"874PBYN4MiI",
        265889 =>"ZeOVPdl0d3M",
        275272 =>"WlkUl3PPcic",
        276762 =>"WD_JaCjxEVA",
        278234 =>"VRRCea0-moU",
        279823 =>"2NHtZQTnjmM",
        286537 =>"OHbEwzf-GTM",
        295600 =>"C5j34F2kSWg",
        295996 =>"eyh_O83pGek",
        296002 =>"jxV1VZxdhjk",
        296006 =>"Exhl99xgwKI",
        298776 =>"So1rXiDZViE",
        300613 =>"6ALTidqezGs",
        302056 =>"_z81O8eX8WM",
        304556 =>"PAu0hJFusuY",
        304613 =>"rIEKmC2w1VQ",
        307204 =>"KQgr_kbQvZY",
        316034 =>"vuAla4Ozq5o",
        323500 =>"b3jtSgQzKo0",
        326617 =>"3hn3NitBemg",
        351721 =>"fmh6Ogel0O4",
    ];
}
