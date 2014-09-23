<?php
namespace SiteGrabber\MainBundle\Model;

/**
 * Description of Site
 *
 * @author Dudu <clement.duez@widop.com>
 */
class Site
{
    private $url;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
}
