<?php
namespace App\Controller;

use App\Entity\Actions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AddDeposit extends AbstractController
{
    /**
     * @Route("/adddeposit", name="adddeposit")
     */
	public function main()
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
		
		return $this->render('adddeposit.html.twig', array( )); 
	}
}
