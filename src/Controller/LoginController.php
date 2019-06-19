<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
	public function login(AuthenticationUtils $authenticationUtils): Response
	{
		// получить ошибку входа, если она есть
		$error = $authenticationUtils->getLastAuthenticationError();

		// последнее имя пользователя, введенное пользователем(чтобы повторно не набирать)
		$lastUsername = $authenticationUtils->getLastUsername();
		
    	$user=$this->get('security.token_storage')->getToken()->getUser();
    	if( gettype($user) == 'object'){
	    	$username=$user->getUsername();
	    	$guid=$user->getGuid();
    	}
    	if( gettype($user) == 'string'){
	    	$username=$user;
	    	$guid="";
    	}
		
    	if($username=='anon.'){
			return $this->render('security/login.html.twig', [
				'last_username' => $lastUsername,
				'error' => $error
			]);
    	}else{
    		// user already login
    		return $this->redirectToRoute('main');
    	}

	}
}
