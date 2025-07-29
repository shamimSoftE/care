<?php

use App\Models\blog;
use Carbon\Carbon;

function publishSchedulePost()
{
    $posts = blog::whereDate('publishDate', '<=' ,Carbon::today())->get();

    foreach ($posts as $post) {
        blog::find($post->id)->update([
            'publishDate' => Null,
            'type' => 1,
        ]);
    }
}
