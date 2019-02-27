<?php

namespace App\Containers\Tag\Tasks;

use App\Containers\Tag\Models\Tag;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class GetTrendingTagsTask extends Task
{
    public function run(array $data)
    {
        // TODO Optimize GetTrendingTags query
        // we get the id's of top used tags in a query
        $trendingTagsQuery = DB::table('taggables')
            ->selectRaw('count(*) as total, tag_id')
            ->latest('total')
            ->limit(10)
            ->groupBy('tag_id');
//            ->pluck('total','tag_id')->all();;

        // add time query scope
        switch ($data['period']) {
            case 'day':
                $trendingTagsQuery->whereBetween('created_at', [Carbon::now()->subDay(1), Carbon::now()]);
                break;
            case 'week':
                $trendingTagsQuery->whereBetween('created_at', [Carbon::now()->subWeek(1), Carbon::now()]);
                break;
        }

        // here we add the prev query to this one and get the tag models
        $getTagsQuery = Tag::joinSub($trendingTagsQuery, 'trendingTags', function (JoinClause $join) {
            $join->on('tags.id', '=', 'trendingTags.tag_id');
        });

        // here we only include tags with the specified tag_type
        $content_tag_type = config('samandoon.tag_type.content');
        $subject_tag_type = config('samandoon.tag_type.subject');
        switch ($data['tag_type']) {
            case $content_tag_type:
                $getTagsQuery->where('type', $content_tag_type);
                break;
            case $subject_tag_type:
                $getTagsQuery->where('type', $subject_tag_type);
                break;
        }

        return $getTagsQuery->orderByDesc('trendingTags.total')->paginate();
    }
}
