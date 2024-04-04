<?php

namespace App\Modules\MusoraApi\Controllers\V5;

use Illuminate\Http\JsonResponse;
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


    public function uploadPicture(Request $request): JsonResponse
    {
        ['fieldKey' => $fieldKey, 'file' => $file] = $request->validate(
            [
                'fieldKey' => 'in:profile_picture_url,piano_gear_photo,guitar_gear_photo,drums_gear_photo,singing_gear_photo,forum_post_photo',
                'file' => File::image()
            ]
        );

        $image = $this->imageManager->make($file);

        $image
            ->interlace()
            ->encode('jpg', 75)
            ->save();

        $target = $fieldKey . "/" . pathinfo($request->get('target'))['filename'] . '-' . time() . '-' . user(
            )->id . '.jpg';

        $success = Storage::disk('musora_web_platform_s3')->put($target, $request->file('file')->getContent());

        if ($success) {
            $url = config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url') . $target;

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'Failed to upload picture.'], 400);
    }

    // Since image uploads are pushed straight to S3 from our front end, we only need to copy the file out of the bucket
    // tmp folder to the location and filename we want.
    // See: https://docs.vapor.build/1.0/resources/storage.html#file-uploads
    public function uploadPictureFromS3(Request $request): JsonResponse
    {
        ['fieldKey' => $fieldKey, 's3_bucket_path' => $s3Path] = $request->validate(
            [
                'fieldKey' => 'in:profile_picture_url,piano_gear_photo,guitar_gear_photo,drums_gear_photo,singing_gear_photo,forum_post_photo',
                's3_bucket_path' => 'required|string'
            ]
        );

        $target = $fieldKey . "/" . time() . '-' . user()->id . '.jpg';

        $success = Storage::disk('musora_web_platform_s3')->copy($s3Path, $target);

        if ($success) {
            $url = config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url') . $target;

            return response()->json(['url' => $url], 201);
        }

        return response()->json(['error' => 'Failed to upload picture.'], 400);
    }

    public function deletePictureFromS3(Request $request): JsonResponse
    {
        ['picture_url' => $pictureUrl] = $request->validate(['picture_url' => 'url']);

        $s3Path = str_replace(
            config('filesystems.disks.musora_web_platform_s3.cloudfront_access_url'),
            '',
            $pictureUrl
        );

        if (Storage::disk('musora_web_platform_s3')->missing($s3Path)) {
            // if the file doesn't exist, we can consider it deleted
            return response()->json();
        }

        $success = Storage::disk('musora_web_platform_s3')->delete($s3Path);

        if ($success) {
            return response()->json(['message' => 'Picture deleted successfully.']);
        }

        return response()->json(['error' => 'Failed to delete picture.'], 400);
    }

}
