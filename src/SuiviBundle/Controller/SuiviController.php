<?php

namespace SuiviBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use GUBundle\Entity\Utilisateur;
use SuiviBundle\Entity\ActiviteSportif;
use SuiviBundle\Entity\LigneRegime;
use SuiviBundle\Entity\Regime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Tests\Fixtures\ToString;

class SuiviController extends Controller
{

    public function affecterRegimeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $activites=$this->getDoctrine()
            ->getRepository(ActiviteSportif::class)
            ->findAll();
        $utilisateur=$this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findByIdUser($user->getUsername());
        $regime=$this->getDoctrine()
            ->getRepository(Regime::class)
            ->find($id);
        $testLR=$this->getDoctrine()->getRepository(LigneRegime::class)->testLR($utilisateur,$regime);
        if ($utilisateur->getRegime() && $utilisateur->getRegime() != $regime && $testLR->getEtat()=="actif")

            return $this->render('SuiviBundle:Client:TuAsDejaUnRegime.html.twig');
        else if ($utilisateur->getRegime() == null  && $testLR == null )
        {
            $utilisateur->setRegime($regime);
            $em->flush();
            $lr = new LigneRegime();
            $lr->setUser($utilisateur);
            $lr->setRegime($regime);
            $debut = $lr->getDatedeb();
            $lr->setDatefin($debut->add(new \DateInterval('P'.$lr->getRegime()->getDuree().'D')));
            $lr->setDatedeb(new \DateTime());
            $lr->setEtat("actif");
            $em->persist($lr);
            $em->flush();
            //dump($lr);
            //die;
                return $this->render('SuiviBundle:Client:Suivi.html.twig', array(
                    'activities'=>$activites,
                    'lr'=>$lr,
                    'regime'=>$regime
              ));
            }
            else
        //else if ($utilisateur->getRegime() && $utilisateur->getRegime() != $regime )
        {

            return $this->render('SuiviBundle:Client:Suivi.html.twig', array(
                'activities'=>$activites,
                'lr'=>$testLR,
                'regime'=>$regime
            ));
        }

    }

    public function abondonnerRegimeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $utilisateur=$this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findByIdUser($user->getUsername());
        $regime=$this->getDoctrine()
            ->getRepository(Regime::class)
            ->find($id);
        $testLR=$this->getDoctrine()->getRepository(LigneRegime::class)->testLR($utilisateur,$regime);
        $em->remove($testLR);
        $utilisateur->setRegime(null);
        $em->flush();
        return $this->redirectToRoute("client_readRegimes");


    }

    public function calculerCaloriesAction($minutes,$met,$poids)
    {
                $calories = ($minutes * 3.5 * $poids * $met) / 200;
        return new JsonResponse(array("calories"=>number_format((float)$calories, 2, '.', '')));

    }

    public function calculerIMCAction($taille,$poids)
    {
        $imc = $poids / (($taille/100) * ($taille/100));
        return new JsonResponse(array("imc"=>number_format((float)$imc, 2, '.', '')));
    }

    public function calculerPoidIdealAction($taille,$sexe)
    {
        if ($sexe == "Homme")
            $poids_ideal = $taille-100-(($taille -150)/4);
        else
            $poids_ideal=$taille-100-(($taille -150)/2.5);
        return new JsonResponse(array("poids_ideal"=>$poids_ideal));

    }


    public function regimeDejaAction()
    {
        return $this->render('SuiviBundle:Client:TuAsDejaUnRegime.html.twig');
    }
}
