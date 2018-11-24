<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Exceptions\AddOnTypeNotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Transporters\DataTransporter;

class ExtractAddOnArrayTask extends Task {

    /**
     * @param DataTransporter $transporter
     * @param string          $addOnType
     *
     * @return array
     */
    public function run(DataTransporter $transporter, string $addOnType): array {

        switch ($addOnType) {
            case 'article':
                {
                    return $this->extractArticle($transporter);
                    break;
                }
//            case 'poll':{
//                return $this->extractPoll($transporter);
//                break;
//            }
            default:
                throw new AddOnTypeNotFoundException();
        }
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return array
     */
    private function extractArticle(DataTransporter $transporter): array {
        $sanitizedData = $transporter->sanitizeInput([
            'article.title',
            'article.text',
        ]);

        return $sanitizedData['article'];
    }
}
