<?php

namespace App\Modules\EventTracking\tests\Unit;

use App\Modules\EventTracking\Avo\AvoHelper;
use Avo;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class AvoHelperTest extends TestCase
{
    public function test_platform_new_musora_app(): void
    {
        $platform = AvoHelper::getRequestPlatform("Musora/2.5.0/285 (iPad13,1 iPadOS/15.7)");
        assertEquals('musora-app', $platform);
    }

    public function test_platform_old_musora_app(): void
    {
        $platform = AvoHelper::getRequestPlatform("Musora/1.5.0/285 (iPad13,1 iPadOS/15.7)");
        assertEquals('musora-app-legacy', $platform);
    }

    public function test_platform_pianote_app(): void
    {
        $platform = AvoHelper::getRequestPlatform("Pianote/2.5.0/285 (iPad13,1 iPadOS/15.7)");
        assertEquals('pianote-app-legacy', $platform);
    }

    public function test_platform_web(): void
    {
        $platform = AvoHelper::getRequestPlatform("Firefox/1.5.0/285 (AppleKit)");
        assertEquals('web', $platform);
    }

    public function test_os_web(): void
    {
        $os = AvoHelper::getRequestOS("Firefox/1.5.0/285 (AppleKit)");
        assertEquals('web', $os);
    }

    public function test_os_ios(): void
    {
        $os = AvoHelper::getRequestOS("Musora/2.5.0/285 (iPad13,1 iPadOS/15.7)");
        assertEquals('ios', $os);
        $os = AvoHelper::getRequestOS("Musora/2.5.0/285 (iOS13,1 iOS/15.7)");
        assertEquals('ios', $os);
        $os = AvoHelper::getRequestOS("Musora/2.5.0/285 (iPhone)");
        assertEquals('ios', $os);
        $os = AvoHelper::getRequestOS("Musora/2.5.0/285 (CFNetwork)");
        assertEquals('ios', $os);
    }

    public function test_os_android(): void
    {
        $os = AvoHelper::getRequestOS("Firefox/1.5.0/285 (Android)");
        assertEquals('android', $os);
    }
}
