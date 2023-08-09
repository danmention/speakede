<?php

namespace App\Services\zoom;

use App\Enums\HttpMethod;
use App\Helpers\CommonHelpers;
use App\Services\AbstractCallClient;

class ZoomServiceImpl extends AbstractCallClient
{

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    protected function initialize(): void
    {
      $CLIENT_ID =   config("zoom.credentials.client_id");
      $CLIENT_SECRET = config("zoom.credentials.client_secret");
        $this->addHeaders([
             "Authorization" => "Basic ". base64_encode($CLIENT_ID.':'.$CLIENT_SECRET)
        ]);
    }

    public function getAccessToken(): array
    {
        $ACCOUNT_ID = config("zoom.credentials.account_id");
        $url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=".$ACCOUNT_ID;
        return $this->callClient(HttpMethod::POST, $url);

    }

    public function bookMeeting(): array
    {
        $url = "https://zoom.us/v2/users/me/meetings";
        $accessToken = $this->getAccessToken();

        $this->addHeaders([
            "Authorization" => "Bearer ".$accessToken["access_token"]
        ]);
          $request = array(
                'topic' => "test Meeting",
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => CommonHelpers::toZoomTimeFormat("2023-08-05 14:05:45"),
                'duration' => 30,
                'agenda' => "My meeting",
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ]
          );

        return $this->callClient(HttpMethod::POST, $url, $request);
    }
}
