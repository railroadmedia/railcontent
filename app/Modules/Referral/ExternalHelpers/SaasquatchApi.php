<?php

namespace App\Modules\Referral\ExternalHelpers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use App\Modules\Referral\Exceptions\NotFoundException;
use App\Modules\Referral\Exceptions\ReferralException;
use App\Modules\Referral\Exceptions\SaasquatchException;
use App\Modules\Referral\Exceptions\SaasquatchUserExistsException;

class SaasquatchApi
{
    public const BASE_URI = 'https://app.referralsaasquatch.com';

    /**
     * @var Client
     */
    protected $httpClient;

    protected $saasquatchApiKey;
    protected $saasquatchTenantAlias;
    protected $saasquatchReferralProgramId;

    /**
     * SaasquatchApi constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client(['base_uri' => self::BASE_URI]);

        $this->saasquatchApiKey = config('referral.saasquatch_api_key');
        $this->saasquatchTenantAlias = config('referral.saasquatch_tenant_alias');
        $this->saasquatchReferralProgramId = config('referral.saasquatch_referral_program_id');
    }

    /**
     *
     *
     * @throws ReferralException
     * @throws SaasquatchException
     * @throws SaasquatchUserExistsException
     */
    public function createUser(int $userId): object
    {
        $method = 'POST';
        $pathFormat = '/api/v1/%s/open/account/%s/user/%s?fields=';
        $path = sprintf($pathFormat, $this->saasquatchTenantAlias, $userId, $userId);

        $requestJsonBody = [
            'id' => $userId,
            'accountId' => $userId,
        ];

        return $this->sendRequest($method, $path, $requestJsonBody);
    }

    /**
     *
     *
     * @throws NotFoundException
     * @throws ReferralException
     * @throws SaasquatchException
     */
    public function getUser(int $userId): object
    {
        $method = 'GET';
        $pathFormat = '/api/v1/%s/open/account/%s/user/%s?fields=';
        $path = sprintf($pathFormat, $this->saasquatchTenantAlias, $userId, $userId);

        $user = $this->sendRequest($method, $path);

        return $user;
    }


    /**
     *
     *
     * @throws NotFoundException
     * @throws ReferralException
     * @throws SaasquatchException
     *
     * @description : https://docs.saasquatch.com/api/methods#get_shareurls
     */
    public function getShareUrlsFromUser(int $userId, string $brand): object
    {
        $pathFormat = "/api/v1/%s/open/account/%s/user/%s/shareurls?programId=%s";
        $path = sprintf($pathFormat, $this->saasquatchTenantAlias, $userId, $userId, $this->saasquatchReferralProgramId[$brand]);
        return $this->sendRequest("GET", $path);
    }


    /**
     *
     *
     * @throws NotFoundException
     * @throws ReferralException
     * @throws SaasquatchException
     *
     * @description : https://docs.saasquatch.com/api/methods#open_user_upsert
     * @description : https://docs.saasquatch.com/graphql/reference
     */
    public function upsertUserUsingGraphqlAPI(int $userId): object
    {
        $path = sprintf("api/v1/%s/graphql", $this->saasquatchTenantAlias);

        $requestJsonBody =
            "mutation {
                upsertUser(
                userInput: {
                    id: \"". $userId ."\"
                    accountId: \"" . $userId . "\"
                    }
                ) {
                    id
                    accountId,
                    referralCodes
                }
            }";

        return $this->sendRequest("POST", $path, $requestJsonBody);
    }

    /**
     *
     * @throws ReferralException
     * @throws SaasquatchException
     */
    public function getUsers(): object
    {
        $method = 'GET';
        $pathFormat = '/api/v1/%s/users';
        $path = sprintf($pathFormat, $this->saasquatchTenantAlias);

        return $this->sendRequest($method, $path);
    }

    /**
     *
     * @throws NotFoundException
     * @throws ReferralException
     * @throws SaasquatchException
     */
    public function removeUser(int $userId)
    {
        $method = 'DELETE';
        $pathFormat = '/api/v1/%s/open/account/%s/user/%s';
        $path = sprintf($pathFormat, $this->saasquatchTenantAlias, $userId, $userId);

        $this->sendRequest($method, $path);
    }

    /**
     *
     *
     * @throws ReferralException
     * @throws SaasquatchException
     * @throws SaasquatchUserExistsException
     */
    public function updateUser(int $userId): object
    {
        $method = 'PUT';
        $pathFormat = '/api/v1/%s/open/account/%s/user/%s?fields=';
        $path = sprintf($pathFormat, $this->saasquatchTenantAlias, $userId, $userId);

        $requestJsonBody = [
            'id' => $userId,
            'accountId' => $userId,
        ];

        return $this->sendRequest($method, $path, $requestJsonBody);
    }


    /**
     * @param $userId
     * @param $referralCode
     * @throws NotFoundException
     * @throws ReferralException
     * @throws SaasquatchException
     * @throws SaasquatchUserExistsException
     */
    public function applyReferralCode($userId, $referralCode): object
    {
        $method = 'POST';
        $pathFormat = '/api/v1/%s/open/code/%s/account/%s/user/%s?fields=';
        $path = sprintf($pathFormat, $this->saasquatchTenantAlias, $referralCode, $userId, $userId);

        return $this->sendRequest($method, $path, []);
    }

    /**
     *
     *
     * @throws NotFoundException
     * @throws ReferralException
     * @throws SaasquatchException
     * @throws SaasquatchUserExistsException
     */
    public function sendRequest(string $method, string $path, array $requestJsonBody = null, string $requestBody = null): object
    {
        $requestData = [RequestOptions::AUTH => ['', $this->saasquatchApiKey]];

        if (!empty($requestJsonBody)) {
            $requestData[RequestOptions::JSON] = $requestJsonBody;
        } elseif (!empty($requestBody)) {
            $requestData[RequestOptions::BODY] = $requestBody;
        }

        $result = null;

        try {
            $response = $this->httpClient->request(
                $method,
                $path,
                $requestData
            );

            $result = json_decode($response->getBody()->getContents());
        } catch (ClientException $cex) {
            if ($cex->getCode() == 404) {
                $message = 'Entity not found';

                if ($cex->getResponse() instanceof Response) {
                    try {
                        $responseContents = $cex->getResponse()->getBody()->getContents();
                        $responseData = json_decode($responseContents);
                        $message = $responseData->message;
                    } catch (Exception $e) {
                    }
                }

                throw new NotFoundException($message);
            }
            if ($cex->getCode() == 400 && $cex->getResponse() instanceof Response) {
                $message = null;

                try {
                    $responseContents = $cex->getResponse()->getBody()->getContents();
                    $responseData = json_decode($responseContents);
                    $message = $responseData->message;
                } catch (Exception $e) {
                }

                if ($message == 'User already exists') {
                    throw new SaasquatchUserExistsException();
                }
            }

            throw new ReferralException($cex->getMessage(), $cex->getCode());
        } catch (ServerException $serEx) {
            $message = $serEx->getMessage();

            if ($serEx->getResponse() instanceof Response) {
                try {
                    $responseContents = $serEx->getResponse()->getBody()->getContents();
                    $responseData = json_decode($responseContents);
                    $message = $responseData->message;
                } catch (Exception $e) {
                }
            }

            throw new SaasquatchException($message, $serEx->getCode());
        } catch (Exception $ex) {
            throw new ReferralException($ex->getMessage(), $ex->getCode());
        }

        return $result;
    }
}
