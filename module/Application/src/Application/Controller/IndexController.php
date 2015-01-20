<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var FormInterface
     */
    protected $duoSelectForm;

    public function __construct(FormInterface $form)
    {
        $this->duoSelectForm = $form;
    }

    public function indexAction()
    {
        $form    = $this->duoSelectForm;
        $request = $this->getRequest();
        $vm      = new ViewModel();
        $status  = 'INITIALIZED';

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $status = 'VALID';
            } else {
                $status = 'INVALID';
            }
        }

        return $vm->setVariables([
            'form'   => $form,
            'status' => $status
        ]);
    }
}
