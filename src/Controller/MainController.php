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

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
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
        
        if($guid==""){
        	//anonimus login
			return $this->redirectToRoute('app_login');		
        }
        
		if (!$settings1) {
			//die('нет настроек');
			//return $this->redirectToRoute('app_login');		
			/*
			throw $this->createNotFoundException(
				'No settings found for user '.$username
			);
			*/
			$algoritms = $this->getDoctrine()
			->getRepository(Algoritm::class)
			->findall();
			$marketplaces = $this->getDoctrine()
			->getRepository(Marketplace::class)
			->findall();
			// get default settings
			$algoritm=$algoritms[0]->getAlgoritmguid();
			$marketplace=$marketplaces[0]->getMarketguid();
		}else{
			$algoritm=$settings1->getAlgoritm();
			$marketplace=$settings1->getMarketplace();
			$apikey=$settings1->getApikey();
			$apisecret=$settings1->getApisecret();
		}
		
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
        
        
        $form1 = $this->createFormBuilder($data)->getForm();
		
        $form2 = $this->createFormBuilder($data)->getForm();
		
		$form = $this->createFormBuilder($data)
            ->add('algoritm', ChoiceType::class, array(
				'choices'  => $choicesAlgoritms,
				'data' => $algoritm
				))
            ->add('marketplace', ChoiceType::class, array(
				'choices'  => $choicesMarketplaces,
				'data' => $marketplace
				))
            ->add('apikey', TextType::class , array('data' => $apikey , 'attr' => array('size' => '125')))
            ->add('apisecret', TextType::class , array('data' => $apisecret , 'attr' => array('size' => '125')) )
            ->add('save', SubmitType::class, ['label' => 'Сохранить настройки'])
            ->getForm();
		
        $startid="ae5c5d78-c654-4fc7-9b8a-a507cf66396b";
        $stopid="ef460a61-67d2-4b33-818e-a74003026a19";
            
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT max(t.timestamp) FROM App\Entity\Actions t WHERE t.status in (0,1) and t.actionid in (\''.$startid.'\',\''.$stopid.'\') and t.userguid = \''.$userguid.'\'');
        $res = $query->getResult();
        
        $maxtime = $res[0][1];
        $maxtime = new \DateTime($maxtime);
        $maxtime=$maxtime->format("Y-m-d H:i:s");
        
        $qstr='SELECT t.guid,t.timestamp,t.userguid,t.actionid,t.status FROM App\Entity\Actions t WHERE t.status in (0,1) and t.actionid in (\''.$startid.'\',\''.$stopid.'\') and t.userguid = \''.$userguid.'\' and t.timestamp=\''.$maxtime.'\'';
        $query = $em->createQuery( $qstr );
        $res = $query->getResult();
        //die(print_r($res,true));
        
        if(count($res)>0){
			if($res[0]['actionid']==$startid and $res[0]['status']==0){
				$tradestate='запускаются';
			}
			if($res[0]['actionid']==$stopid and $res[0]['status']==0){
				$tradestate='останавливаются';
			}
			if($res[0]['actionid']==$startid and $res[0]['status']==1){
				$tradestate='запущены';
			}
			if($res[0]['actionid']==$stopid and $res[0]['status']==1){
				$tradestate='прекращены';
			}
        }else{
        	$tradestate='остановлены';
        }
        
		
		
		$states['trade'] = $tradestate;
		$states['balance'] = "0 рублей";
		$states['busybalance'] = "0 рублей";
		
		
		if('POST' === $request->getMethod()) {
			$form1->handleRequest($request); 
			$form2->handleRequest($request); 
			$form->handleRequest($request); 
			//die(print_r($request->request));
			if ($request->request->has('register')) {

				if ($form1->isSubmitted() && $form1->isValid()) {
					return $this->redirectToRoute('app_register');		
				}
			}

			if ($request->request->has('login')) {

				if ($form1->isSubmitted() && $form1->isValid()) {
					return $this->redirectToRoute('app_login');		
				}
			}
			
			if ($request->request->has('logout')) {

				if ($form1->isSubmitted() && $form1->isValid()) {
					return $this->redirectToRoute('app_logout');		
				}
			}
			
			if ($request->request->has('increase')) {

				if ($form2->isSubmitted() && $form2->isValid()) {
					return $this->redirectToRoute('adddeposit');		
				}
			}
			if ($request->request->has('decrease')) {

				if ($form2->isSubmitted() && $form2->isValid()) {
					return $this->redirectToRoute('withdrawdeposit');		
				}
			}
			if ($request->request->has('start')) {

				if ($form2->isSubmitted() && $form2->isValid()) {
					return $this->redirectToRoute('starttrades');		
				}
			}
			
			if ($request->request->has('stop')) {

				if ($form2->isSubmitted() && $form2->isValid()) {
					return $this->redirectToRoute('stoptrades');		
				}
			}
			
			if ($request->request->has('form')) {
				// handle the first form  
				
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
						$settings1->setApikey($settings->getApikey());
						$settings1->setApisecret($settings->getApisecret());
					}
					$em->flush();
					

					return $this->redirectToRoute('main', array('systemmessage' => "Настройки сохранены"));		
				}
				
			}
			
		}		

		$systemmessage = $request->query->get('systemmessage');
		
		return $this->render('main/index.html.twig', array( 'systemmessage' => $systemmessage , 'username' => $username , 'states' => $states , 'form' => $form->createView() , 'form1' => $form1->createView() , 'form2' => $form1->createView() )); 
	}
}
