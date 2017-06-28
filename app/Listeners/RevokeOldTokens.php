<?php
namespace app\Listeners;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Token;
use Carbon\Carbon;
use DB;
class RevokeOldTokens {

    /**
    * Handle the event.
    *
    * @param  AccessTokenCreated  $event
    * @return void
    */
    public function handle(AccessTokenCreated $event)
    {
        $tokens = Token::where('id', '!=', $event->tokenId)
            ->where('user_id', $event->userId)
            ->where('client_id', $event->clientId)
            // ->where('expires_at', '<', Carbon::now())
            ->orWhere('revoked', true)
            ->get();
        foreach ($tokens as $token) {
            $token->delete();
            DB::table('oauth_refresh_tokens')
            ->where('access_token_id', '=', $token->id)
            ->delete();
        }
    }


}
