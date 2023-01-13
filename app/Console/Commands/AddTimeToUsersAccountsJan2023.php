<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Ecommerce\Services\AccessCodeService;
use Railroad\Ecommerce\Contracts\UserProviderInterface;
use Railroad\Ecommerce\Services\UserProductService;

class AddTimeToUsersAccountsJan2023 extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'AddTimeToUsersAccountsJan2023';

    protected $signature = 'AddTimeToUsersAccountsJan2023 {arg1} {arg2?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AddTimeToUsersAccountsJan2023';

    const USER_EMAILS_1 = [
        ['order_id' => 360168, 'email' => 'dan.amy.dry@gmail.com'],
        ['order_id' => 360169, 'email' => 'kevanlee932@gmail.com'],
        ['order_id' => 360170, 'email' => 'tilakapash@gmail.com'],
        ['order_id' => 360175, 'email' => 'timothy@bryanjunction.com'],
        ['order_id' => 360179, 'email' => 'martibaig@gmail.com'],
        ['order_id' => 360181, 'email' => 'Aguiart@comcast.net'],
        ['order_id' => 360186, 'email' => 'josephbakerc@gmail.com'],
        ['order_id' => 360189, 'email' => 'photobar@photobar.com'],
        ['order_id' => 360202, 'email' => 'jweaver8@me.com'],
        ['order_id' => 360206, 'email' => 'mitch1498@yahoo.com'],
        ['order_id' => 360210, 'email' => 'planter@live.ca'],
        ['order_id' => 360225, 'email' => 'viljamikemppi@gmail.com'],
        ['order_id' => 360231, 'email' => 'dmckinnell@sasktel.net'],
        ['order_id' => 360236, 'email' => 'alexjnowacki722@gmail.com'],
        ['order_id' => 360238, 'email' => 'victorlopezalonso@gmail.com'],
        ['order_id' => 360244, 'email' => 'greg714ce@gmail.com'],
        ['order_id' => 360259, 'email' => 'a.gabriela.reyna@gmail.com'],
        ['order_id' => 360267, 'email' => 'jasonstelter@yahoo.com'],
        ['order_id' => 360269, 'email' => 'lyuba.tuohy@gmail.com'],
        ['order_id' => 360279, 'email' => 'fahzia@gmail.com'],
        ['order_id' => 360284, 'email' => 'beyer.maggie@gmail.com'],
        ['order_id' => 360290, 'email' => 'arpanroy@hotmail.com'],
        ['order_id' => 360293, 'email' => 'roberthumphrey74@gmail.com'],
        ['order_id' => 360296, 'email' => 'ida.ip@rogers.com'],
        ['order_id' => 360298, 'email' => 'spaskari.primo@gmail.com'],
        ['order_id' => 360306, 'email' => 'marcomaarseveen@hotmail.com'],
        ['order_id' => 360309, 'email' => 'johnfishlock@gmail.com'],
        ['order_id' => 360313, 'email' => 'initaracs@gmail.com'],
        ['order_id' => 360315, 'email' => 'victoriakozack@hotmail.co.uk'],
        ['order_id' => 360322, 'email' => 'kilian.keller@protonmail.com'],
        ['order_id' => 360325, 'email' => 'nadaslaki.istvan@gmail.com'],
        ['order_id' => 360330, 'email' => 'jamesandjean4550@gmail.com'],
        ['order_id' => 360333, 'email' => 'mapor1@gmail.com'],
        ['order_id' => 360336, 'email' => 'jimlaylabrown@gmail.com'],
        ['order_id' => 360337, 'email' => 'bartm04@comcast.net'],
        ['order_id' => 360339, 'email' => 'klaoclurg@gmail.com'],
        ['order_id' => 360341, 'email' => 'adamsila7blitz@gmail.com'],
        ['order_id' => 360343, 'email' => 'paul.gazda@gmail.com'],
        ['order_id' => 360348, 'email' => 'ritacshirley@gmail.com'],
        ['order_id' => 360351, 'email' => 'jmuehl_2000@yahoo.com'],
        ['order_id' => 360354, 'email' => 'yousefkhan93@gmail.com'],
        ['order_id' => 360356, 'email' => 'aleksandra.weglowska94@gmail.com'],
        ['order_id' => 360360, 'email' => 'compagnietheophile@gmail.com'],
        ['order_id' => 360362, 'email' => 'pmgraff@gmail.com'],
        ['order_id' => 360364, 'email' => 'diana.jacota@gmail.com'],
        ['order_id' => 360366, 'email' => 'ruthnahh21@gmail.com'],
        ['order_id' => 360374, 'email' => 'patti.rippe@cinci.rr.com'],
        ['order_id' => 360376, 'email' => 'apelegrati@gmail.com'],
        ['order_id' => 361020, 'email' => 'darrenlee@hotmail.ca'],
        ['order_id' => 361024, 'email' => 'gert.serneels@sekwoja.be'],
        ['order_id' => 361025, 'email' => 'merridyw@yahoo.com'],
        ['order_id' => 361027, 'email' => 'karenstampin@yahoo.com'],
        ['order_id' => 361028, 'email' => 'sarabeecroft@outlook.com'],
        ['order_id' => 361030, 'email' => 'stephedrake@gmail.com'],
        ['order_id' => 361031, 'email' => 'magnussonjarrod@gmail.com'],
        ['order_id' => 361032, 'email' => 'szymon.kadluczka@gmail.com'],
        ['order_id' => 361047, 'email' => 'sadafzekaria@hotmail.com'],
        ['order_id' => 361049, 'email' => 'sebastiangauly@gmail.com'],
        ['order_id' => 361051, 'email' => 'dkuespert@pm.me'],
        ['order_id' => 361054, 'email' => 'mindaugasss777@gmail.com'],
        ['order_id' => 361058, 'email' => 'shreyb28@gmail.com'],
        ['order_id' => 361064, 'email' => 'dmitry.birin@gmail.com'],
        ['order_id' => 361068, 'email' => 'simonjboyes@gmail.com'],
        ['order_id' => 361070, 'email' => 'jacobstanley36@gmail.com'],
        ['order_id' => 361071, 'email' => 'fredrik.hogestol@gmail.com'],
        ['order_id' => 361072, 'email' => 'blake.d.chapman@gmail.com'],
        ['order_id' => 361073, 'email' => 'bernadettekissane@gmail.com'],
        ['order_id' => 361076, 'email' => 'Mefgotoh9@gmail.com'],
        ['order_id' => 361081, 'email' => 'tar_om@hotmail.com'],
        ['order_id' => 361085, 'email' => 'oracles_student@hotmail.com'],
        ['order_id' => 361086, 'email' => 'hotherhoj@gmail.com'],
        ['order_id' => 361091, 'email' => 'michel@sixcubes.com'],
        ['order_id' => 361113, 'email' => 'dx.zone@gmail.com'],
        ['order_id' => 361115, 'email' => 'teheillahrichards@gmail.com'],
        ['order_id' => 361116, 'email' => 'wilskow94@gmail.com'],
        ['order_id' => 361133, 'email' => 'tim.aderhold@online.de'],
        ['order_id' => 361135, 'email' => 'suripolipad@gmail.com'],
        ['order_id' => 361140, 'email' => 'stewart194@gmail.com'],
        ['order_id' => 361145, 'email' => 'lowerts@hotmail.com'],
        ['order_id' => 361150, 'email' => 'jochen.buscher@bluewin.ch'],
        ['order_id' => 361158, 'email' => 'music2@stiegerhs.de'],
        ['order_id' => 361159, 'email' => 'adriandickson@btinternet.com'],
        ['order_id' => 361160, 'email' => 'brian@steamspirit.ca'],
        ['order_id' => 361162, 'email' => 'vrflorez@gmail.com'],
        ['order_id' => 361171, 'email' => 'arnalmary@gmail.com'],
        ['order_id' => 361172, 'email' => 'steveh@gensoftinc.com'],
        ['order_id' => 361177, 'email' => 'rottinghausb@gmail.com'],
        ['order_id' => 361181, 'email' => 'patrick.o\'malley@manchester.ac.uk'],
        ['order_id' => 361182, 'email' => 'janna.baker@gmail.com'],
        ['order_id' => 361188, 'email' => 'mike@aamexperts.com'],
        ['order_id' => 361191, 'email' => 'peterstadnyk@rogers.com'],
        ['order_id' => 361194, 'email' => 'jhomermusic@hotmail.com'],
        ['order_id' => 361202, 'email' => 'karin@bringingjoytotheworld.com'],
        ['order_id' => 361205, 'email' => 'gacciolim@btieng.com'],
        ['order_id' => 361216, 'email' => 'sarahbolocan@gmail.com'],
        ['order_id' => 361217, 'email' => 'to.mattak@gmail.com'],
        ['order_id' => 361218, 'email' => 'rubyinn@3rivers.net'],
        ['order_id' => 361226, 'email' => 'mbenjamincole@gmail.com'],
        ['order_id' => 361231, 'email' => 'sandro.surber@gmail.com'],
        ['order_id' => 361234, 'email' => 'edifarshi@gmail.com'],
        ['order_id' => 361235, 'email' => 'tatarnail@gmail.com'],
        ['order_id' => 361236, 'email' => 'lg1530444@yahoo.com'],
        ['order_id' => 361238, 'email' => 'jose43091@yahoo.com'],
        ['order_id' => 361248, 'email' => 'alreemc@aol.com'],
        ['order_id' => 361252, 'email' => 'shannonmatheny@me.com'],
        ['order_id' => 361254, 'email' => 'sc3brd@gmail.com'],
        ['order_id' => 361259, 'email' => 'phillip.e.bennett@gmail.com'],
        ['order_id' => 361261, 'email' => 'Pennyjang@hotmail.com'],
        ['order_id' => 361264, 'email' => 'chaholl@lineone.net'],
        ['order_id' => 361269, 'email' => 'david@atmaninsurance.com'],
        ['order_id' => 361270, 'email' => 'doug.flescher@gmail.com'],
        ['order_id' => 361271, 'email' => 'ala.kevin@yahoo.com'],
        ['order_id' => 361273, 'email' => 'drsandra@ptcoach.pro'],
        ['order_id' => 361290, 'email' => 'rohankaikini@gmail.com'],
        ['order_id' => 361292, 'email' => 'dkylenix@gmail.com'],
        ['order_id' => 361304, 'email' => 'jyelencich95@gmail.com'],
        ['order_id' => 361306, 'email' => 'becknboboliver@gmail.com'],
        ['order_id' => 361308, 'email' => 'jillxjeffrey@gmail.com'],
        ['order_id' => 361310, 'email' => 'jia.t.shen@gmail.com'],
        ['order_id' => 361322, 'email' => 'melanie.k.cook@gmail.com'],
        ['order_id' => 361325, 'email' => 'denisecarlson28@gmail.com'],
        ['order_id' => 361328, 'email' => 'bdbrunger@gmail.com'], # changed from "bradbrunger@hotmail.com"
        ['order_id' => 361333, 'email' => 'jlangweil@gmail.com'],
        ['order_id' => 361337, 'email' => 'suree011@gmail.com'],
        ['order_id' => 361340, 'email' => 'cbobo010@gmail.com'],
        ['order_id' => 361341, 'email' => 'jenniferfhaynes@bellsouth.net'],
        ['order_id' => 361349, 'email' => 'ishaksue@yahoo.com'],
        ['order_id' => 361350, 'email' => 'cindy.collins55@yahoo.com'],
        ['order_id' => 361352, 'email' => 'katrinacookphd@gmail.com'],
        ['order_id' => 361364, 'email' => 'tsita5746@gmail.com'],
        ['order_id' => 361367, 'email' => 'davidgwood@hotmail.co.uk'],
        ['order_id' => 361373, 'email' => 'thierry.marchetti@gmail.com'],
        ['order_id' => 361383, 'email' => 'bha0669@gmail.com'],
        ['order_id' => 361384, 'email' => 'faye.adegbite@gmail.com'],
        ['order_id' => 361386, 'email' => 'ltyhall@gmail.com'],
        ['order_id' => 361391, 'email' => 'hanna.van.leent@gmail.com'],
        ['order_id' => 361402, 'email' => 'symonirving82@gmail.com'],
        ['order_id' => 361406, 'email' => 'matt.san@gmail.com'],
        ['order_id' => 361414, 'email' => 'mshinge@gmail.com'],
        ['order_id' => 361421, 'email' => 'n.brewer1@btinternet.com'],
        ['order_id' => 361423, 'email' => 'garlande@att.net'],
        ['order_id' => 361424, 'email' => 'pianote@tlgarvin.com'],
        ['order_id' => 361425, 'email' => 'jamesaddison@live.co.uk'],
        ['order_id' => 361431, 'email' => 'philliphewer@sky.com'],
        ['order_id' => 361436, 'email' => 'julia.da.lima@gmail.com'],
        ['order_id' => 361438, 'email' => 'contrailslover@hotmail.com'],
        ['order_id' => 361460, 'email' => 'cekholm46@yahoo.com'],
        ['order_id' => 361464, 'email' => 'alanjohnson07@comcast.net'],
        ['order_id' => 361467, 'email' => 'bari.halag@gmail.com'],
        ['order_id' => 361468, 'email' => 'baltutanoz@gmail.com'],
        ['order_id' => 361471, 'email' => 'youreddy@proton.me'],
        ['order_id' => 361474, 'email' => 'jjs5075@gmail.com'],
        ['order_id' => 361478, 'email' => 'c36debby@gmail.com'],
        ['order_id' => 361479, 'email' => 'paulv80@gmail.com'],
        ['order_id' => 361480, 'email' => 'pragith@gmail.com'],
        ['order_id' => 361482, 'email' => 'scribbla@gmx.com'],
        ['order_id' => 361510, 'email' => 'crepaldicristina8@gmail.com'],
        ['order_id' => 361511, 'email' => 'petestesla316@gmail.com'],
        ['order_id' => 361513, 'email' => 'lomp.karl@gmail.com'],
        ['order_id' => 361521, 'email' => 'janiecjs@aol.com'],
        ['order_id' => 361524, 'email' => 'stevebarrow13@icloud.com'],
        ['order_id' => 361526, 'email' => 'info@mcguireofficial.com'],
        ['order_id' => 361544, 'email' => 'sadhan.srini@gmail.com'],
        ['order_id' => 361554, 'email' => 'josiahjsmith1@gmail.com'],
        ['order_id' => 361556, 'email' => 'jackiehappyservant@yahoo.com'], # order id here is for customer not user though there is a customer for this email
        ['order_id' => 361558, 'email' => 'katyaleake@gmail.com'],
        ['order_id' => 361559, 'email' => 'emsweenie@gmail.com'],
        ['order_id' => 361560, 'email' => 'leeszelam@yahoo.com.hk'],
        ['order_id' => 361562, 'email' => 'andywedsjo@gmail.com'],
        ['order_id' => 361567, 'email' => 'anth707@gmail.com'],
        ['order_id' => 361570, 'email' => 'magnus.janson@hotmail.com'],
        ['order_id' => 361573, 'email' => 'jm110@btinternet.com'],
        ['order_id' => 361575, 'email' => 'andy4c@yahoo.com'],
        ['order_id' => 361584, 'email' => 'hanskleer@shou.es'],
        ['order_id' => 361592, 'email' => 'jennifermbaker52@gmail.com'],
        ['order_id' => 361597, 'email' => 'peter.ross884@gmail.com'],
        ['order_id' => 361614, 'email' => 'mlynchapril@gmail.com'],
        ['order_id' => 361616, 'email' => 'joanan@gmail.com'],
        ['order_id' => 361630, 'email' => 'stephanie.n.vanhook@gmail.com'],
        ['order_id' => 361637, 'email' => 'wieggrefe.helge@hotmail.de'],
        ['order_id' => 361646, 'email' => 'jdeli52@gmail.com'],
        ['order_id' => 361671, 'email' => 'natachalima97@gmail.com'],
        ['order_id' => 361678, 'email' => 'kvannatta@yahoo.com'],
        ['order_id' => 361718, 'email' => 'hillaryv@me.com'],
        ['order_id' => 361733, 'email' => 'egelmers@gmail.com'],
        ['order_id' => 361781, 'email' => 'henry.smith@ymail.com'],
        ['order_id' => 361784, 'email' => 'jeff@donnici.com'],
        ['order_id' => 361803, 'email' => 'manifestblessings.mw@gmail.com'],
        ['order_id' => 361805, 'email' => 'crholderfield65@gmail.com'],
        ['order_id' => 361855, 'email' => 'essybend@gmail.com'],
        ['order_id' => 361865, 'email' => 'essybend@gmail.com'],
        ['order_id' => 361872, 'email' => 'hoque.rashed@gmail.com'],
        ['order_id' => 361883, 'email' => 'ian.crawford4@gmail.com'],
        ['order_id' => 361890, 'email' => 'bunnie1177@gmail.com'],
        ['order_id' => 361986, 'email' => 'kc24610@gmail.com'],
        ['order_id' => 361999, 'email' => 'Chris@breakfastwith.coffee'],
        ['order_id' => 362000, 'email' => 'vjgrant@verizon.net'],
        ['order_id' => 362088, 'email' => 'bljankowski@gmail.com'],
        ['order_id' => 362270, 'email' => 'ldparet@mac.com'],
        ['order_id' => 362318, 'email' => 'Chanunporn.p@gmail.com'],
        ['order_id' => 362379, 'email' => 'jyoungmet@gmail.com'],
        ['order_id' => 362502, 'email' => 'mbartholome@ifm1.com'],
        ['order_id' => 362623, 'email' => 'walk2bfit@aol.com'],
        ['order_id' => 362744, 'email' => 'suelhenning@yahoo.com'],
        ['order_id' => 362792, 'email' => 'kyleernewein@gmail.com'],
        ['order_id' => 362848, 'email' => 'middlespace@outlook.com'],
        ['order_id' => 362869, 'email' => 'jebarrett415@gmail.com'],
        ['order_id' => 362890, 'email' => 'superjbarbier@gmail.com'],
        ['order_id' => 362906, 'email' => 't.malo@shaw.ca'],
        ['order_id' => 362916, 'email' => 'john.netzel@gmail.com'],
        ['order_id' => 362953, 'email' => 'jesus@antoniogutierrez.me'],
        ['order_id' => 362964, 'email' => 'ryanbalkcom@gmail.com'],
        ['order_id' => 362970, 'email' => 'matose@comcast.net'],
        ['order_id' => 362976, 'email' => 'kpmail@cox.net'],
        ['order_id' => 363047, 'email' => 'NightPhoenix187@gmail.com'],
        ['order_id' => 363134, 'email' => 'hieuleuk@gmail.com'],
        ['order_id' => 363140, 'email' => 'amandadavey090@gmail.com'],
        ['order_id' => 363160, 'email' => 'fhenderson@comcast.net'],
        ['order_id' => 363161, 'email' => 'cheers_st@yahoo.com'],
        ['order_id' => 363164, 'email' => 'clionanolan@gmail.com'],
        ['order_id' => 363208, 'email' => 'sidebar123@aol.com'],
        ['order_id' => 363220, 'email' => 'davedaniel@mac.com'],
        ['order_id' => 363291, 'email' => 'jane.anne.boon@gmail.com'],
        ['order_id' => 363301, 'email' => 'akushalnikova@gmail.com'],
        ['order_id' => 363303, 'email' => 'frederic@sarlin.net'],
        ['order_id' => 363320, 'email' => 'proeme@sbcglobal.net'],
        ['order_id' => 363327, 'email' => 'pianobevdavis@gmail.com'],
        ['order_id' => 363331, 'email' => 'missny128@yahoo.com'],
        ['order_id' => 363354, 'email' => 'Michelle_mcclean@yahoo.com'],
        ['order_id' => 363355, 'email' => 'timsell@yahoo.com'],
        ['order_id' => 363367, 'email' => 'sandy.hayes1122@gmail.com'],
        ['order_id' => 363378, 'email' => 'quencesqin@gmail.com'],
        ['order_id' => 363392, 'email' => 'klas.nederman@gmail.com'],
        ['order_id' => 363460, 'email' => 'jinyangxue1993@gmail.com'],
        ['order_id' => 363471, 'email' => 'tpm321@yahoo.com'],
        ['order_id' => 363473, 'email' => 'kelly.organize@gmail.com'],
        ['order_id' => 363482, 'email' => 'djwhitneyvo@gmail.com'],
        ['order_id' => 363492, 'email' => 'jopro1987@gmail.com'],
        ['order_id' => 363504, 'email' => 'cortez57h@gmail.com'],
        ['order_id' => 363512, 'email' => 'debrajhouston@cruzio.com'],
        ['order_id' => 363520, 'email' => 'joefmoriarty@gmail.com'],
        ['order_id' => 363534, 'email' => 'erin.r.gerber@gmail.com'],
        # ['order_id' => 363882, 'email' => 'WingsAsEagles83@Yahoo.com'], # removed because Customer not User
        ['order_id' => 363927, 'email' => 'nicole.g.fiore@gmail.com'],
        ['order_id' => 363949, 'email' => 'lizccdoherty@gmail.com'],
        # ['order_id' => 363959, 'email' => 'bae061778@yahoo.com'],  # removed because Customer not User
        ['order_id' => 363982, 'email' => 'tedthlee@gmail.com'],
        ['order_id' => 364008, 'email' => 'Christina.aladro@yahoo.com'],
        ['order_id' => 364037, 'email' => 'stella.stewart@sympatico.ca'],
        ['order_id' => 364042, 'email' => 'sharvesh0306@gmail.com'],
        ['order_id' => 364097, 'email' => 'cjohnson1899@gmail.com'],
        ['order_id' => 364147, 'email' => 'lh_yee@hotmail.com'],
        ['order_id' => 364288, 'email' => 'rrsertorres@yahoo.com'],
        ['order_id' => 364297, 'email' => 'smileyrlw@gmail.com'],
        ['order_id' => 364318, 'email' => 'joansimpson1@verizon.net'],
        ['order_id' => 364325, 'email' => 'annsunh@gmail.com'],
        ['order_id' => 364399, 'email' => 'mailnacosie@gmail.com'],
        ['order_id' => 364420, 'email' => 'mariongsmith7@gmail.com'],
        ['order_id' => 364468, 'email' => 'mechthild.flohr@web.de'],
        ['order_id' => 364475, 'email' => 'brianulmer@gmail.com'],
        ['order_id' => 364513, 'email' => 'diggerdelt1978@gmail.com'], # changed from ianweldele@gmail.com
        ['order_id' => 364589, 'email' => 'jcsady@gmail.com'],
        ['order_id' => 364591, 'email' => 'jaydawesome96@gmail.com'],
        ['order_id' => 364595, 'email' => 'ldrakeh@gmail.com'],
        ['order_id' => 364616, 'email' => 'nicolastautiva@hotmail.com'],
        ['order_id' => 364639, 'email' => 'karina.amorym@gmail.com'],
        ['order_id' => 364644, 'email' => 'philipplakas@yahoo.com'],
        ['order_id' => 364700, 'email' => 'snavenehpets@gmail.com'],
        # ['order_id' => 364791, 'email' => 'dorothymorse@yahoo.com'], # removed because Customer not User
        ['order_id' => 364818, 'email' => 'freyagabriel84@gmail.com'],
        ['order_id' => 364936, 'email' => 'kcarmody02@gmail.com'],
        ['order_id' => 365103, 'email' => 'pianokeys09@yahoo.com'], # order id here is for customer not user though there is a customer for this email
    ];

    const USER_EMAILS_2 = [
        ['order_id' => 362272, 'email' => 'sanfranman242001@yahoo.com'],
        ['order_id' => 362744, 'email' => 'suelhenning@yahoo.com'],
        ['order_id' => 363047, 'email' => 'NightPhoenix187@gmail.com'],
        ['order_id' => 363140, 'email' => 'amandadavey090@gmail.com'],
        ['order_id' => 363160, 'email' => 'fhenderson@comcast.net'],
        ['order_id' => 363220, 'email' => 'davedaniel@mac.com'],
        ['order_id' => 363355, 'email' => 'timsell@yahoo.com'],
        ['order_id' => 364639, 'email' => 'karina.amorym@gmail.com'],
        ['order_id' => 364936, 'email' => 'kcarmody02@gmail.com'],
        ['order_id' => 366220, 'email' => 'hybiscus_1@hotmail.com'],
        ['order_id' => 367350, 'email' => 'zshah3984@gmail.com'],
        ['order_id' => 367380, 'email' => 'sunflowersandy@hotmail.com'],
        ['order_id' => 367386, 'email' => 'pcard@bell.net'],
        ['order_id' => 367391, 'email' => 'martbens382@gmail.com'],
        ['order_id' => 367417, 'email' => 'dav.alemany@gmail.com'],
        ['order_id' => 367422, 'email' => 'agbelanger1@gmail.com'],
        ['order_id' => 367444, 'email' => 'jasonpzimmermann@gmail.com'],
        ['order_id' => 367450, 'email' => 'ripley.jessicalane@gmail.com'],
        ['order_id' => 367458, 'email' => 'jleon666@mac.com'],
        ['order_id' => 367460, 'email' => 'lareidster@gmail.com'],
        ['order_id' => 367470, 'email' => 'roman.gross27@gmail.com'],
        ['order_id' => 367475, 'email' => 'natemillervt@gmail.com'],
        ['order_id' => 367495, 'email' => 'thomasshwong@gmail.com'],
        ['order_id' => 367499, 'email' => 'thongtap@hotmail.com'],
        ['order_id' => 367507, 'email' => 'iamprtj@me.com'],
        ['order_id' => 367521, 'email' => 'markbonaccorso@hotmail.com'],
        ['order_id' => 367539, 'email' => 'woodukeep@gmail.com'],
        ['order_id' => 367567, 'email' => 'XmasPiano22@gmail.com'],
        ['order_id' => 367568, 'email' => 'jstat1@icloud.com'],
        ['order_id' => 367572, 'email' => 'nelsonb8023@gmail.com'],
        ['order_id' => 367582, 'email' => 'jbaldwin@nowpt.com'],
        ['order_id' => 367589, 'email' => 'sicelyc@yahoo.com'],
        ['order_id' => 367601, 'email' => 'sbussom@gmail.com'],
        ['order_id' => 367616, 'email' => 'nithuairisg.sile@yahoo.ie'],
        ['order_id' => 367617, 'email' => 'm.rodrigues2325@gmail.com'],
        ['order_id' => 367621, 'email' => 'sjweekers7@gmail.com'],
        ['order_id' => 367628, 'email' => 'svadavon@gmail.com'],
        ['order_id' => 367629, 'email' => 'ma.cristinaborromeo@yahoo.com'],
        ['order_id' => 367636, 'email' => 'alina.danilevich.pl@gmail.com'],
        ['order_id' => 367643, 'email' => 'aosetvilanova@gmail.com'],
        ['order_id' => 367653, 'email' => 'solmodid26@gmail.com'],
        ['order_id' => 367655, 'email' => 'apndepree@gmail.com'],
        ['order_id' => 367670, 'email' => 'rcamel18@comcast.net'],
        ['order_id' => 367715, 'email' => 'meganisaac8@gmail.com'],
        ['order_id' => 367742, 'email' => 'jkimkim@hotmail.com'],
        ['order_id' => 367747, 'email' => 'megcrad@gmail.com'],
        ['order_id' => 367752, 'email' => 'jasen.carroll29@gmail.com'],
        ['order_id' => 367767, 'email' => 'ethanyhowden2@gmail.com'],
        ['order_id' => 367768, 'email' => 'mccarten@suddenlink.net'],
        ['order_id' => 367771, 'email' => 'emunoz.26@gmail.com'],
        ['order_id' => 367776, 'email' => 'kiddedios@yahoo.com'],
        ['order_id' => 367777, 'email' => 'htown_matty@hotmail.com'],
        ['order_id' => 367782, 'email' => 'justinhillpac@gmail.com'],
        ['order_id' => 367790, 'email' => 'rr.alexander@yahoo.com'],
        ['order_id' => 367800, 'email' => 'timothylaplaca@gmail.com'],
        ['order_id' => 367807, 'email' => 'boopthyfloof@gmail.com'],
        ['order_id' => 367827, 'email' => 'aba@dadlnet.dk'],
        ['order_id' => 367848, 'email' => 'johnnykamprath@gmail.com'],
        ['order_id' => 367854, 'email' => 'kokyoung@gmail.com'],
        ['order_id' => 367858, 'email' => 'mona.heggem@gmail.com'],
        ['order_id' => 367875, 'email' => 'nicolejohnson33@yahoo.com'],
        ['order_id' => 367902, 'email' => 'kassi.brent@hotmail.com'],
        ['order_id' => 367907, 'email' => 'bwstevenson@gmail.com'],
        ['order_id' => 367918, 'email' => 'jeanne@mjandersen.com'],
        ['order_id' => 367921, 'email' => 'waptaszek@gmail.com'],
        ['order_id' => 367929, 'email' => 'mattsjerseygirl@outlook.com'],
        ['order_id' => 367941, 'email' => 'Manska2@gmail.com'],
        ['order_id' => 367959, 'email' => 'melanie.houle@hotmail.fr'],
        ['order_id' => 367978, 'email' => 'hirstfam5@gmail.com'],
        ['order_id' => 367983, 'email' => 'jcowens24@gmail.com'],
        ['order_id' => 367991, 'email' => 'jemmavine@hotmail.com'],
        ['order_id' => 368005, 'email' => 'haddadleann@gmail.com'],
        ['order_id' => 368015, 'email' => 'apedrazap@icloud.com'],
        ['order_id' => 368023, 'email' => 'steven.dombek@gmail.com'],
        ['order_id' => 368032, 'email' => 'vshargorodska@gmail.com'],
        ['order_id' => 368033, 'email' => 'cubfan8@comcast.net'],
        ['order_id' => 368037, 'email' => 'jameshunter00@gmail.com'],
        ['order_id' => 368041, 'email' => 'jsantia27@yahoo.com'],
        ['order_id' => 368045, 'email' => 'joycetomiko@gmail.com'],
        ['order_id' => 368053, 'email' => 'me@daveharrison.com'],
        ['order_id' => 368064, 'email' => 'maxime_cotte@hotmail.com'],
        ['order_id' => 368075, 'email' => 'hubertus@sachsen-coburg-gotha.de'],
        ['order_id' => 368097, 'email' => 'tdistad@yahoo.com'],
        ['order_id' => 368099, 'email' => 'vignesh.g.shankar@gmail.com'],
        ['order_id' => 368103, 'email' => 'tomas.foldi@gmail.com'],
        ['order_id' => 368123, 'email' => 'jkm7c4@gmail.com'],
        ['order_id' => 368127, 'email' => 'donna@nexthomebydonna.com'], # changed from jimchabrier@gmail.com
        ['order_id' => 368129, 'email' => 'kaplan.inna@gmail.com'],
        ['order_id' => 368139, 'email' => 'benja.beckman@gmail.com'],
        ['order_id' => 368150, 'email' => 'pnuren@gmail.com'],
        ['order_id' => 368152, 'email' => 'radinsalehi@gmail.com'],
        ['order_id' => 368160, 'email' => 'kelstun@gmail.com'],
        ['order_id' => 368166, 'email' => 'e.vanark@bernhoven.nl'],
        ['order_id' => 368186, 'email' => 'kathryn.wilwohl@gmail.com'],
        ['order_id' => 368188, 'email' => 'laurieknopp@gmail.com'],
        ['order_id' => 368191, 'email' => 'nesmahas@gmail.com'],
        ['order_id' => 368194, 'email' => 'slbrantley@gmail.com'],
        ['order_id' => 368198, 'email' => 'gbeck1963@yahoo.com'],
        ['order_id' => 368211, 'email' => 'pianomusic2022@protonmail.com'],
        ['order_id' => 368245, 'email' => 'YRideaux@sbcglobal.net'],
        ['order_id' => 368249, 'email' => 'joanneomalley@bigpond.com'],
        ['order_id' => 368276, 'email' => 'sbrowning@visionquestit.com'], # changed from abrowning@visionquestit.com
        ['order_id' => 368279, 'email' => 'wooine2@gmail.com'],
        ['order_id' => 368283, 'email' => 'heikel.khaldi1@gmail.com'],
        ['order_id' => 368287, 'email' => 'romain.maurer@gmail.com'],
        ['order_id' => 368290, 'email' => 'cherylhatch1@gmail.com'],
        ['order_id' => 368298, 'email' => 'sibasish.panigrahi2001@gmail.com'],
        ['order_id' => 368304, 'email' => 'ashleigh.randall@hotmail.com'],
        ['order_id' => 368309, 'email' => 'gmros79@gmail.com'],
        ['order_id' => 368312, 'email' => 'kerryswarbrick@outlook.com'],
        ['order_id' => 368314, 'email' => 'nchaix@hotmail.com'],
        ['order_id' => 368328, 'email' => 'maharshi1025@gmail.com'],
        ['order_id' => 368333, 'email' => 'bruno.wieckowski@free.fr'],
        ['order_id' => 368341, 'email' => 'gordon.johns@outlook.com'],
        ['order_id' => 368353, 'email' => 'pragith@gmail.com'],
        ['order_id' => 368359, 'email' => 'pragith@gmail.com'],
        ['order_id' => 368360, 'email' => 'dapwill@gmail.com'],
        ['order_id' => 368362, 'email' => 'salvocretella92@gmail.com'],
        ['order_id' => 368369, 'email' => 'gauravrocks182@gmail.com'],
        ['order_id' => 368370, 'email' => 'd.misjak@gmail.com'],
        ['order_id' => 368380, 'email' => 'arlmelody@yahoo.com'],
        ['order_id' => 368386, 'email' => 'the4murrays@me.com'],
        ['order_id' => 368389, 'email' => 'shannoncoakleyramsey@gmail.com'],
        ['order_id' => 368392, 'email' => 'khorvat1029@gmail.com'],
        ['order_id' => 368395, 'email' => 'esaidi1109@hotmail.com'],
        ['order_id' => 368402, 'email' => 'Lauraheathergrout@gmail.com'],
        ['order_id' => 368418, 'email' => 'colinjherbst@gmail.com'],
        ['order_id' => 368421, 'email' => 'linda.dayton@sbcglobal.net'],
        ['order_id' => 368429, 'email' => 'tony.bannister@sky.com'],
        ['order_id' => 368431, 'email' => 'adjc70@gmail.com'],
        ['order_id' => 368434, 'email' => 'lisetteboekingen@gmail.com'],
        ['order_id' => 368435, 'email' => 'mccarthy.marcy3@gmail.com'],
        ['order_id' => 368440, 'email' => 'olivier.larochelle@hotmail.com'],
        ['order_id' => 368451, 'email' => 'camd1081@icloud.com'],
        ['order_id' => 368452, 'email' => 'ivarsselickis@gmail.com'],
        ['order_id' => 368454, 'email' => 'mdreap@swbell.net'],
        ['order_id' => 368456, 'email' => 'ryanschutt@hotmail.com'],
        ['order_id' => 368459, 'email' => 'donjuneveslage@gmail.com'],
        ['order_id' => 368460, 'email' => 'jgklapp@sbcglobal.net'],
        ['order_id' => 368504, 'email' => 'ldean1016@gmail.com'],
        ['order_id' => 368505, 'email' => 'repmis4@bigpond.com'],
        ['order_id' => 368515, 'email' => 'massiemark3@gmail.com'],
        ['order_id' => 368516, 'email' => 'gideonk@alumni.unc.edu'],
        ['order_id' => 368518, 'email' => 'mike@rawhorizons.com'],
        ['order_id' => 368520, 'email' => 'cherriemendoza@gmail.com'],
        ['order_id' => 368527, 'email' => 'scotgraham@bendcable.com'],
        ['order_id' => 368529, 'email' => 'hcarr78537@hotmail.com'],
        ['order_id' => 368531, 'email' => 'mayowababatunde@yahoo.com'],
        ['order_id' => 368534, 'email' => 'appy@tuta.io'],
        ['order_id' => 368542, 'email' => 'BLACKROSEBILLY2010@YAHOO.COM'],
        ['order_id' => 368546, 'email' => 'jeff@jeffreynbrown.com'],
        ['order_id' => 368548, 'email' => 'gopalkesavan@gmail.com'],
        ['order_id' => 368551, 'email' => 'lfwhit@gmail.com'],
        ['order_id' => 368553, 'email' => 'maveneracion@gmail.com'],
        ['order_id' => 368585, 'email' => 'alex.bolkhovsky@yahoo.com'],
        ['order_id' => 368588, 'email' => 'ianbennett45@yahoo.co.uk'],
        ['order_id' => 368594, 'email' => 'slcamille0609@gmail.com'],
        ['order_id' => 368614, 'email' => 'wlauer@gmx.net'],
        ['order_id' => 368618, 'email' => 'naver3921@gmail.com'],
        ['order_id' => 368619, 'email' => 'emmylou317@hotmail.com'],
        ['order_id' => 368621, 'email' => 'phyvitou@gmail.com'],
        ['order_id' => 368626, 'email' => 'fifteenoff30@yahoo.com'],
        ['order_id' => 368631, 'email' => 'siacmillerb@gmail.com'],
        ['order_id' => 368632, 'email' => 'siacmillerbh@gmail.com'],
        ['order_id' => 368636, 'email' => 'rozkim@gmail.com'],
        ['order_id' => 368645, 'email' => 'sinkovics.mark@gmail.com'],
        ['order_id' => 368648, 'email' => 'sylvio.ran@gmail.com'],
        ['order_id' => 368653, 'email' => 'corinne.creagmile@gmail.com'],
        ['order_id' => 368678, 'email' => 'sailorhiker@gmail.com'],
        ['order_id' => 368683, 'email' => 'jwhelan2006@yahoo.com'],
        ['order_id' => 368684, 'email' => 'anja@sch00n.de'],
        ['order_id' => 368687, 'email' => 'koch.andras@hotmail.com'],
        ['order_id' => 368691, 'email' => 'robertbroersma@gmail.com'],
        ['order_id' => 368695, 'email' => 'brian.bruschke@gmail.com'],
        ['order_id' => 368700, 'email' => 'chris.quinn.trank@gmail.com'],
        ['order_id' => 368703, 'email' => 'carlymd@aol.com'],
        ['order_id' => 368707, 'email' => 'kristoffercrosby@gmail.com'],
        ['order_id' => 368708, 'email' => 'hannes.sobitsch@outlook.com'],
        ['order_id' => 368716, 'email' => 'cantstaymadatyousandwich@gmail.com'],
        ['order_id' => 368727, 'email' => 'ronsanchez@live.com'],
        ['order_id' => 368728, 'email' => 'theflojam@gmail.com'],
        ['order_id' => 368732, 'email' => 'iachiritescu@gmail.com'],
        ['order_id' => 368735, 'email' => 'hannahcjoiner@gmail.com'],
        ['order_id' => 368742, 'email' => 'samanthambarnes@gmail.com'],
        ['order_id' => 368744, 'email' => 'mandy@davidhol.com'],
        ['order_id' => 368745, 'email' => 'bobgannon77@gmail.com'],
        ['order_id' => 368765, 'email' => 'jpschluter@gmail.com'],
        ['order_id' => 368767, 'email' => 'jim@thetyreefamily.net'],
        ['order_id' => 368779, 'email' => 'alex@barkaloff.com'],
        ['order_id' => 368781, 'email' => 'wipf01@yahoo.com'],
        ['order_id' => 368782, 'email' => 'karl.vandenbosch@hotmail.be'],
        ['order_id' => 368783, 'email' => 'richard.starr57@charter.net'],
        ['order_id' => 368797, 'email' => 'ajszabados@gmail.com'],
        ['order_id' => 368799, 'email' => 'mikeaarmstrong@gmail.com'],
        ['order_id' => 368800, 'email' => 'aamal.hussain@hotmail.com'],
        ['order_id' => 368804, 'email' => 'bryanoost@gmail.com'],
        ['order_id' => 368817, 'email' => 'kennec31@tcd.ie'],
        ['order_id' => 368820, 'email' => 'Scottedwardmitchell@gmail.com'],
        ['order_id' => 368822, 'email' => 'danahunterjames@gmail.com'],
        ['order_id' => 368827, 'email' => 'wmblakely@gmail.com'],
        ['order_id' => 368829, 'email' => 'carrilloangel6317@yahoo.com'],
        ['order_id' => 368831, 'email' => 'tompkinseric@gmail.com'],
        ['order_id' => 368834, 'email' => 'M.turbeville23@gmail.com'],
        ['order_id' => 368838, 'email' => 'chizue51@yahoo.com'],
        ['order_id' => 368841, 'email' => 'josh@tradesmartu.com'],
        ['order_id' => 368846, 'email' => 'mckbigmac@hotmail.com'],
        ['order_id' => 368850, 'email' => 'asvnag@optusnet.com.au'],
        ['order_id' => 368873, 'email' => 'hockeyhouse242@outlook.com'],
        ['order_id' => 368875, 'email' => 'stevenvaughan.sv@gmail.com'],
        ['order_id' => 368885, 'email' => 'greg.nordstrom@gmail.com'],
        ['order_id' => 368887, 'email' => 'brycemarton9@gmail.com'],
        ['order_id' => 368890, 'email' => 'thestacespace@gmail.com'],
        ['order_id' => 368891, 'email' => 'jksnhts@gmail.com'],
        ['order_id' => 368903, 'email' => 'alec.a.buck@gmail.com'],
        ['order_id' => 368907, 'email' => 'julietacrvnts@yahoo.com'],
        ['order_id' => 368908, 'email' => 'ajwizard04@gmail.com'],
        ['order_id' => 368918, 'email' => 'slamon5@telus.net'],
        ['order_id' => 368920, 'email' => 'grilo_joe@yahoo.com'],
        ['order_id' => 368926, 'email' => 'christinemmecham@gmail.com'],
        ['order_id' => 368927, 'email' => 'sulognac24@gmail.com'],
        ['order_id' => 368954, 'email' => 'lee.davie@mailable.co.uk'],
        ['order_id' => 368955, 'email' => 'andytorbet@gmail.com'],
        ['order_id' => 368957, 'email' => 'preis.nuno@gmail.com'],
        ['order_id' => 368972, 'email' => 'n@ns.sbs'],
        ['order_id' => 368980, 'email' => 'anicoolattitude@gmail.com'],
        ['order_id' => 368981, 'email' => 'jonathan_key@yahoo.com'],
        ['order_id' => 369002, 'email' => 'ahlstrom.peter@gmail.com'],
        ['order_id' => 369005, 'email' => 'declan.mountford@gmail.com'],
        ['order_id' => 369007, 'email' => 'nonnaporter@gmail.com'],
        ['order_id' => 369008, 'email' => 'baillie.derek@gmail.com'],
        ['order_id' => 369016, 'email' => 'dianelongman@yahoo.com'],
        ['order_id' => 369023, 'email' => 'nchoin@yahoo.com'],
        ['order_id' => 369031, 'email' => 'Jossgw2@gmail.com'],
        ['order_id' => 369037, 'email' => 'garyrj1987@icloud.com'],
        ['order_id' => 369041, 'email' => 'conn.george22@gmail.com'],
        ['order_id' => 369048, 'email' => 'sakamo94@qq.com'],
        ['order_id' => 369053, 'email' => 'larryrouthe@gmail.com'],
        ['order_id' => 369060, 'email' => 'waldiedb@gmail.com'],
        ['order_id' => 369080, 'email' => 'debrafbaker@gmail.com'],
        ['order_id' => 369083, 'email' => 'brenda@brendavansickle.com'], # changed from "brenda@brendavansickle.comq" because that was obviously a typo
        ['order_id' => 369099, 'email' => 'sissylulubeans@icloud.com'],
        ['order_id' => 369110, 'email' => 'sangprad@gmail.com'],
        ['order_id' => 369113, 'email' => 'dfoxmd1215@verizon.net'],
        ['order_id' => 369116, 'email' => 'onsteinig@gmail.com'],
        ['order_id' => 369121, 'email' => 'gareth@specialityoxygen.co.uk'],
        ['order_id' => 369124, 'email' => 'neysaserrano@gmail.com'],
        ['order_id' => 369132, 'email' => 'zee.edwin@gmail.com'],
        ['order_id' => 369138, 'email' => 'inocent_fr@yahoo.fr'],
        ['order_id' => 369149, 'email' => 'Chalmein@cox.net'],
        ['order_id' => 369150, 'email' => 'chenxiang.a.zhang@gmail.com'],
        ['order_id' => 369154, 'email' => 'ceasarlomomusic@gmail.com'],
        ['order_id' => 369158, 'email' => 'achraf.n@conciseconsulting.net'],
        ['order_id' => 369160, 'email' => 'x@ijsf.nl'],
        ['order_id' => 369164, 'email' => 'diegofrancisco.guerzoni@gmail.com'],
        ['order_id' => 369166, 'email' => 'kerry@pierremusic.org'],
        ['order_id' => 369180, 'email' => 'newness-sandlot.0o@icloud.com'],
        ['order_id' => 369184, 'email' => 'ctfaris@gmail.com'],
        ['order_id' => 369187, 'email' => 'qldsafari@aol.com'],
        ['order_id' => 369191, 'email' => 'esstatebeats@gmail.com'],
        ['order_id' => 369197, 'email' => 'hamza91394@gmail.com'],
        ['order_id' => 369201, 'email' => 'fortnitelegends203@gmail.com'],
        ['order_id' => 369202, 'email' => '91.sudha@gmail.com'],
        ['order_id' => 369214, 'email' => 'maite1hin@yahoo.com'],
        ['order_id' => 369216, 'email' => 'jeffslomba@gmail.com'],
        ['order_id' => 369218, 'email' => 'a_lytan@yahoo.com'],
        ['order_id' => 369223, 'email' => 'helenemateer@gmail.com'],
        ['order_id' => 369239, 'email' => 'claudia.wiefler@hotmail.com'],
        ['order_id' => 369241, 'email' => 'henryslogin@gmail.com'],
        ['order_id' => 369245, 'email' => 'richard.frolkovic@gmail.com'],
        ['order_id' => 369246, 'email' => 'fh@goed-gevonden.be'],
        ['order_id' => 369263, 'email' => 'stephanieprolixity@gmail.com'],
        ['order_id' => 369269, 'email' => 'denniswhitesr@gmail.com'],
        ['order_id' => 369270, 'email' => 'gopittcw@yahoo.com'],
        ['order_id' => 369272, 'email' => 'viktor.sudicky@gmail.com'],
        ['order_id' => 369280, 'email' => 'steve.jedeli@gmail.com'],
        ['order_id' => 369281, 'email' => 'marijan.ruzic@gmail.com'],
        ['order_id' => 369282, 'email' => 'dean_avfc@yahoo.co.uk'],
        ['order_id' => 369284, 'email' => 'carlabrodhagen@gmail.com'],
        ['order_id' => 369290, 'email' => 'duro.salewa@gmail.com'],
        ['order_id' => 369302, 'email' => 'fayedavey@hotmail.co.uk'],
        ['order_id' => 369304, 'email' => 'nye.jayne@gmail.com'],
        ['order_id' => 369305, 'email' => 'mossmansell@gmail.com'],
        ['order_id' => 369308, 'email' => 'jerenguy@gmail.com'],
        ['order_id' => 369310, 'email' => 'saskia.wieland@gmx.net'],
        ['order_id' => 369311, 'email' => 'mriney22@gmail.com'],
        ['order_id' => 369315, 'email' => 'mkozler88@gmail.com'],
        ['order_id' => 369323, 'email' => 'sionne44@icloud.com'],
        ['order_id' => 369324, 'email' => 'hanighazarian@gmail.com'],
        ['order_id' => 369327, 'email' => 'ginavanh@gmail.com'],
        ['order_id' => 369333, 'email' => 'monica.russell@gmail.com'],
        ['order_id' => 369339, 'email' => 'gary@graycensplace.com'],
        ['order_id' => 369342, 'email' => 'kgokul1991@gmail.com'],
        ['order_id' => 369350, 'email' => 'webwerksinteractive@yahoo.com'],
        ['order_id' => 369354, 'email' => 'anmcanan@gmail.com'],
        ['order_id' => 369357, 'email' => 'juliewells69@gmail.com'],
        ['order_id' => 369359, 'email' => 'cpence69@yahoo.com'],
        ['order_id' => 369361, 'email' => 'wlaird@live.com.au'],
        ['order_id' => 369362, 'email' => 'davidcotton@me.com'],
        ['order_id' => 369366, 'email' => 'jose.campos@netcabo.pt'],
        ['order_id' => 369370, 'email' => 'jasonebeane@gmail.com'],
        ['order_id' => 369371, 'email' => 'smac.mcgull@gmail.com'],
        ['order_id' => 369377, 'email' => 'texmcd@hotmail.com'],
        ['order_id' => 369381, 'email' => 'stevenbrowning@startmail.com'],
        ['order_id' => 369385, 'email' => 'aaronsummerhill12@gmail.com'],
        ['order_id' => 369386, 'email' => 'mikep3396@hotmail.com'],
        ['order_id' => 369387, 'email' => 'mike.mcgill03@gmail.com'],
        ['order_id' => 369393, 'email' => 'ajlyleknight@gmail.com'],
        ['order_id' => 369395, 'email' => 'kendy_alcide@yahoo.ca'],
        ['order_id' => 369405, 'email' => 'tjbennett12@gmail.com'],
        ['order_id' => 369413, 'email' => 'Erinn.McBride@runbox.com'],
        ['order_id' => 369415, 'email' => 'liseh5@comcast.net'],
        ['order_id' => 369417, 'email' => 'heidrich@bellsouth.net'],
        ['order_id' => 369420, 'email' => 'siborgs.dedoncker@gmail.com'],
        ['order_id' => 369421, 'email' => 'dmkane@cox.net'],
        ['order_id' => 369423, 'email' => 'sigrunkarli@gmail.com'],
        ['order_id' => 369438, 'email' => 'gspitzmiller2002@yahoo.com'],
        ['order_id' => 369441, 'email' => 'judymcguire@charter.net'],
        ['order_id' => 369445, 'email' => 'trentonmshehan@gmail.com'],
        ['order_id' => 369447, 'email' => 'daveandbrookecam@hotmail.com'],
        ['order_id' => 369452, 'email' => 'williambleasegreen@gmail.com'],
        ['order_id' => 369461, 'email' => 'gwr9750@yahoo.com'],
        ['order_id' => 369464, 'email' => 'josh_dunford_1994@hotmail.com'],
        ['order_id' => 369465, 'email' => 'chakradomain@outlook.com'],
        ['order_id' => 369471, 'email' => 'mouloukmouzaoir@gmail.com'],
        ['order_id' => 369473, 'email' => 'monicahiggins19@gmail.com'],
        ['order_id' => 369476, 'email' => 'andystlouis@gmail.com'],
        ['order_id' => 369477, 'email' => 'lunchroom@duck.com'],
        ['order_id' => 369483, 'email' => 'pumpkinpieguy94@gmail.com'],
        ['order_id' => 369487, 'email' => 'd3ezzo@sbcglobal.net'],
        ['order_id' => 369489, 'email' => 'jesagar@gmail.com'],
        ['order_id' => 369492, 'email' => 'Wi1dcatsrok@yahoo.com'],
        ['order_id' => 369502, 'email' => 'jrstephen25@gmail.com'],
        ['order_id' => 369506, 'email' => 'ciccmicc@gmail.com'],
        ['order_id' => 369509, 'email' => 'bdowney715@gmail.com'],
        ['order_id' => 369512, 'email' => 'piano@vi5ualize.com'],
        ['order_id' => 369514, 'email' => 'linds_rieger@yahoo.ca'],
        ['order_id' => 369515, 'email' => 'edsellshomes25@gmail.com'],
        ['order_id' => 369517, 'email' => 'K.Laureano3@gmail.com'],
        ['order_id' => 369518, 'email' => 'winnielee917@gmail.com'],
        ['order_id' => 369519, 'email' => 'winnielee917@gmail.com'],
        ['order_id' => 369522, 'email' => 'hellosignal888@gmail.com'],
        ['order_id' => 369533, 'email' => 'evelineresseler04@gmail.com'],
        ['order_id' => 369545, 'email' => 'Rmartineznm@gmail.com'],
        ['order_id' => 369552, 'email' => 'simon@number15.co.uk'],
        ['order_id' => 369553, 'email' => 'rkolson@aol.com'],
        ['order_id' => 369556, 'email' => 'jinitavora@gmail.com'],
        ['order_id' => 369566, 'email' => 'markspeakman6s@icloud.com'],
        ['order_id' => 369568, 'email' => 'oussama.benbila@gmail.com'],
        ['order_id' => 369575, 'email' => 'misty.d.moravec@gmail.com'],
        ['order_id' => 369580, 'email' => 'zuidema123@gmail.com'],
        ['order_id' => 369595, 'email' => 'peterhaberstich@gmail.com'],
        ['order_id' => 369596, 'email' => 'bgissler@edge-re.com'],
        ['order_id' => 369601, 'email' => 'xinaodan@gmail.com'],
        ['order_id' => 369605, 'email' => 'jovyrocks@yahoo.com'],
        ['order_id' => 369612, 'email' => 'ptitheradge@hotmail.com'],
        ['order_id' => 369624, 'email' => 'dondoepke@gmail.com'],
        ['order_id' => 369633, 'email' => 'maryehall@maryehall.com'],
        ['order_id' => 369642, 'email' => 'vheredia04@hotmail.com'],
        ['order_id' => 369654, 'email' => 'corey.estey@gmail.com'],
        ['order_id' => 369657, 'email' => 'Jhaum77@gmail.com'],
        ['order_id' => 369671, 'email' => 'jahoo2k@hotmail.com'],
        ['order_id' => 369684, 'email' => 'cindymason@mac.com'],
        ['order_id' => 369687, 'email' => 'smoore1782@gmail.com'],
        ['order_id' => 369688, 'email' => 'lisasmith4949@gmail.com'],
        ['order_id' => 369690, 'email' => 'jfischer0806@gmail.com'],
        ['order_id' => 369691, 'email' => 'p.machurova@gmail.com'],
        ['order_id' => 369694, 'email' => 'pudaoking@yahoo.com'],
        ['order_id' => 369701, 'email' => 'heatherhuppy@gmail.com'],
        ['order_id' => 369731, 'email' => 'jmsobbs@gmail.com'],
        ['order_id' => 369736, 'email' => 'stefanpaulson3@gmail.com'],
        ['order_id' => 369737, 'email' => 'avi@avidana.net'],
        ['order_id' => 369739, 'email' => 'woneal2@gmail.com'],
        ['order_id' => 369740, 'email' => 'ricardoscorral@gmail.com'],
        ['order_id' => 369746, 'email' => 'hboyd77@gmail.com'],
        ['order_id' => 369762, 'email' => 'noriuev@gmail.com'],
        ['order_id' => 369768, 'email' => 'saltyjolives@gmail.com'],
        ['order_id' => 369786, 'email' => 'nancyn.ngo@gmail.com'],
        ['order_id' => 369792, 'email' => 'vannattajason@yahoo.com'],
        ['order_id' => 369804, 'email' => 'rovieriel@gmail.com'],
        ['order_id' => 369805, 'email' => 'bunnyslippers405@yahoo.com'],
        ['order_id' => 369843, 'email' => 'gach.g.p@gmail.com'],
        ['order_id' => 369844, 'email' => 'mkhutan@gmail.com'],
        ['order_id' => 369849, 'email' => 'prem.kumar.krishnan@live.com'],
        ['order_id' => 369855, 'email' => 'johnhaml@netscape.net'],
        ['order_id' => 369866, 'email' => 'rpaswan93@gmail.com'],
        ['order_id' => 369870, 'email' => 'doneale3@gmail.com'],
        ['order_id' => 369880, 'email' => 'christimperman@gmail.com'],
        ['order_id' => 369883, 'email' => 'debynicoli@aol.com'],
        ['order_id' => 369899, 'email' => 'skinnermd2018@gmail.com'],
        ['order_id' => 369900, 'email' => 'Kristina.amundson@gmail.com'],
        ['order_id' => 369903, 'email' => 'john.p.j.corcoran@gmail.com'],
    ];

    const PAGE_SIZE = 100;
    const MAX_PAGES = 7;

    private $connection;
    private DatabaseManager $databaseManager;
    private UserProviderInterface $userProvider;
    private AccessCodeService $accessCodeService;
    private UserProductService $userProductService;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(
        DatabaseManager $databaseManager,
        UserProviderInterface $userProvider,
        AccessCodeService $accessCodeService,
        UserProductService $userProductService,
    ) {
        $this->databaseManager = $databaseManager;
        $this->userProvider = $userProvider;
        $this->accessCodeService = $accessCodeService;
        $this->userProductService = $userProductService;

        $this->info('starting command AddTimeToUsersAccountsJan2023');

        $this->connection = $this->databaseManager->connection(config('railcontent.database_connection_name'));

        $arg1 = $this->argument('arg1');

        if ($arg1 === 'infoAccess') {
            $this->info('running printInfoUserAccess');
            $this->printInfoUserAccess();
        } elseif ($arg1 === 'infoCodes') {
            $this->info('running printInfoUserCodes');
            $this->printInfoUserCodes();
        } elseif ($arg1 === 'infoUserProducts') {
            $this->info('running printInfoUserProducts');
            $arg2 = $this->argument('arg2');
            if(!is_numeric($arg2)) {
                if ($arg2 < 1 || $arg2 > self::MAX_PAGES) {
                    $this->info('Incorrect argument value. Ending command now.');
                    die();
                }
                $this->info('Incorrect argument value. Ending command now.');
                die();
            }
            $this->printInfoUserProducts($arg2); # this works but it spits out far too much info
        } elseif (is_numeric($arg1)) {
            $this->addTimeToUsers($arg1);
        } else {
            $this->info('Incorrect command argument supplied.');
            die();
        }

        $this->info('');
        $this->info('end of command AddTimeToUsersAccountsJan2023');
    }

    private function getUserIdsAll()
    {
        $emailAddressesOnly = [];
        #$orderIdsOnly = [];

        $tableRowsMerged = array_merge(self::USER_EMAILS_1, self::USER_EMAILS_2);

        foreach($tableRowsMerged as $tableRow) {
            $emailAddressesOnly[] = $tableRow['email'];
            #$orderIdsOnly[] = $tableRow['order_id'];
        }

        $emailAddressesOnlyUnique = array_unique($emailAddressesOnly);
        #$orderIdsOnlyUnique = array_unique($orderIdsOnly);

        // check that the user_ids we get from the usora_users matches with the user_id we get from the user_id

        /** @var Collection $usoraUsers */
        $usoraUsers = $this->connection->table('usora_users')
            ->whereIn('email', $emailAddressesOnlyUnique)
            ->get(['id', 'email']);

        /** @var Collection $orders */
//        $orders = $this->connection->table('ecommerce_orders')
//            ->whereIn('id', $orderIdsOnlyUnique)
//            ->get(['id', 'user_id']);

        $userIds = [];

        foreach($emailAddressesOnlyUnique as $email) {
            $userId = $usoraUsers->where('email', $email)->first()->id;
            $userIds[] = $userId;
        }
        return $userIds;
    }

    private function getUserIdsSlice($page)
    {
        $userIds = $this->getUserIdsAll();

        if ($page < 1 || $page > self::MAX_PAGES) {
            $this->info('Incorrect argument value. Ending command now.');
            die();
        }

        $sliceOffset = ($page - 1) * self::PAGE_SIZE;

        $slice = array_slice($userIds, $sliceOffset, self::PAGE_SIZE);

        return $slice;
    }

    private function addTimeToUsers($page)
    {
        $users = $this->getUserIdsSlice($page);

        $accessCodes = [];
        $processedSuccessfully = [];
        $processingFailed = [];

        $this->info('Generating action codes...');

        $timeStart = microtime(true) * 1000;

        for ($i = 1; $i <= count($users); $i++) {
            $code = bin2hex(openssl_random_pseudo_bytes(24 / 2));

            $accessCodes[] = [
                'code' => strtoupper($code),
                'product_ids' => serialize([(integer) 418]),
                'is_claimed' => false,
                'claimer_id' => null,
                'claimed_on' => null,
                'brand' => 'pianote',
                'note' => null,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }

        $this->databaseManager->connection(config('ecommerce.database_connection_name'))
            ->table('ecommerce_access_codes')
            ->insert($accessCodes);

        $timeEnd = microtime(true) * 1000;
        $duration = floor ($timeEnd - $timeStart);
        $this->info('Generated ' . count($accessCodes) . ' action codes in ~' . $duration . 'ms');

        $this->info('Starting operation now. Hold on to your butts.');
        $this->info('');

        $timeStart = microtime(true) * 1000;

        foreach($users as $key => $userId){

            $userEntity = $this->userProvider->getUserById($userId);
            $accessCodeToUse = $accessCodes[$key]['code'];
            $claimedBefore = $accessCodes[$key]['is_claimed'];
            $claimResult = $this->accessCodeService->claim($accessCodeToUse, $userEntity);
            $claimedAfter = $claimResult->getIsClaimed();

            $success = $claimedBefore === false && $claimedAfter === true;

            if($success){
                $processedSuccessfully[] = $userId;
            } else {
                $processingFailed[] = $userId;
            }
        }

        $timeEnd = microtime(true) * 1000;
        $duration = floor ($timeEnd - $timeStart);

        $this->info('');
        $this->info('Successfully processed ' . count($processedSuccessfully) . ' users in ~' . $duration . 'ms');
        dump($processedSuccessfully);

        $this->info('');
        $this->info('Processing failed for ' . count($processingFailed) . ' users');
        dump($processingFailed);
    }

    private function printInfoUserProducts($page)
    {
        $userIds = $this->getUserIdsSlice($page);

        $timeStart = microtime(true) * 1000;

        $userProducts = $this->userProductService->getManyUsersProducts($userIds);

        $timeEnd = microtime(true) * 1000;
        $duration = floor ($timeEnd - $timeStart);
        $this->info('Fetched ' . count($userProducts) . ' user_product records in ~' . $duration . 'ms');

        for($i=0; $i<=100; $i++){
            $this->info('');
        }

        $this->info('============================ START OF TABLE ============================');
        $this->info('');

        $this->info(', userProductId, expirationDate, createdAt, updatedAt, productId, productName, productSku, userId, page');

        foreach($userIds as $userId){
            $this->info('------' . $userId . '------' .
                ',----------------------' .
                ',----------------------' .
                ',----------------------' .
                ',----------------------' .
                ',----------------------' .
                ',----------------------' .
                ',----------------------' .
                ',----------------------' .
                ',----------------------'
            );
            foreach($userProducts as $userProduct){
                if($userProduct->getUser()->getId() === $userId) {

                    $userProductId = $userProduct->getId();

                    $productId = $userProduct->getProduct()->getId();
                    $productSku = $userProduct->getProduct()->getSku();
                    $productName = $userProduct->getProduct()->getName();

                    /** @var Carbon $expirationDate */
                    $expirationDate = $userProduct->getExpirationDate();
                    if($expirationDate !== null) {
                        $expirationDate = $expirationDate->toDateTimeString();
                    }

                    /** @var Carbon $createdAt */
                    $createdAt = $userProduct->getCreatedAt();
                    $createdAt = $createdAt->toDateTimeString();

                    /** @var Carbon $updatedAt */
                    $updatedAt = $userProduct->getUpdatedAt();
                    $updatedAt = $updatedAt->toDateTimeString();

                    $this->info(
                        ', ' .
                        $userProductId . ', ' .
                        $expirationDate . ', ' .
                        $createdAt . ', ' .
                        $updatedAt . ', ' .
                        $productId . ', ' .
                        $productSku . ', ' .
                        $productName . ', ' .
                        $userId . ', ' .
                        $page
                    );
                }
            }
        }
        $this->info('');
        $this->info('============================ END OF TABLE ============================');
    }

    private function printInfoUserAccess()
    {
        $userIds = $this->getUserIdsAll();

        $timeStart = microtime(true) * 1000;

        // membership_expiration_date
        $usoraUsers = $this->connection->table('usora_users')
            ->whereIn('id', $userIds)
            ->get(['id', 'membership_expiration_date']);

        $timeEnd = microtime(true) * 1000;
        $duration = floor ($timeEnd - $timeStart);
        $this->info('Fetched ' . count($usoraUsers) . ' usora_user records in ~' . $duration . 'ms');

        $this->info('============================ START OF TABLE ============================');
        $this->info('');

        $this->info('user id, membership_expiration_date');
        foreach($usoraUsers as $user) {
            $this->info($user->id . ', ' . $user->membership_expiration_date);
        }

        $this->info('');
        $this->info('============================ END OF TABLE ============================');
    }

    private function printInfoUserCodes()
    {
        $userIds = $this->getUserIdsAll();

        $timeStart = microtime(true) * 1000;

        // membership_expiration_date
        $accessCodes = $this->connection->table('ecommerce_access_codes')
            ->whereIn('claimer_id', $userIds)
            ->get();

        $timeEnd = microtime(true) * 1000;
        $duration = floor ($timeEnd - $timeStart);
        $this->info('Fetched ' . count($accessCodes) . ' access code records in ~' . $duration . 'ms');

        $this->info('============================ START OF TABLE ============================');
        $this->info('');

        $this->info(
            'id, ' .
            'code, ' .
            'product_ids, ' .
            'claimer_id, ' .
            'claimed_on, ' .
            'created_at, ' .
            'updated_at'
        );
        foreach($accessCodes as $code) {
            $this->info(
                $code->id . ', ' .
                $code->code . ', ' .
                $code->product_ids . ', ' .
                $code->claimer_id . ', ' .
                $code->claimed_on . ', ' .
                $code->created_at . ', ' .
                $code->updated_at
            );
        }

        $this->info('');
        $this->info('============================ END OF TABLE ============================');
    }
}
