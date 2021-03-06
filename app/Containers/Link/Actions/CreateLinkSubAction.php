<?php

namespace App\Containers\Link\Actions;

use App\Containers\Link\Models\Link;
use App\Containers\Link\Tasks\CreateLinkTask;
use App\Ship\Parents\Actions\SubAction;

/**
 * Class CreateLinkSubAction
 *
 * @package App\Containers\Link\Actions
 */
class CreateLinkSubAction extends SubAction
{
    /**
     * @var CreateLinkTask $createLinkTask
     */
    protected $createLinkTask;

    /**
     * CreateExternalLinkSubAction constructor.
     *
     * @param CreateLinkTask $createLinkTask
     */
    public function __construct(CreateLinkTask $createLinkTask)
    {
        $this->createLinkTask = $createLinkTask;
    }

    /**
     * @param array  $data
     *
     * @param string $content_id
     *
     * @return Link
     */
    public function run(array $data, string $content_id): Link
    {
        $linkData = [
            'content_id' => $content_id,
            'link_url' => $data['link_url'],
        ];

        $link = $this->createLinkTask->run($linkData);
        return $link;
    }
}
