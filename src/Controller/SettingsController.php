<?php
namespace App\Controller;

use App\Entity\Settings;
use App\Entity\Algoritm;
use App\Entity\Marketplace;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SettingsController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     */
	public function new(Request $request)
	{
		$data = new Settings();
		
		$user=$this->get('security.token_storage')->getToken()->getUser();
		if( gettype($user) == 'object'){
			$username=$user->getUsername();
			$guid=$user->getGuid();
		}
		if( gettype($user) == 'string'){
			$username=$user;
			$guid="";
		}
		
		$userguid=$guid;
		
		
		$settings1 = $this->getDoctrine()
        ->getRepository(Settings::class)
        ->find($userguid);
        
		if (!$settings1) {
			throw $this->createNotFoundException(
				'No settings found for user '.$username
			);
		}
		
		$algoritm=$settings1->getAlgoritm();
		$marketplace=$settings1->getMarketplace();
		
		$algoritms = $this->getDoctrine()
        ->getRepository(Algoritm::class)
        ->findAll();
        
        foreach($algoritms as $obj){
	        $choicesAlgoritms[$obj->getName()] = $obj->getAlgoritmguid();
        }

		$marketplaces = $this->getDoctrine()
        ->getRepository(Marketplace::class)
        ->findAll();
        
        foreach($marketplaces as $obj){
	        $choicesMarketplaces[$obj->getName()] = $obj->getMarketguid();
        }

        
		$form = $this->createFormBuilder($data)
            ->add('algoritm', ChoiceType::class, array(
				'choices'  => $choicesAlgoritms,
				'data' => $algoritm
				))
            ->add('marketplace', ChoiceType::class, array(
				'choices'  => $choicesMarketplaces,
				'data' => $marketplace
				))
            ->getForm();
            		
		$form->handleRequest($request); 
		
		//Получаем данные введенные в форму. 
		//dump($form->getData()); 
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$settings = $form->getData();
			$settings->setUserguid($guid);
			//die(print_r($settings,true));

			$em = $this->getDoctrine()->getManager();
			if(!$settings1){
				$em->persist($settings);
			}else{
				$settings1->setAlgoritm($settings->getAlgoritm());
				$settings1->setMarketplace($settings->getMarketplace());
			}
			$em->flush();
			

			return $this->redirectToRoute('settings');		
        }
		
		return $this->render('settings.html.twig', array( 'form' => $form->createView() )); 
	}
}
