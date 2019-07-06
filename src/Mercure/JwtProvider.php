<?php

namespace App\Mercure;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * Bearer token provider for Mercure.
 */
class JwtProvider {
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
     * @return Token
     */
    public function __invoke(): string {
        return (new Builder())
            ->set('mercure', [
                'publish' => ['*'],
            ])
            ->sign(new Sha256(), $this->secret)
            ->getToken()
            ->__toString();
    }
}
