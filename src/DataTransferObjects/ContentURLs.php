<?php

namespace Railroad\Railcontent\DataTransferObjects;

class ContentURLs
{
    private string $webURLPath = '';
    private string $mobileAppURLPath = '';

    /**
     * @param string $webURLPath
     * @param string $mobileAppURLPath
     */
    public function __construct(string $webURLPath, string $mobileAppURLPath)
    {
        $this->webURLPath = $webURLPath;
        $this->mobileAppURLPath = $mobileAppURLPath;
    }

    /**
     * @return string
     */
    public function getWebURLPath(): string
    {
        return $this->webURLPath;
    }

    /**
     * @return string
     */
    public function getMobileAppURLPath(): string
    {
        return $this->mobileAppURLPath;
    }
}