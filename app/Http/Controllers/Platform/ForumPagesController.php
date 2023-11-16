<?php

namespace App\Http\Controllers\Platform;

use Modules\UserManagementSystem\Models\BlockedUser;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railforums\Repositories\CategoryRepository;
use Railroad\Railforums\Repositories\PostRepository;
use Railroad\Railforums\Repositories\SearchIndexRepository;
use Railroad\Railforums\Repositories\ThreadReadRepository;
use Railroad\Railforums\Repositories\ThreadRepository;
use Railroad\Usora\Repositories\UserRepository;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ForumPagesController extends Controller
{
    /**
     * @var ThreadRepository
     */
    private $threadRepository;
    /**
     * @var ThreadReadRepository
     */
    private $threadReadRepository;
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var SearchIndexRepository
     */
    private $searchIndexRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param ThreadRepository $threadRepository
     * @param ThreadReadRepository $threadReadRepository
     * @param PostRepository $postRepository
     * @param SearchIndexRepository $searchIndexRepository
     * @param UserRepository $userRepository
     * @param CategoryRepository $categoryRepository
     * @param ContentService $contentService
     */
    public function __construct(
        ThreadRepository $threadRepository,
        ThreadReadRepository $threadReadRepository,
        PostRepository $postRepository,
        SearchIndexRepository $searchIndexRepository,
        UserRepository $userRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->threadRepository = $threadRepository;
        $this->threadReadRepository = $threadReadRepository;
        $this->postRepository = $postRepository;
        $this->searchIndexRepository = $searchIndexRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showCategories(Request $request, $domain, $brand)
    {
        $amount = $request->get('amount', 20);
        $page = $request->get('page', 1);
        $categoryIds = $request->get('category_ids', null);
        $pinned = (boolean)$request->get('pinned');
        // $followed = $request->has('followed') ? (boolean)$request->get('followed') : null;

        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        \Railroad\Railforums\Decorators\ModeDecoratorBase::$decorationMode = \Railroad\Railforums\Decorators\ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        PostRepository::$blockedUserIds =  BlockedUser::where('blocker_id','=',user()->id)->get()->pluck('user_id')->toArray();

        $threads = $this->threadRepository->getDecoratedThreads(
            $amount,
            $page,
            $categoryIds,
            $pinned,
            true
        );

        $pinnedThreads = $this->threadRepository->getDecoratedThreads(
            $amount,
            $page,
            $categoryIds,
            true,
            true
        );

        $threadsCount = $this->threadRepository->getThreadsCount(
            $categoryIds,
            $pinned,
            true
        );

        $mappedThreads = [];
        $mappedPinnedThreads = [];
        $mappedDiscussions = [];

        foreach ($threads as $thread) {
            $latestPost = $thread->latest_post;
            if($latestPost) {
                $latestPost['created_at_diff'] =
                    Carbon::parse($latestPost['created_at'])
                        ->diffForHumans();
                $latestPost['url'] = url()->route('forums.jump-to-post', [$latestPost['id']]);
            }

            $mappedThreads[] = [
                "title" => $thread->title,
                "id" => $thread->id,
                "categoryId" => $thread->category_id,
                "createdOn" => Carbon::parse($thread->published_on)
                    ->diffforHumans(),
                "isPinned" => $thread->pinned,
                "isNew" => !$thread->is_read,
                "isLocked" => $thread->locked,
                "topic" => $thread->category_id,
                "replyAmount" => $thread->post_count,
                "authorUsername" => $thread->author_display_name,
                "authorAvatar" => $thread->author_avatar_url,
                "isRead" => $thread->is_read,
                "access_level" => $thread->author_access_level,
                "url" => url()->route(
                    'forums.show-thread-posts',
                    [$thread->category_slug, $thread->category_id, $thread->slug, $thread->id]
                ),
                "latestPost" => $latestPost,
            ];

            $authors[$thread->last_post_user_id]['threads'][] = count($mappedThreads) - 1;
        }

        foreach ($pinnedThreads as $pinnedThread) {
            $latestPost = $pinnedThread->latest_post;
            if($latestPost) {
                $latestPost['created_at_diff'] =
                    Carbon::parse($latestPost['created_at'])
                        ->diffForHumans();
                $latestPost['url'] = url()->route('forums.jump-to-post', [$latestPost['id']]);
            }

            $mappedPinnedThreads[] = [
                "title" => $pinnedThread->title,
                "id" => $pinnedThread->id,
                "categoryId" => $pinnedThread->category_id,
                "createdOn" => Carbon::parse($pinnedThread->published_on)
                    ->diffforHumans(),
                "isPinned" => $pinnedThread->pinned,
                "isNew" => !$pinnedThread->is_read,
                "isLocked" => $pinnedThread->locked,
                "topic" => $pinnedThread->category_id,
                "replyAmount" => $pinnedThread->post_count,
                "authorUsername" => $pinnedThread->author_display_name,
                "authorAvatar" => $pinnedThread->author_avatar_url,
                "access_level" => $pinnedThread->author_access_level,
                "isRead" => $pinnedThread->is_read,
                "url" => url()->route(
                    'forums.show-thread-posts',
                    [$pinnedThread->category_slug, $pinnedThread->category_id, $pinnedThread->slug, $pinnedThread->id]
                ),
                "latestPost" => $latestPost,
            ];

            $authors[$pinnedThread->last_post_user_id]['pinnedThreads'][] = count($mappedPinnedThreads) - 1;
        }

        $discussions = $this->categoryRepository->getDecoratedCategories();

        foreach ($discussions as $discussion) {
            $latestPost = $discussion->latest_post;
            if (!empty($latestPost)) {
                $latestPost['url'] = url()->route('forums.jump-to-post', [$latestPost['id']]);
            }

            $mappedDiscussions[] = [
                "id" => $discussion->id,
                "title" => $discussion->title,
                'description' => $discussion->description,
                "createdOn" => Carbon::parse($discussion->created_at)
                    ->diffForHumans(),
                "replyAmount" =>  $discussion->post_count ?? 0,
                "authorUsername" => $discussion->latest_post['author_display_name'] ?? '',
                "authorAvatar" => $discussion->latest_post['author_avatar_url'] ?? '',
                "url" => url()->route('forums.show-category-threads', [$discussion['slug'], $discussion['id']]),
                "access_level" => $discussion->access_level,
                "icon" => $discussion->icon ?? '',
                "latestPost" => $latestPost
            ];
        }

        $user = user();

        $currentUser = [
            "avatar" => $user->profile_picture_url,
            "xp" => $user->totalXp(),
            "access_level" => $user->access_level,
            "xp_rank" =>  $user->getXpRank(),
        ];

        return view(
            'forums.index',
            [
                "discussions" => $mappedDiscussions,
                "threads" => $mappedThreads,
                "pinnedThreads" => $mappedPinnedThreads,
                'threadCount' => $threadsCount,
                'user' => $currentUser,
            ]
        );
    }

    /**
     * @param $categorySlug
     * @param $categoryId
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showCategoryThreads(Request $request, $domain, $brand, $categorySlug, $categoryId)
    {
        $category = $this->categoryRepository->read($categoryId);
        if (!$category) {
            throw new NotFoundHttpException();
        }

        $amount = $request->get('amount', 20);
        $page = $request->get('page', 1);
        $categoryIds = [$categoryId];
        $pinned = (boolean)$request->get('pinned');
        $followed = $request->has('followed') ? (boolean)$request->get('followed') : null;

        PostRepository::$blockedUserIds =  BlockedUser::where('blocker_id','=',user()->id)->get()->pluck('user_id')->toArray();

        $sortBy = $request->get('sortby_val', '-last_post_published_on');

        $threads = $this->threadRepository->getDecoratedThreads(
            $amount,
            $page,
            $categoryIds,
            false,
            $followed,
            $sortBy
        );

        $pinnedThreads = $this->threadRepository->getDecoratedThreads(
            $amount,
            $page,
            $categoryIds,
            true,
            $followed
        );

        $threadsCount = $this->threadRepository->getThreadsCount(
            $categoryIds,
            $pinned,
            $followed
        );

        $mappedThreads = [];
        $mappedPinnedThreads = [];

        $isAdmin = user()->isAdmin();

        foreach ($threads as $thread) {
            $latestPost = $thread->latest_post;
            $latestPost['created_at_diff'] =
                Carbon::parse($latestPost['created_at'])
                    ->diffForHumans();
            $latestPost['url'] = url()->route('forums.jump-to-post', [$latestPost['id']]);

            $mappedThreads[] = [
                "title" => $thread->title,
                "id" => $thread->id,
                "categoryId" => $thread->category_id,
                "createdOn" => Carbon::parse($thread->published_on)
                    ->diffforHumans(),
                "lastPostDate" => Carbon::parse($thread->last_post_published_on)
                    ->diffforHumans(),
                "isPinned" => $thread->pinned,
                "isNew" => !$thread->is_read,
                "isLocked" => $thread->locked,
                "topic" => $thread->category_id,
                "replyAmount" => $thread->post_count,
                "authorUsername" => $thread->author_display_name,
                "authorAvatar" => $thread->author_avatar_url,
                "isRead" => $thread->is_read,
                "access_level" => $thread->author_access_level,
                "url" => url()->route(
                    'forums.show-thread-posts',
                    [$category['slug'], $category['id'], $thread->slug, $thread->id]
                ),
                "latestPost" => $latestPost,
            ];

            $authors[$thread->last_post_user_id]['threads'][] = count($mappedThreads) - 1;
        }

        foreach ($pinnedThreads as $pinnedThread) {
            $latestPost = $pinnedThread->latest_post;
            $latestPost['created_at_diff'] =
                Carbon::parse($latestPost['created_at'])
                    ->diffForHumans();
            $latestPost['url'] = url()->route('forums.jump-to-post', [$latestPost['id']]);

            $mappedPinnedThreads[] = [
                "title" => $pinnedThread->title,
                "id" => $pinnedThread->id,
                "categoryId" => $pinnedThread->category_id,
                "createdOn" => Carbon::parse($pinnedThread->published_on)
                    ->diffforHumans(),
                "lastPostDate" => Carbon::parse($pinnedThread->last_post_published_on)
                    ->diffforHumans(),
                "isPinned" => $pinnedThread->pinned,
                "isNew" => !$pinnedThread->is_read,
                "isLocked" => $pinnedThread->locked,
                "topic" => $pinnedThread->category_id,
                "replyAmount" => $pinnedThread->post_count,
                "authorUsername" => $pinnedThread->author_display_name,
                "authorAvatar" => $pinnedThread->author_avatar_url,
                "access_level" => $pinnedThread->author_access_level,
                "isRead" => $pinnedThread->is_read,
                "url" => url()->route(
                    'forums.show-thread-posts',
                    [$category['slug'], $category['id'], $pinnedThread->slug, $pinnedThread->id]
                ),
                "latestPost" => $latestPost,
            ];

            $authors[$pinnedThread->last_post_user_id]['pinnedThreads'][] = count($mappedPinnedThreads) - 1;
        }

        $user = user();

        $accessLevel = $user->access_level;

        $userXP = $user->total_xp;
        $xpRank = $user->getXpRank();

        $currentUser = [
            "avatar" => $user->profile_picture_url,
            "xp" => $userXP,
            "access_level" => $accessLevel,
            "xp_rank" => $xpRank,
        ];

        return view(
            'forums.threads',
            [
                'discussion' => $category,
                "threads" => $mappedThreads,
                "pinnedThreads" => $mappedPinnedThreads,
                'threadCount' => $threadsCount,
                'user' => $currentUser,
                'isAdmin' => $isAdmin,
                "categoryUrl" => url()->route('forums.show-category-threads', [$category->slug, $category->id]),
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showAllLatestThreads(Request $request, $domain, $brand)
    {
        $amount = $request->get('amount', 20);
        $page = $request->get('page', 1);
        $sortBy = $request->get('sortby_val', '-last_post_published_on');
        PostRepository::$blockedUserIds =  BlockedUser::where('blocker_id','=',user()->id)->get()->pluck('user_id')->toArray();

        $threads = $this->threadRepository->getDecoratedThreads($amount, $page, [], null, null, $sortBy);

        $threadsCount = $this->threadRepository->getThreadsCount([]);

        $mappedThreads = [];

        foreach ($threads as $thread) {
            $latestPost = $thread->latest_post;
            $latestPost['created_at_diff'] =
                Carbon::parse($latestPost['created_at'])
                    ->diffForHumans();
            $latestPost['url'] = url()->route('forums.jump-to-post', [$latestPost['id']]);

            $mappedThreads[] = [
                "title" => $thread->title,
                "id" => $thread->id,
                "categoryId" => $thread->category_id,
                "category" => $thread->category,
                "createdOn" => Carbon::parse($thread->published_on)
                    ->diffforHumans(),
                "isPinned" => $thread->pinned,
                "isNew" => !$thread->is_read,
                "isLocked" => $thread->locked,
                "topic" => $thread->category_id,
                "replyAmount" => $thread->post_count,
                "authorUsername" => $thread->author_display_name,
                "authorAvatar" => $thread->author_avatar_url,
                "isRead" => $thread->is_read,
                "access_level" => $thread->author_access_level,
                "url" => url()->route(
                    'forums.show-thread-posts',
                    [$thread->category_slug, $thread->category_id, $thread->slug, $thread->id]
                ),
                "latestPost" => $latestPost,
            ];
        }
        $isAdmin = user()->isAdmin();

        $user = user();

        $accessLevel = $user->access_level;

        $userXP = $user->total_xp;
        $xpRank = $user->getXpRank();
        $progressLevel = $user->getMethodLevel();

        $currentUser = [
            "avatar" => $user->profile_picture_url,
            "xp" => $userXP,
            "access_level" => $accessLevel,
            "xp_rank" => $xpRank,
        ];

        return view('forums.latest', [
            "threads" => $mappedThreads,
            'threadCount' => $threadsCount,
            'user' => $currentUser,
        ]);
    }

    /**
     * @param $categorySlug
     * @param $categoryId
     * @param $threadSlug
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showThreadPosts(Request $request, $domain, $brand, $categorySlug, $categoryId, $threadSlug, $id)
    {
        $amount = $request->get('amount', 15);
        $page = $request->get('page', 1);

        $sortBy = $request->get('sortby_val', '-published_on');

        \Railroad\Railforums\Decorators\ModeDecoratorBase::$decorationMode = \Railroad\Railforums\Decorators\ModeDecoratorBase::DECORATION_MODE_MAXIMUM;
        PostRepository::$blockedUserIds =  BlockedUser::where('blocker_id','=',user()->id)->get()->pluck('user_id')->toArray();

        $thread =
            $this->threadRepository->getDecoratedThreadsByIds([$id])
                ->first();
        if (!$thread) {
            throw new NotFoundHttpException();
        }

        if (!$thread) {
            throw new NotFoundHttpException();
        }

        $category = $this->categoryRepository->read($thread->category_id);

        if (!$category) {
            throw new NotFoundHttpException();
        }

        $posts = $this->postRepository->getDecoratedPosts($amount, $page, $id, $sortBy);

        $total = $this->postRepository->getPostsCount($id);

        if (!$thread->is_read) {
            $this->threadReadRepository->markRead($thread->id, auth()->id());
        }

        $mappedThread = [
            "title" => $thread->title,
            "id" => $thread->id,
            "categoryId" => $thread->category_id,
            "createdOn" => Carbon::parse($thread->published_on)
                ->diffforHumans(),
            "lastPostDate" => Carbon::parse($thread->last_post_published_on)
                ->diffforHumans(),
            "isPinned" => $thread->pinned,
            "isNew" => !$thread->is_read,
            "isLocked" => $thread->locked,
            "isFollowed" => $thread->is_followed,
            "topic" => $thread->category_id,
            "replyAmount" => $thread->post_count,
            "authorUsername" => $thread->last_post_user_display_name,
            "authorAvatar" => $thread->last_post_user_avatar_url,
            "isRead" => $thread->is_read,
            "signaturesHidden" => false,
            "url" => url()->route(
                'forums.show-thread-posts',
                [$category['slug'], $category['id'], $thread->slug, $thread->id]
            ),
            "currentPage" => $page,
            "totalPages" => ceil($total / $amount),
            "update" => url()->route('forums.show-update-thread-form', [$thread->id]),
        ];

        $authors[$thread->last_post_user_id]['thread'] = true;
        $authorIds = [];

        foreach ($posts as $post) {
            $authorIds[] = $post['author_id'];
        }

//        $users = User::query()->whereIn('id', $authorIds)->get()->keyBy('id');
        $coaches = User::query()
            ->whereIn('id', $authorIds)
            ->get()
            ->filter(fn(User $user) => $user->is_coach)
            ->pluck('id');

        $mappedPosts = [];

        foreach ($posts as $post) {
            $author = $post->author;

            $mappedPosts[] = [
                "id" => $post->id,
                "authorUsername" => $author['display_name'],
                "authorAvatar" => $author['avatar_url'],
                'authorTotalPosts' => $author['total_posts'],
                'authorDaysAsMember' => $author['days_as_member'],
                'authorSignature' => $author['signature'],
                'progressLevel' => $author['level_rank'],
                "xp" => $author['xp_rank'],
                "access_level" => $coaches->contains($author['id']) ? "coach" : $author['access_level'],
                "authorProfileUrl" => $author['associated_coach'] ? $author['associated_coach']['url'] : url()->route(
                    'platform.profile.dashboard',
                    [$post->author_id]
                ),
                "authorId" => $post->author_id,
                "createdOn" => Carbon::parse($post->published_on)
                        ->timezone(user()->timezone)
                        ->format('M j, Y') . ' AT ' . Carbon::parse($post->published_on)
                        ->timezone(user()->timezone)
                        ->format('g:i A'),
                "totalLikes" => $post->like_count,
                "isLiked" => $post->is_liked_by_viewer,
                "postBody" => $post->content,
            ];

            $authors[$post->author_id]['posts'][] = count($mappedPosts) - 1;
        }

        $mappedThread['posts'] = $mappedPosts;

        $isAdmin = user()->isAdmin();

        $user = user();

        $accessLevel = $user->access_level;

        $userXP = $user->total_xp;
        $xpRank = $user->getXpRank();
        $progressLevel = $user->getMethodLevel();

        $mappedCurrentUser = [
            "avatar" => $user->profile_picture_url,
            "xp" => $userXP,
            "access_level" => $accessLevel,
            "userExpVal" => $xpRank,
            "isAdmin" => $isAdmin,
            "isOwner" => $thread->author_id == $user->id,
            "name" => $user->display_name,
            "id" => $user->id,
            'progressLevel' => $progressLevel,
            'totalPosts' => $this->postRepository->getUsersPostsCount([$user->id])[$user->id] ?? 0,
        ];

        $threadTitle = $mappedThread['title'];

        return view(
            'forums.thread',
            [
                "thread" => json_encode($mappedThread),
                "currentUser" => json_encode($mappedCurrentUser),
                "currentPage" => $page,
                "amountPerPage" => $amount,
                "threadTitle" => $threadTitle,
                "categoryUrl" => url()->route('forums.show-category-threads', [$category->slug, $category->id]),
                "categoryTitle" => $category->title,
                "categoryId" => $category->category_id,
                "categorySlug" => $category->slug,
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSearchResultsJson(Request $request, $domain, $brand)
    {
        $term = trim($request->get('term', null));

        $results = $this->searchIndexRepository->search(
            $term,
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', 'score')
        );

        $count = $this->searchIndexRepository->countTotalResults($term);

        $mappedItems = [];

        $authorIds = [];

        foreach ($results as $post) {
            $authorIds[] = $post['author_id'];
            $authorIds[] = $post['thread']['author_id'];
        }

        $authors = User::query()->whereIn('id', $authorIds)->get()->keyBy('id');

        $usersAccessLevels = $authors->pluck('access_level');

        $users = $this->userRepository->findBy(['id' => $authorIds]);

        foreach ($results as $index => $post) {
            if (empty($post['thread'])) {
                continue;
            }

            $author = $post['author'];

            $mappedItems[] = [
                'id' => $post['id'],
                'threadId' => $post['thread_id'],
                "authorUsername" => $author['display_name'],
                "authorAvatar" => $author['avatar_url'],
                'authorTotalPosts' => $author['total_posts'],
                'authorDaysAsMember' => $author['days_as_member'],
                'authorProgressLevel' => $author['level_rank'],
                "xp" => $authors[$post['author_id']]->total_xp ?? 0,
                "access_level" => $authors[$post['author_id']]->isAdmin() ? 'admin' :
                    $authors[$post['thread']['author_id']]->access_level,
                'authorId' => $post['author_id'],
                'createdOn' => Carbon::parse($post['published_on'])
                    ->diffforHumans(),
                'postBody' => $this->getContentExcerpt($post['content']),
                'url' => url()->route('forums.jump-to-post', [$post['id']]),
                'thread' => [
                    'title' => $post['thread']['title'],
                    'replyAmount' => $post['thread']['post_count'],
                    'topic' => $post['thread']['category_id'],
                    'category' => $post['thread']['category'],
                    'is_read' => $post['thread']['is_read'],
                    'createdOn' => Carbon::parse($post['thread']['published_on'])
                        ->timezone(user()->timezone)
                        ->format('M d, Y'),
                    'authorUsername' => $post['thread']['author_display_name'],
                    "authorAvatar" => $post['thread']['author_avatar_url'],
                    "authorAccessLevel" => $authors[$post['thread']['author_id']]->isAdmin() ? 'admin' :
                        $authors[$post['thread']['author_id']]->access_level,
                ],
            ];
        }

        return response()->json($this->utf8ize(['results' => $mappedItems, 'count' => $count]));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showCreateThreadForm(Request $request, $domain, $brand)
    {
        $categories = $this->categoryRepository->getDecoratedCategories();

        return view(
            'forums.create',
            [
                "user" => user(),
                'categories' => array_combine(
                    $categories->pluck('id')
                        ->toArray(),
                    $categories->pluck('title')
                        ->toArray()
                ),
            ]
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showUpdateThreadForm(Request $request, $domain, $brand, $id)
    {
        $thread = $this->threadRepository->read($id);
        $categories = $this->categoryRepository->getDecoratedCategories();

        $threadData = [
            'id' => $thread->id,
            'category_id' => $thread->category_id,
            'title' => $thread->title,
        ];

        if (!user()->isAdmin() && $thread->author_id !== user()->id) {
            throw new NotFoundHttpException();
        }

        return view(
            'forums.update',
            [
                'thread' => $threadData,
                'categories' => array_combine(
                    $categories->pluck('id')
                        ->toArray(),
                    $categories->pluck('title')
                        ->toArray()
                ),
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showCreateCategoryForm(Request $request, $domain, $brand)
    {
        return view(
            'forums.create-forum',
            [
                "user" => user(),
                'brand' => $brand
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showUpdateCategoryForm(Request $request, $domain, $brand, $id)
    {
        $forum = $this->categoryRepository->read($id);

        session()->put(
            '_old_input',
            [
                'title' => $forum['title'],
                'description' => $forum['description'],
                'weight' => $forum['weight'],
                'icon-class' => $forum['icon'],
            ]
        );

        return view(
            'forums.update-forum',
            [
                "forumId" => $id,
                "forum" => $forum,
                "user" => user(),
            ]
        );
    }

    /**
     * @param Request $request
     * @param $postId
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function jumpToPost(Request $request, $domain, $brand, $postId)
    {
        $post = $this->postRepository->read($postId);

        if (!$post) {
            throw new NotFoundHttpException();
        }

        $thread = $this->threadRepository->read($post->thread_id);

        if (!$thread) {
            throw new NotFoundHttpException();
        }

        $category = $this->categoryRepository->read($thread->category_id);

        if (!$category) {
            throw new NotFoundHttpException();
        }

        $allPostIdsInThread = collect(
            $this->postRepository->getAllPostIdsInThread($post->thread_id, 'published_on')
        )
            ->pluck('id')
            ->all();

        $postPositionInThread = array_search($post->id, $allPostIdsInThread);

        return redirect(
            url()->route(
                'forums.show-thread-posts',
                [
                    'brand' => brand(),
                    'categorySlug' => $category->slug,
                    'categoryId' => $category->id,
                    'threadSlug' => $thread->id,
                    'threadId' => $thread->id,
                    'page' => ceil(($postPositionInThread + 1) / 15),
                    'sortby_val' => 'published_on'
                ]
            ) . '#post' . $post->id
        );
    }

    /**
     * @param $threadId
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function jumpToThread(Request $request, $domain, $brand, $threadId)
    {
        $thread = $this->threadRepository->read($threadId);
        if (!$thread) {
            throw new NotFoundHttpException();
        }

        $category = $this->categoryRepository->read($thread->category_id);
        if (!$category) {
            throw new NotFoundHttpException();
        }

        return redirect(
            url()->route(
                'forums.show-thread-posts',
                [
                    $category->slug,
                    $category->id,
                    $thread->slug,
                    $thread->id,
                ]
            )
        );
    }

    /**
     * @param $content
     * @return false|string|void
     */
    protected function getContentExcerpt($content)
    {
        $crawler = new Crawler($content);

        // filter out blockquote tags
        $crawler->filter('blockquote')
            ->each(
                function (Crawler $crawler) {
                    foreach ($crawler as $node) {
                        $node->parentNode->removeChild($node);
                    }
                }
            );

        $result = $crawler->text();
        $resultTruncated = substr(trim((string)$result), 0, 470);

        if (strlen($result) > 470) {
            $resultTruncated = $resultTruncated . '...';
        }

        return $resultTruncated;
    }

    /**
     * @param $mixed
     * @return array|false|string|string[]|void|null
     */
    private function utf8ize($mixed)
    {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = $this->utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }

        return $mixed;
    }
}
