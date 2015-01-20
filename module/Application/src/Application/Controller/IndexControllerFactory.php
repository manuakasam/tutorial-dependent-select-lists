<?php
/**
 * @author Manuel Stosic <manuel.stosic@krankikom.de>
 */

namespace Application\Controller;

use Application\Form\FormWithTwoSelects;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realSl        = $serviceLocator->getServiceLocator();
        $formManager   = $realSl->get('FormElementManager');
        $duoSelectForm = $formManager->get(FormWithTwoSelects::class);

        return new IndexController($duoSelectForm);
    }
}