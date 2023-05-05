<?php

namespace App\Http\Middleware;

use App\Maps\PrimaryURLSlugToContentTypeMap;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RedirectIfMobileRequest
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->expectsJson()) {
            $route = null;
            $brand = Arr::first(request()->segments());
            if ($request->routeIs('platform.content.first-level') ||
                $request->routeIs('platform.content.second-level') ||
                $request->routeIs('platform.content.coach.show') ||
                $request->routeIs('platform.packs.first-level') ||
                $request->routeIs('platform.packs.second-level') ||
                $request->routeIs('platform.packs.third-level') ||
                $request->routeIs('platform.content.third-level') ||
                $request->routeIs('platform.content.fourth-level') ||
                $request->routeIs('platform.content.jump-to-content-id')) {
                $route =
                    route('v1.mobile.musora-api.content.show', ['id' => last(request()->segments()), 'brand' => $brand]
                    );
            } elseif ($request->routeIs('platform.packs')) {
                $route = route('v1.mobile.musora-api.packs', ['brand' => $brand]);
            } elseif ($request->routeIs('platform.coaches')) {
                $route = route('v1.mobile.musora-api.contents.filter', [
                    'brand' => $brand,
                    'included_types' => ['instructor'],
                    'required_fields' => ['is_coach,1'],
                ]);
            } elseif ($request->routeIs('platform.new-lessons')) {
                $contentTypes = array_merge(
                    array_values(config('railcontent.showTypes')[$brand] ?? []),
                    config('railcontent.homeNewContentTypes')
                );

                $route = route('v1.mobile.musora-api.contents.filter', [
                    'brand' => $brand,
                    'included_types' => $contentTypes,
                    'statuses' => ['published'],
                    'sort' => '-published_on',
                ]);
            } elseif ($request->routeIs('platform.subscribed-lessons')) {
                $route = route('v1.mobile.musora-api.followed.lessons', [
                    'brand' => $brand,
                ]);
            } elseif ($request->routeIs('platform.content-type-catalog')) {
                $lessonType = PrimaryURLSlugToContentTypeMap::$map[last(request()->segments())];
                $route =
                    route('v1.mobile.musora-api.contents.filter', ['brand' => $brand, 'included_types' => [$lessonType]]
                    );
            } elseif ($request->routeIs('platform.shows')) {
                $route = route('api.shows', ['brand' => $brand]);
            } elseif ($request->routeIs('platform.student-focus')) {
                $route = route('v1.mobile.musora-api.contents.filter', [
                    'brand' => $brand,
                    'included_types' => ['student-focus'],
                    'statuses' => ['published'],
                    'sort' => '-published_on',
                ]);
            } elseif ($request->routeIs('platform.podcast')) {
                $route = route('v1.mobile.musora-api.contents.filter', [
                    'brand' => $brand,
                    'included_types' => ['podcasts'],
                    'statuses' => ['published'],
                    'sort' => '-published_on',
                ]);
            } elseif ($request->routeIs('platform.schedule')) {
                $route = route('v1.mobile.musora-api.content-schedule', [
                    'brand' => $brand,
                ]);
            } elseif ($request->routeIs('platform.content.jump-to-content-id')) {
                $route = route('v1.mobile.musora-api.content-schedule', [
                    'brand' => $brand,
                ]);
            } elseif ($request->routeIs('forums.show-categories')) {
                $route = route('railforums.mobile-app.discussions', [
                    'brand' => $brand,
                ]);
            } elseif ($request->routeIs('forums.show-all-latest-threads')) {
                $route = route('railforums.mobile-app.show-all-latest-threads', [
                    'brand' => $brand,
                ]);
            } elseif ($request->routeIs('forums.show-category-threads')) {
                $route = route('railforums.mobile-app.show-category-threads', [
                    'brand' => $brand,
                    'category_id' => last(request()->segments()),
                ]);
            } elseif ($request->routeIs('forums.show-thread-posts')) {
                $route = route('railforums.mobile-app.show.thread', [
                    'brand' => $brand,
                    'id' => last(request()->segments()),
                ]);
            }elseif($request->routeIs('platform.cohort')){
                $route = route('v1.mobile.musora-api.cohort.template', [
                    'brand' => $brand,
                    'slug' => last(request()->segments()),
                ]);
            }

            if ($route) {
                return redirect($route);
            }

            return $next($request);
        }

        return $next($request);
    }
}
