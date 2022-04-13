<?php

namespace Modules\UserManagementSystem\Providers;

use Carbon\Carbon;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\RememberToken;
use Modules\UserManagementSystem\Models\User;

/**
 * @method User retrieveById($identifier)
 */
class UserServiceProvider extends EloquentUserProvider
{
    /**
     * @var Hasher
     */
    protected $hasher;

    /**
     * @param Hasher $hasher
     * @return void
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;

        parent::__construct($hasher, null);
    }

    /**
     * @return User
     */
    public function createModel()
    {
        return new User();
    }

    /**
     * @param mixed $identifier
     * @param string $token
     * @return null|User
     */
    public function retrieveByToken($identifier, $token)
    {
        $user = $this->retrieveById($identifier);

        if (!$user) {
            return null;
        }

        $rememberTokens = $user->rememberTokens;

        foreach ($rememberTokens as $rememberToken) {
            if (!empty($rememberToken->token) == hash_equals($rememberToken->token, $token) &&
                $rememberToken->expires_at > Carbon::now()) {
                return $user;
            }
        }

        return null;
    }

    /**
     * @param Authenticatable|User $user
     * @param string $token
     * @return bool
     */
    public function updateRememberToken(Authenticatable|User $user, $token)
    {
        $rememberToken = new RememberToken();

        $rememberToken->token = Str::random(60);
        $rememberToken->device_information = request()->userAgent() . '|' . request()->ip();
        $rememberToken->expires_at = Carbon::now()
            ->addSeconds(config('user_management_system.remember_me_token_expiration_time'));
        $rememberToken->user()->associate($user);
        $rememberToken->save();

        $user->setRememberToken($rememberToken->token);

        return true;
    }

    /**
     * @param $token
     * @param $userId
     */
    public function deleteRememberToken($token, $userId)
    {
        RememberToken::query()->where(['token' => $token, 'user' => $userId])->delete();
    }

    /**
     * @param Authenticatable $user
     * @param string $salt
     * @return bool
     */
    public function updateSessionSalt(Authenticatable $user, $salt)
    {
        $user = User::query()->find($user->getAuthIdentifier());

        if (!is_null($user)) {
            $user->session_salt = $salt;

            $user->save();

            return true;
        }

        return false;
    }

    /**
     * @param array $credentials
     * @return Authenticatable|User|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) || (count($credentials) === 1 && array_key_exists('password', $credentials))) {
            return null;
        }

        $getByAttributes = [];

        foreach ($credentials as $key => $value) {
            if (!Str::contains($key, 'password')) {
                $getByAttributes[$key] = $value;
            }
        }

        return User::query()->where($getByAttributes)->first();
    }

    /**
     * @param Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}
