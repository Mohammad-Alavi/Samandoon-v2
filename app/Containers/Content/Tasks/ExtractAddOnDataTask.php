<?php

namespace App\Containers\Content\Tasks;

use App\Containers\Content\Exceptions\AddOnTypeNotFoundException;
use App\Ship\Helpers\ArabicToPersianStringConverter;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Transporters\DataTransporter;

/**
 * Class ExtractAddOnDataTask
 *
 * @package App\Containers\Content\Tasks
 */
class ExtractAddOnDataTask extends Task
{

    /**
     * @param DataTransporter $transporter
     * @param string          $addOnName
     *
     * @return array
     */
    public function run(DataTransporter $transporter, string $addOnName): array
    {
        $temporaryTransporter = $transporter;
        switch ($addOnName) {
            case 'article':
                {
                    return $this->extractArticle($temporaryTransporter);
                    break;
                }
            case 'repost':
                {
                    return $this->extractRepost($temporaryTransporter);
                    break;
                }
            case 'link':
                {
                    return $this->extractLink($temporaryTransporter);
                    break;
                }
            case 'image':
                {
                    return $this->extractImage($temporaryTransporter);
                    break;
                }
            case 'subject':
                {
                    return $this->extractSubject($temporaryTransporter);
                    break;
                }
//            case 'poll':{
//                return $this->extractPoll($transporter);
//                break;
//            }
            default:
                throw new AddOnTypeNotFoundException('Add-on type not found: ' . $addOnName);
        }
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return array
     */
    private function extractArticle(DataTransporter $transporter): array
    {
        $sanitizedData = $transporter->sanitizeInput([
            'article.text',
        ]);
        if (array_key_exists('text', $sanitizedData['article'])) {
            $sanitizedData['article']['text'] = ArabicToPersianStringConverter::Convert($sanitizedData['article']['text']);
        };
        return empty($sanitizedData['article']) ? [] : $sanitizedData['article'];
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return array
     */
    private function extractRepost(DataTransporter $transporter): array
    {
        $sanitizedData = $transporter->sanitizeInput([
            'repost.referenced_content_id',
        ]);

        return empty($sanitizedData['repost']) ? [] : $sanitizedData['repost'];
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return array
     */
    private function extractLink(DataTransporter $transporter): array
    {
        $sanitizedData = $transporter->sanitizeInput([
            'link.link_url',
        ]);

        return empty($sanitizedData['link']) ? [] : $sanitizedData['link'];
    }

    /**
     * @param DataTransporter $transporter
     *
     * @return array
     */
    private function extractImage(DataTransporter $transporter): array
    {
        $sanitizedData = $transporter->sanitizeInput([
            'image.image',
        ]);

        return empty($sanitizedData['image']) ? [] : $sanitizedData['image'];
    }

    private function extractSubject(DataTransporter $transporter): array
    {
        $sanitizedData = $transporter->sanitizeInput([
            'subject.subject',
        ]);

        return empty($sanitizedData['subject']) ? [] : $sanitizedData['subject'];
    }
}
