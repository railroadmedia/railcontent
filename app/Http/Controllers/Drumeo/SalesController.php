<?php

namespace App\Http\Controllers\Drumeo;

use App\Http\Controllers\BaseController;
use App\Listeners\OrderEventListener;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Railroad\Ecommerce\Repositories\ProductRepository;

use Railroad\Ecommerce\Entities\User;
use Railroad\Ecommerce\Services\UserProductService;

/**
 * @param stdClass[] $arrayOfEntities
 * @param string $getMethodName
 * @return array
 */
function array_entity_column(array $arrayOfEntities, $getMethodName)
{
    $arrayOfValues = [];

    foreach ($arrayOfEntities as $entity) {
        if (method_exists($entity, $getMethodName)) {
            $arrayOfValues[] = $entity->$getMethodName();
        }
    }

    return $arrayOfValues;
}
class SalesController extends BaseController
{


    /**
     * @var UserProductService
     */
    private $userProductService;


    public function ___construct(UserProductService $userProductService, ProductRepository $productRepository)
    {
        $this->userProductService = $userProductService;
        $this->productRepository = $productRepository;
    }

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var OrderEventListener
     */
    private $orderEventListener;

    /**
     * MarketingController constructor.
     *
     * @param  DatabaseManager $databaseManager
     * @param  ProductRepository $productRepository
     * @param  OrderEventListener $orderEventListener
     */
    public function __construct(
        DatabaseManager $databaseManager,
        ProductRepository $productRepository,
        OrderEventListener $orderEventListener
    ) {
        $this->databaseManager = $databaseManager;
        $this->productRepository = $productRepository;
        $this->orderEventListener = $orderEventListener;
    }

    public function homepage()
    {
        $blogPostsViewData = [];

        try {
            $connection = $this->databaseManager->connection('blog_wp_mysql');

            // --- posts (part 1/3)-----------------------------------------------

            $postsKeyedById =
                $connection->table('wp_posts')
                    ->where('post_type', 'post')
                    ->where('post_status', 'publish')
                    ->orderBy('post_date', 'desc')
                    ->limit(4)
                    ->get()
                    ->keyBy('ID');

            $postMetaGrouped =
                $connection->table('wp_postmeta')
                    ->whereIn('post_id', $postsKeyedById->pluck('ID'))
                    ->get()
                    ->groupBy('post_id');

            $categoriesGrouped =
                $connection->table('wp_term_relationships')
                    ->join(
                        'wp_term_taxonomy',
                        'wp_term_taxonomy.term_taxonomy_id',
                        '=',
                        'wp_term_relationships.term_taxonomy_id'
                    )
                    ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
                    ->select('object_id', 'name')
                    ->whereIn('object_id', $postsKeyedById->pluck('ID'))
                    ->where('wp_term_taxonomy.taxonomy', 'category')
                    ->get()
                    ->groupBy('object_id');

            // get all the thumbnails
            // The featured image ID is stored in wp_postmeta with a meta_key called _thumbnail_id.
            // The actual thumbnail link is then contained in wp_posts with a post_type of attachment.
            $thumbnailPosts =
                $connection->table('wp_posts')
                    ->where('post_type', 'attachment')
                    ->where('post_status', 'inherit')
                    ->whereIn(
                        'ID',
                        $postMetaGrouped->flatten()
                            ->where('meta_key', '_thumbnail_id')
                            ->pluck('meta_value')
                            ->toArray()
                    )
                    ->get()
                    ->keyBy('ID');

            $thumbnailPostMetaGrouped =
                $connection->table('wp_postmeta')
                    ->whereIn('post_id', $thumbnailPosts->pluck('ID'))
                    ->get()
                    ->groupBy('post_id');

            // get all the artist users
            $artistIdStrings =
                $postMetaGrouped->flatten()
                    ->where('meta_key', 'artists')
                    ->pluck('meta_value')
                    ->toArray();

            $artistIds = [];

            foreach ($artistIdStrings as $artistIdString) {
                $artistIds = array_merge($artistIds, explode(',', $artistIdString));
            }

            $artistUsers =
                $connection->table('wp_users')
                    ->whereIn(
                        'ID',
                        $artistIds
                    )
                    ->get()
                    ->keyBy('ID');

            // set the view data
            foreach ($postsKeyedById->reverse() as $post) {
                $postMeta = $postMetaGrouped[$post->ID] ?? collect();
                $categories = $categoriesGrouped[$post->ID] ?? collect();
                $category = $categories->last()->name ?? '';

                // find the thumbnail post
                // this was fun to track down... - Caleb 2019
                $thumbnailPostId =
                    $postMeta->where('meta_key', '_thumbnail_id')
                        ->first()->meta_value ?? null;

                if (!empty($thumbnailPostId)) {
                    $thumbnailPost = $thumbnailPosts[$thumbnailPostId] ?? null;

                    if (!empty($thumbnailPost)) {
                        $thumbnailPostMeta = $thumbnailPostMetaGrouped[$thumbnailPost->ID] ?? collect();
                    }

                    if (!empty($thumbnailPostMeta)) {
                        $s3Data = unserialize(
                            $thumbnailPostMeta->where('meta_key', 'amazonS3_info')
                                ->first()->meta_value ?? ''
                        );

                        $directoryPath = dirname($s3Data['key']) . '/';

                        $attachData = unserialize(
                            $thumbnailPostMeta->where('meta_key', '_wp_attachment_metadata')
                                ->first()->meta_value ?? ''
                        );

                        if (!empty($attachData['sizes']['medium_large']['file'] && !empty($directoryPath))) {
                            $finalImageUrl =
                                'https://s3.amazonaws.com/drumeoblog/' .
                                $directoryPath .
                                $attachData['sizes']['medium_large']['file'];
                        }
                    }
                }

                // make the artist string
                $postArtistNames = [];

                $postArtistIdString =
                    $postMeta->where('meta_key', 'artists')
                        ->first()->meta_value ?? '';

                $postArtistIds = explode(',', $postArtistIdString);

                foreach ($postArtistIds as $postArtistId) {
                    $postArtist = $artistUsers[$postArtistId] ?? null;

                    if (!empty($postArtist)) {
                        $postArtistNames[] = $postArtist->display_name;
                    }
                }

                $blogPostsViewData[$post->ID]['id'] = $post->ID;
                $blogPostsViewData[$post->ID]['thumbnail_url'] = $finalImageUrl ?? '';
                $blogPostsViewData[$post->ID]['title'] = $post->post_title;
                $blogPostsViewData[$post->ID]['category'] = $category;
                $blogPostsViewData[$post->ID]['artist'] = implode(', ', $postArtistNames);
                $blogPostsViewData[$post->ID]['link'] = 'https://www.drumeo.com/beat/' . $post->post_name;
            }

        } catch (Exception $exception) {

        }

        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.homepage', ['blogPosts' => $blogPostsViewData], ['products' => $products]);
    }

