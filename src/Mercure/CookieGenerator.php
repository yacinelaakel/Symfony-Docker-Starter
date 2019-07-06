<?php

namespace App\Mercure;

use App\Entity\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha384;

/**
 * Authenticate cookie generator for Mercure.
 *
 * @see https://github.com/dunglas/mercure/blob/master/spec/mercure.md#authorization
 */
class CookieGenerator {
    /**
     * @var string
     */
    private $secret;

    /**
     * @param string $secret
     */
    public function __construct(string $secret) {
        $this->secret = $secret;
    }

    /**
     * @param User $user
     *
     * @return string
     */
    public function generate(User $user): string {
        $token = (new Builder())
            ->set('mercure', [
                'subscribe' => [
                    $_ENV['MERCURE_EXTERNAL_URL'].'/user/'.$user->getId(),
                ],
            ])
            ->sign(new Sha384(), $this->secret)
            ->getToken()
            ->__toString();
        return 'mercureAuthorization='.$token.'; Path=/; HttpOnly;';
    }
}
