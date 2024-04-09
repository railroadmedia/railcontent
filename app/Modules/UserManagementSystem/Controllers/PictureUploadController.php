<?php

namespace Modules\UserManagementSystem\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Intervention\Image\ImageManager;

class PictureUploadController extends Controller
{
    private ImageManager $imageManager;

    public function __construct(
        ImageManager $imageManager
    ) {
        $this->imageManager = $imageManager;
    }


    public function uploadPhoto(Request $request)
    {
        ['fieldKey' => $fieldKey, 'file' => $file] = $request->validate([
            'fieldKey' => 'in:profile_picture_url,piano_gear_photo,guitar_gear_photo,drums_gear_photo,singing_gear_photo',
            'file' => File::image()
        ]);

        $image = $this
            ->imageManager
            ->make($file)
            ->interlace()
            ->encode('jpg', 90)
            ->save();

        $target = $fieldKey . "/" .
            pathinfo($request->get('target'))['filename'] . '-' . time() . '-' . user()->id . '.jpg';

        $success = Storage::disk('musora_web_platform_s3')->put($target, $image->getEncoded());

        if ($success) {
            user()->{$fieldKey} =
                config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url') . $target;
            user()->save();

            return response()->json(user()->toArray(), 201);
        }

        return response()->json(['error' => 'Failed to upload avatar.'], 400);
    }

    // Since image uploads are pushed straight to S3 from our front end, we only need to copy the file out of the bucket
    // tmp folder to the location and filename we want.
    // See: https://docs.vapor.build/1.0/resources/storage.html#file-uploads
    public function uploadPhotoFromS3FrontEnd(Request $request)
    {
        $request->validate(
            ['fieldKey' => 'in:profile_picture_url,piano_gear_photo,guitar_gear_photo,drums_gear_photo,singing_gear_photo']
        );

        $target = $request->get('fieldKey') . "/" .
            'user-profile-picture-' . time() . '-' . user()->id . '.jpg';

        $success = Storage::disk('musora_web_platform_s3')->copy($request->get('s3_bucket_path'), $target);

        if ($success) {
            user()->{$request->get('fieldKey')} =
                config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url') . $target;

            user()->save();

            return response()->json(user()->toArray(), 201);
        }

        return response()->json(['error' => 'Failed to upload avatar.'], 400);
    }
}
