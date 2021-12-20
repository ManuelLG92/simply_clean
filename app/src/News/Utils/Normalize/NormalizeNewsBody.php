<?php

namespace App\News\Utils\Normalize;

use App\News\Utils\NewsConstants;
use Symfony\Component\HttpFoundation\Request;

class NormalizeNewsBody
{
    public static function get(Request $request): array
    {
        return [
            NewsConstants::TITLE->value => $request->request->get(NewsConstants::TITLE->value),
            NewsConstants::CONTENT->value => $request->request->get(NewsConstants::CONTENT->value),
        ];
    }

}