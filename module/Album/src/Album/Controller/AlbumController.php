<?php
/**
 * Created by JetBrains PhpStorm.
 * User: John
 * Date: 21/04/13
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Di\Di;
use Album\Model\Album;          // <-- Add this import
use Album\Form\AlbumForm;       // <-- Add this import
use Doctrine\ORM\EntityManager;

class AlbumController extends AbstractActionController
{
    protected $albumTable;
    protected $em;

    public function __construct($sm, $calendar) {
        $this->sm = $sm;
        $this->calendar = $calendar;
    }

    public function indexAction()
    {

        $view =  new ViewModel(array(
            'albums' => $this->getEntityManager()->getRepository('Album\Entity\Album')->findAll(),
            'calendar' => $this->calendar
        ));

        return $view;
    }

    // Add content to this method:
    public function addAction()
    {
        $form = new AlbumForm();
        $formValidator = new \Album\Form\AlbumFormValidator();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new \Album\Entity\Album();
            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->exchangeArray($form->getData());

                $this->getEntityManager()->persist($album);
                $this->getEntityManager()->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return array('form' => $form);
    }


    public function editAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }



        // Get the Album with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $album = $this->getAlbumTable()->getAlbum($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'index'
            ));
        }



        $form  = new AlbumForm();

        $form->bind($album);

        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());



            if ($form->isValid()) {

                $this->getAlbumTable()->saveAlbum($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }


        return array(
            'id' => $id,
            'form' => $form
        );
    }

    public function deleteAction()
    {
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
}
