<?php
namespace SiteGrabber\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of SiteFormType
 *
 * @author Dudu <clement.duez@widop.com>
 */
class SiteFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', 'text')
            ->add('submit', 'submit');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => \SiteGrabber\MainBundle\Model\Site::class,
        ));
    }

    public function getName()
    {
        return 'siteType';
    }
}
