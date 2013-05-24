<?php

namespace Recruiter\EmployerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Recruiter\EmployerBundle\Entity\Employer;
use Recruiter\EmployerBundle\Form\EmployerType;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Recruiter\CommonBundle\Services\CsvExporter;
use Exporter\Exception\InvalidMethodCallException;

/**
 * Employer controller.
 *
 */
class EmployerController extends Controller
{
	public function exportAction()
	{
		$employers = $this->getDoctrine()->getEntityManager()->getRepository('RecruiterEmployerBundle:Employer')->findAll();
	
		$csv = new CsvExporter();
		$csv->setColumnHeaders(array("Employer name", "Email address"));
		
		$users = $employer->getEmployerUsers();
	
		foreach ($employers as $employer) {
			$row = array(
					"employer_name" => $employer->getEmployerName(),
					"email_address" => $users[0]->getUser()->getEmail()
			);
				
			$csv->addRow($row);
		}
	
		$csv->doExport();
	}
	
    /**
     * Lists all Employer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RecruiterEmployerBundle:Employer')->fetchLatest();
        $allemployers = $em->getRepository('RecruiterEmployerBundle:Employer')->fetchNames();

        return $this->render('RecruiterEmployerBundle:Employer:index.html.twig', array(
            'entities' => $entities,
        	'employer_names' => $allemployers
        ));
    }
    
    public function searchAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$allemployers = $em->getRepository('RecruiterEmployerBundle:Employer')->fetchNames();
    	$searchedTerm = $this->getRequest()->get("employer_search");
    	
    	if (!$searchedTerm) {
    		throw new InvalidParameterException("You must supply a search term");
    	}
    	
    	$employers = $em->getRepository("RecruiterEmployerBundle:Employer")->fetchWhereNameLike($searchedTerm);
    	
    	return $this->render("RecruiterEmployerBundle:Employer:search_results.html.twig", array("employers" => $employers, "employer_names" => $allemployers));
    }

    /**
     * Finds and displays a Employer entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RecruiterEmployerBundle:Employer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RecruiterEmployerBundle:Employer:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Employer entity.
     *
     */
    public function newAction()
    {
        $entity = new Employer();
        $form   = $this->createForm(new EmployerType(), $entity);

        return $this->render('RecruiterEmployerBundle:Employer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    /**
     * Finds an Employer entity, sets it's subscription start date to time() and saves.
     * 
     * @param integer $id
     * @throws InvalidMethodCallException
     */
    public function extendAction($id)
    {
    	if ($this->getRequest()->getMethod() !== "POST") {
    		throw new InvalidMethodCallException("You cannot access this screen in this way");
    	}
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$employer = $em->getRepository("RecruiterEmployerBundle:Employer")->find($id);
    	
    	if (!$employer instanceof Employer) {
    		throw $this->createNotFoundException("Employer account not found.");
    	}
    	
    	$em->persist($employer);
    	
    	$employer->setEmployerSubscriptionActivationDate(time());
    	
    	$em->flush();
    	
    	$this->addFeedback();
    	
    	return $this->redirect($this->generateUrl("employers_show", array("id" => $employer->getId())));
    }

    /**
     * Creates a new Employer entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Employer();
        $form = $this->createForm(new EmployerType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employers_show', array('id' => $entity->getId())));
        }

        return $this->render('RecruiterEmployerBundle:Employer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function addFeedback()
    {
    	$this->get('session')->getFlashBag()->add('success', "Your changes have been saved.");
    }

    /**
     * Displays a form to edit an existing Employer entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
        $allemployers = $em->getRepository('RecruiterEmployerBundle:Employer')->fetchNames();
        $entity = $em->getRepository('RecruiterEmployerBundle:Employer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employer entity.');
        }

        $editForm = $this->createForm(new EmployerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RecruiterEmployerBundle:Employer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        	'employer_names' => $allemployers
        ));
    }

    /**
     * Edits an existing Employer entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RecruiterEmployerBundle:Employer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EmployerType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            // $entity->setEmployerUpdatedAt(time());
            $em->flush();
            
            $this->addFeedback();

            return $this->redirect($this->generateUrl('employers_edit', array('id' => $id)));
        }

        return $this->render('RecruiterEmployerBundle:Employer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Employer entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RecruiterEmployerBundle:Employer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Employer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('employers'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
