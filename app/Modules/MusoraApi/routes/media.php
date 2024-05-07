<?php

use App\Modules\MusoraApi\Controllers\V5\PictureUploadController;

Route::as('musora-api.')
    ->prefix('/musora-api')
    ->middleware('web_or_api_authenticated')
    ->group(function () {
        Route::match(['post', 'put'], '/v5/picture/upload', [PictureUploadController::class, 'uploadPicture'])
            ->middleware('api_version:v5')
            ->name('v5.picture.upload');
        Route::match(
            ['post', 'put'],
            '/v5/picture/upload-from-s3',
            [PictureUploadController::class, 'uploadPictureFromS3']
        )
            ->middleware('api_version:v5')
            ->name('v5.picture.upload-from-s3');
        Route::delete('/v5/picture/delete', [PictureUploadController::class, 'deletePictureFromS3'])
            ->middleware('api_version:v5')
            ->name('v5.picture.delete');
    });
