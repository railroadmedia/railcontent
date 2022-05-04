<section class="tw-flex tw-flex-row tw-mb-6 md:tw-mb-8">
    <div class="tw-flex tw-flex-col tw-grow">

        <!-- Section Title -->
        <div class="tw-flex tw-items-center tw-mb-3 tw-w-full tw-justify-between">
            <a href="{{ $forumUrl }}" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Popular Conversations</h2>
            </a>
            <a href="{{ $forumUrl }}" 
                aria-label="See All Popular Conversations" 
                class="tw-tracking-wider tw-text-base tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
            >
                Forums
            </a>
        </div> 

        <div class="tw-flex tw-flex-row tw-flex-wrap">
            @foreach($forumPosts as $post)
                @include('partials.bladesora.members.content._hot-forum-post', [
                    "themeColor" => $brand,
                    "xp" => $post->user_xp,
                    "rank" => $post->xp_rank,
                    "avatar" => $post->user->getProfilePictureUrl(),
                    "title" => $post->title,
                    "date" => \Carbon\Carbon::parse($post->updated_at)->diffForHumans(),
                    "author" => $post->user->getDisplayName(),
                    "post" =>  substr(strip_tags($post->content),0,255),
                    "url" => url()->route('forums.post.jump-to', ['id' => $post->id])
                ])
            @endforeach
        </div>
        
    </div>
</section>