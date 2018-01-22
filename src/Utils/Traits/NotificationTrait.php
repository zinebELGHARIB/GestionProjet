<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 25/08/2017
 * Time: 02:08
 */

namespace Utils\Traits;


trait NotificationTrait
{
    private $formater;

    public function __construct()
    {
        $this->formater = \IntlDateFormatter::create(
            'fr_FR',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::SHORT,
            (PHP_VERSION_ID >= 50500 ? (new \DateTime())->getTimezone() : (new \DateTime())->getTimezone()->getName()),
            \IntlDateFormatter::GREGORIAN
        );
    }

    function parseTamplate($string, array $data = []){
        return $this->get('twig')->createTemplate($string)->render($data);
    }

}