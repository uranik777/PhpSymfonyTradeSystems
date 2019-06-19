<?php
namespace App\Controller;

use App\Entity\Actions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Lib\LibWrapper;

class StopTrades extends AbstractController
{
    /**
     * @Route("/stoptrades", name="stoptrades")
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
		
		$lw=new LibWrapper();
		
		$action = new Actions();
		$action->setGuid( $lw->getGuid() );
		$action->setTimestamp( new \DateTime() );
		$action->setStatus( 0 );
		$action->setActionid( "ef460a61-67d2-4b33-818e-a74003026a19" );
		$action->setUserguid( $userguid );
		$action->setDetails( "" );
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($action);
        $entityManager->flush();
		
        $systemmessage = 'Запрос на прекращение торгов отправлен';
		
		return $this->redirectToRoute('main', array('systemmessage' => $systemmessage) );		
	}
}
