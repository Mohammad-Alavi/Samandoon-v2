<?php

namespace App\Containers\User\Notifications;


class KavenegarMessage {

    /**
     * @var string
     */
    public $template;

    /**
     * @var array
     */
    public $tokens;

    /**
     * KavenegarMessage constructor.
     * @param string $template
     * @param array $tokens
     */
    public function __construct(string $template, array $tokens) {
        $this->template = $template;
        $this->tokens = $tokens;
    }

}