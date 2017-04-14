<?php
namespace App\Http\Controllers\Oauth;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;

class ClientRepository implements ClientRepositoryInterface
{
    use \League\OAuth2\Server\Entities\Traits\EntityTrait;
    use \League\OAuth2\Server\Entities\Traits\ClientTrait;

	/**
     * Get a client.
     *
     * @param string      $clientIdentifier   The client's identifier
     * @param string      $grantType          The grant type used
     * @param null|string $clientSecret       The client's secret (if sent)
     * @param bool        $mustValidateSecret If true the client must attempt to validate the secret if the client
     *                                        is confidential
     *
     * @return ClientEntityInterface
     */
    public function getClientEntity($clientIdentifier, $grantType, $clientSecret = null, $mustValidateSecret = true)
    {
        $this->setIdentifier('111');

    }






}