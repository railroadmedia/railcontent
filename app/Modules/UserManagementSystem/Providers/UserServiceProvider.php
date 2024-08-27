<?php

namespace Modules\UserManagementSystem\Providers;

use Carbon\Carbon;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\RememberToken;
use Modules\UserManagementSystem\Models\User;

class UserServiceProvider extends EloquentUserProvider
{
    /**
     * @var Hasher
     */
    protected $hasher;

    protected array $internalIdentifierCache = [];

    /**
     * @return void
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;

        parent::__construct($hasher, null);
    }

    public function createModel(): User
    {
        return new User();
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     */
    public function retrieveById($identifier): ?Authenticatable
    {

        if (empty($this->internalIdentifierCache[$identifier])) {
            $model = $this->createModel();

            $result = $this->newModelQuery($model)
                ->where($model->getAuthIdentifierName(), $identifier)
                ->first();
        }

        if (!empty($result)) {
            $this->internalIdentifierCache[$identifier] = $result;
        }

        return $this->internalIdentifierCache[$identifier];
    }

    /**
     * @param mixed $identifier
     */
    public function retrieveByToken($identifier, $token): ?User
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
     */
    public function updateRememberToken(Authenticatable $user, $token): bool
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
        RememberToken::query()->where(['token' => $token, 'user_id' => $userId])->delete();
    }

    public function updateSessionSalt(Authenticatable $user, string $salt): bool
    {
        // NOTE: session salt is no longer used for anything

        return true;
    }

    /**
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

    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}
