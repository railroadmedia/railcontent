<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class PictureUploadController extends Controller
{
    private ImageManager $imageManager;

    public function __construct(
        ImageManager $imageManager
    ) {
        $this->imageManager = $imageManager;
    }

    public function uploadProfilePhoto(Request $request)
    {
        $image = $this->imageManager->make($request->file('file'));

        $image
            ->interlace()
            ->encode('jpg', 75)
            ->save();

        $target = 'user-profile-pictures/'.
            pathinfo($request->get('target'))['filename'].'-'.time().'-'.user()->id.'.jpg';

        $success = Storage::disk('musora_web_platform_s3')->put($target, $request->file('file')->getContent());

        if ($success) {
            user()->profile_picture_url =
                config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url').$target;
            user()->save();

            return response()->json(user()->toArray(), 201);
        }

        return response()->json(['error' => 'Failed to upload avatar.'], 400);
    }


    public function uploadGearPhoto(Request $request)
    {

//dd($request->get('fieldKey'));
//dd/
        $image = $this->imageManager->make($request->file('file'));

        $image
            ->interlace()
            ->encode('jpg', 75)
            ->save();

        $target = 'user-gears-pictures/'.
            pathinfo($request->get('target'))['filename'].'-'.time().'-'.user()->id.'.jpg';

        $success = Storage::disk('musora_web_platform_s3')->put($target, $request->file('file')->getContent());

        if ($success) {
            user()->{$request->get('fieldKey')} =
                config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url').$target;
//            user()->drums_gear_photo =
//                config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url').$target;
            user()->save();

            return response()->json(user()->toArray(), 201);
        }

        return response()->json(['error' => 'Failed to upload avatar.'], 400);
    }



    // Since image uploads are pushed straight to S3 from our front end, we only need to copy the file out of the bucket
    // tmp folder to the location and filename we want.
    // See: https://docs.vapor.build/1.0/resources/storage.html#file-uploads
    public function uploadProfilePhotoFromS3FrontEnd(Request $request)
    {
        $target = 'user-profile-pictures/'.
            'user-profile-picture-'.time().'-'.user()->id.'.jpg';

        $success = Storage::disk('musora_web_platform_s3')->copy($request->get('s3_bucket_path'), $target);

        if ($success) {
            user()->profile_picture_url =
                config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url').$target;

            user()->save();

            return response()->json(user()->toArray(), 201);
        }

        return response()->json(['error' => 'Failed to upload avatar.'], 400);
    }
}