    public function sales()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.standard', ['products' => $products, 'theme' => 'drumeo']);
    }
    public function home23()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.2023-home', ['products' => $products, 'theme' => 'drumeo']);
    }
    public function salesStudents()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.student-only', ['products' => $products]);
    }
    public function salesUpgrade()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.upgrade-offer', ['products' => $products]);
    }
    public function salesUpgradeLifetime()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.sales.lifetime', ['products' => $products]);
    }

    public function Festival()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.festival', ['products' => $products]);
    }

    public function toneControl()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.tone-control-kit', ['products' => $products]);
    }
    public function quietKick()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.quietkick', ['products' => $products]);
    }
    public function eardrums()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.eardrums', ['products' => $products]);
    }
    public function thirtyDayDrummer()
    {
        $products = $this->productRepository->all();
        $products = array_combine(array_entity_column($products, 'getSku'), $products);

        return view('drumeo.products.30-day-drummer', ['products' => $products]);
    }

    public function hitLikeAGirlSubmission(Request $request)
    {
        $code = false;

        if (session()->has('claimed_hlag')) {
            return redirect()
                ->away('/power-pack#customize-anchor')
                ->withErrors(['You cannot claim another code']);
        }

        $request->validate(
            [
                'email' => 'email',
            ]
        );

        // todo: better way to prevent abuse?
        session()->push('claimed_hlag', true);

        // todo: orderEventListener::generateAccessCode method was changed to from private to pubilc for use here - refactor it
        try{
            $code = $this->orderEventListener->generateAccessCode(124); // 124 is id for "Drumeo Edge Membership - Monthly" (sku: DLM-1-month)
        }catch(\Exception $e){
            error_log($e);
        }

        if(!$code){
            Mail::send(
                'emails.general',
                [
                    'user' => ['email' => 'The Drumeo server'],
                    'message' => 'An error occurred for a user tying to get a Hit-Like-A-Girl promo 1-month ' .
                        'access code. Please look up info about the user to see if maybe they\'ve tried again ' .
                        'successfully. If they haven\'t, please email them informing help on the way and then ' .
                        'development asking for a code to send them. The user\'s email is: ' .
                        $request->get('email') . ' (name: '  . $request->get('first_name')  . ' ' .
                        $request->get('last_name') . ')'],
                function (\Illuminate\Mail\Message $message) use ($request) {
                    $message->from('system@drumeo.com', 'Drumeo');
                    $message->to('support@drumeo.com')->subject('[Drumeo Edge] Your Free 30-Day Access Code');
                }
            );
            return redirect()->away('/power-pack#customize-anchor')->with(['error' => true]);
        }

        Mail::send(
            'emails.hit-like-a-girl-free-code-delivery',
            [
                'code' => $code,
                'firstName' => $request->get('first_name'),
                'lastName' => $request->get('last_name'),
            ],
            function (\Illuminate\Mail\Message $message) use ($request) {
                $message->from('support@drumeo.com', 'Drumeo');
                $message->to($request->get('email'))
                    ->subject('[Drumeo Edge] Your Free 30-Day Access Code');
            }
        );

        return redirect()
            ->away('/power-pack#customize-anchor')
            ->with(['success' => 'Your code has been sent to your email!']);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function registerFor30DayDrummer(Request $request)
    {
        if (is_current_user_a_member()) {
            $product = $this->productRepository->findOneBy(['sku' => '30-day-drummer']);
            $user = new User(current_user()->getId(), current_user()->getEmail());

            $this->userProductService->assignUserProduct($user, $product, null, 1);

            return redirect()->back()
                ->with('success-message', 'Success! You have registered for 30-Day Drummer. Check your email for the details.');
        }

        return redirect()->away(url()->route('shopping-cart.to-cart.api') . "?products[30-day-drummer]=1");
    }
}
