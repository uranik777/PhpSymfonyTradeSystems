<?php
namespace App\Controller;

use App\Entity\Withdrawals;
use App\Entity\Actions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class WithdrawDeposit extends AbstractController
{
    /**
     * @Route("/withdrawdeposit", name="withdrawdeposit")
     */
	public function new(Request $request)
	{
		
		$user=$this->get('security.token_storage')->getToken()->getUser();
		if( gettype($user) == 'object'){
			$username=$user->getUsername();
			$userguid=$user->getGuid();
		}
		if( gettype($user) == 'string'){
			$username=$user;
			$userguid="";
		}
		
		
		$data = new Withdrawals();
		$form = $this->createFormBuilder($data)
            ->add('amount', TextType::class, array(
				'data' => '0'
				))
            ->getForm();
            		
		$form->handleRequest($request); 
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$formdata = $form->getData();
			$formdata->setStatus(0);
			$formdata->setTimestamp( new \DateTime() );

			$em = $this->getDoctrine()->getManager();
			$em->persist($formdata);
			$em->flush();
			
			return $this->redirectToRoute('main',array('systemmessage' => "Заявка на вывод средств оформлена"));		
        }
		
		
		return $this->render('withdrawdeposit.html.twig', array( 'form' => $form->createView() )); 
	}
}
