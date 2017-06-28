<?php
namespace app\Listeners;
use Laravel\Passport\Events\RefreshTokenCreated;
use Laravel\Passport\Token;
use DB;

class PruneOldTokens {

    /**
     * Handle the event.
     *
     * @param  RefreshTokenCreated  $event
     * @return void
     */
    public function handle(RefreshTokenCreated $event)
    {
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', '!=', $event->accessTokenId)
            ->where('revoked', true)->delete();
    }


}
