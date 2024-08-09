<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Railroad\Railforums\Repositories\PostLikeRepository;
use Railroad\Railforums\Repositories\PostRepository;
use Railroad\Railforums\Repositories\ThreadFollowRepository;
use Railroad\Railforums\Repositories\ThreadRepository;
use Railroad\Railnotifications\Contracts\RailforumProviderInterface;

class RailnotificationsForumProvider implements RailforumProviderInterface
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var ThreadRepository
     */
    private $threadRepository;

    /**
     * @var ThreadFollowRepository
     */
    private $threadFollowRepository;

    /**
     * @var PostLikeRepository
     */
    private $postLikeRepository;

    /**
     * RailforumProvider constructor.
     * @param PostRepository $postRepository
     * @param ThreadRepository $threadRepository
     * @param ThreadFollowRepository $threadFollowRepository
     * @param PostLikeRepository $postLikeRepository
     */
    public function __construct(
        PostRepository $postRepository,
        ThreadRepository $threadRepository,
        ThreadFollowRepository $threadFollowRepository,
        PostLikeRepository $postLikeRepository
    ) {
        $this->postRepository = $postRepository;
        $this->threadRepository = $threadRepository;
        $this->threadFollowRepository = $threadFollowRepository;
        $this->postLikeRepository = $postLikeRepository;
    }

    /**
     * @param int $postId
     * @return array|\Railroad\Resora\Entities\Entity|null
     */
    public function getPostById(int $postId)
    {
        $postEntity = $this->postRepository->read($postId);

        $post = ($postEntity) ? $postEntity->getArrayCopy() : [];
        $post['latest_post_like'] = $this->postLikeRepository->getLatestPostLike($postId);
        $post['like_count'] = $this->postLikeRepository->countPostLikes($postId);

        return $post;
    }

    public function getPostLikeCount(int $postId): int
    {
        return $this->postLikeRepository->countPostLikes($postId);
    }

    /**
     * @param int $threadId
     * @return array|\Railroad\Resora\Entities\Entity|null
     */
    public function getThreadById(int $threadId)
    {
        return $this->threadRepository->read($threadId);
    }

    /**
     * @param $threadId
     * @return mixed
     */
    public function getThreadFollowerIds($threadId)
    {
        return $this->threadFollowRepository->getThreadFollowerIds($threadId);
    }

    /**
     * @param $threadId
     * @return \Illuminate\Support\Collection
     */
    public function getAllPostIdsInThread($threadId): Collection
    {
        return $this->postRepository->getAllPostIdsInThread($threadId);
    }
}
