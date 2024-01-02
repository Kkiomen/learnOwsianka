<?php

namespace App\Data\SocialMedia;

class SocialMediaUrl
{
    public static function getSocialUrl(SocialMediaType $type): ?string
    {
        $language = env('LANGUAGE');

        if ($language == 'pl') {

            return match ($type) {
                SocialMediaType::FACEBOOK => 'https://www.facebook.com/profile.php?id=61554687617246',
                default => null
            };

        } elseif ($language == 'en') {

            return match ($type) {
                SocialMediaType::FACEBOOK => 'https://www.facebook.com/profile.php?id=61555213913126',
                default => null
            };

        }

        return null;
    }
}
