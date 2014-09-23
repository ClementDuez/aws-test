<?php

namespace SiteGrabber\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SiteGrabber\MainBundle\Form\Type\SiteFormType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SiteGrabberController extends Controller
{
    public function indexAction()
    {
        $form = $this->createForm(new SiteFormType());
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $fs = new Filesystem();
            $url = $form->getData()->getUrl();
            $data = file_get_html($url);
            $images = array();

            foreach($html->find('img') as $element) {
                $path = '/tmp/aws/'.$url.'/'.preg_match('#^/*+.(jpg|jpeg|png)#', $element->src);
                $images[] = $path;
                $fs->dumpFile($path, file_get_contents($element->src));
             }

             $zip = new \ZipArchive();

             foreach ($images as $image)
             {
                 $zip->addFile($image);
             }

             return new BinaryFileResponse($zip);
        }

        return $this->render('SiteGrabberMainBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
}
