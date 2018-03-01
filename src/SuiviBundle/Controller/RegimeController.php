<?php

namespace SuiviBundle\Controller;

use GUBundle\Entity\Utilisateur;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use SuiviBundle\Entity\AimesRegimes;
use SuiviBundle\Entity\Regime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class RegimeController extends Controller
{
    public function indexAction()
    {
        $user=$this->getUser();
        $nutri = $this->getDoctrine()->getRepository(Utilisateur::class)
            ->find($user->getId());
        $regimesLikes= $this->getDoctrine()->getRepository(AimesRegimes::class)->findLastLikes($user);
        $mostLikedRegime= $this->getDoctrine()->getRepository(AimesRegimes::class)->findMostLikes();

        //dump($regimesLikes);
        //die;
        return $this->render('SuiviBundle:Profile:home.html.twig',array('user'=>$nutri,
            'regimeslikes'=>$regimesLikes));
    }

    public function readFrontAllRegimeAction()
    {
        $regimes = $this->getDoctrine()
            ->getRepository(Regime::class)
            ->findAll();
        return $this->render('SuiviBundle:Client:readFoAllregimes.html.twig', ['regimes' => $regimes]);
    }

    public function readAllRegimeAction()
    {
        $user = $this->getUser();
        $idnutri = $user->getId();
        $regimes = $this->getDoctrine()
            ->getRepository(Regime::class)
            ->findByIdNutri($idnutri);
        return $this->render('SuiviBundle:Profile:readAllregimes.html.twig', ['regimes' => $regimes]);
    }

    public function createRegimeAction(Request $request)
    {
        $regime = new Regime();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder($regime)
            ->add('titre', TextType::class)
            ->add('description', FroalaEditorType::class)
            ->add('type', ChoiceType::class, array(
                'label' => 'Type',
                'choices' => array(
                    'Régime minceur' => 'Régime minceur',
                    'Régime sportif' => 'Régime sportif',
                    'Régime végétarien' => 'Régime Végétarien'
                ),
                'required' => true,
                'multiple' => false,))
            ->add('duree',TextType::class)
            ->add('img', FileType::class ,array('label' => 'inserez une image'))
            ->add('Ajouter', SubmitType::class, array('label' => 'Ajouter'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $regime->setNutritionniste($user);

            /** @var UploadedFile $file
             */
            $file = $regime->getImg();

            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('image_directory', $fileName),
                $fileName
            );
            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $regime->setImg($fileName);

            //$regime->setDate(new DateTime());
            $regime = $form->getData();

            $em->persist($regime);
            $em->flush();
            return $this->redirectToRoute("profile_readAllregime");
        }

        return $this->render('SuiviBundle:Profile:Addregime.html.twig', array('form' => $form->createView()
            // ...
        ));
    }


    public function readRegimeAction(Request $request, $id)
    {
        $id = $request->attributes->get('id');
        $regime = $this->getDoctrine()
            ->getRepository(Regime::class)
            ->find($id);
        return $this->render('@Suivi/Profile/readRegime.html.twig', ['regime' => $regime]);
    }

    public function updateRegimeAction(Request $request, $id)
    {
        $regime = new Regime();
        $em = $this->getDoctrine()->getManager();
        $regime = $em->getRepository(Regime::class)->find($id);
        $form = $this->createFormBuilder($regime)
            ->add('titre', TextType::class)
            ->add('description', FroalaEditorType::class)
            ->add('type', ChoiceType::class, array(
                'label' => 'Type',
                'choices' => array(
                    'Régime minceur' => 'Régime minceur',
                    'Régime sportif' => 'Régime sportif',
                    'Régime végétarien' => 'Régime Végétarien'
                ),
                'required' => true,
                'multiple' => false,))
            ->add('Ajouter', SubmitType::class, array('label' => 'Save Changes'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $regime = $form->getData();
            $em->flush();
            return $this->redirectToRoute("profile_readAllregime");
        }

        return $this->render('@Suivi/Profile/Addregime.html.twig', array('form' => $form->createView()
        ));
    }

    public function deleteRegimeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $regime = $em->getRepository(Regime::class)->find($id);
        $em->remove($regime);
        $em->flush();
        return $this->redirectToRoute('profile_readAllregime');


    }

    public function readRegimeFOAction(Request $request, $id)
    {   $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $id = $request->attributes->get('id');
        $regime = $this->getDoctrine()
            ->getRepository(Regime::class)
            ->find($id);
        $nutri = $this->getDoctrine()->getRepository(Utilisateur::class)
            ->find($regime->getNutritionniste());
        $nblikes= $this->getDoctrine()->getRepository(AimesRegimes::class)
            ->nombreLikes($regime);
        $test= $this->getDoctrine()->getRepository(AimesRegimes::class)
            ->testLike($regime,$user);
        //var_dump($nblikes);



        return $this->render('SuiviBundle:Client:readForegime.html.twig', array('test'=>$test,'regime' => $regime, 'nutri' => $nutri,'nblikes'=>$nblikes[1],
            'user'=>$user));
    }


    public function updateProfileAction(Request $request,$username)
    {
        $user = new Utilisateur();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->findOneBy(['username' => $username]);
        $user->setImg(null);
        $form = $this->createFormBuilder($user)
            ->add('email', TextType::class)
            ->add('telephone')
            ->add('address')
           // ->add('img',FileType::class)
            ->add('pays',CountryType::class,array("attr"=>array("class"=>"pays")))
            ->add('region',CountryType::class,array("attr"=>array("class"=>"region")))
            ->add('ville',CountryType::class,array("attr"=>array("class"=>"ville")))
            ->add('cv',TextareaType::class)
            ->add('Modifier', SubmitType::class, array('label' => 'Save Changes'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $em->flush();
            return $this->redirectToRoute("suivi_homepage");
        }
        return $this->render('@Suivi/Profile/UpdateProfile.html.twig', array('form' => $form->createView()));

    }

    public function likeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $aime= new AimesRegimes();
        $regimes = $this->getDoctrine()
            ->getRepository(Regime::class)
            ->find($id);
        $test= $this->getDoctrine()->getRepository(AimesRegimes::class)
            ->testLike($regimes,$user);
        if ($test == null) {
            $aime->setUser($user);
            $aime->setRegime($regimes);
            $em->persist($aime);
            $em->flush();
            return $this->redirectToRoute('client_readRegime', ['id' => $id]);
        }
        else
        {
            $em->remove($test);
            $em->flush();
            return $this->redirectToRoute('client_readRegime', ['id' => $id]);
        }

    }



    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Regime::class,Utilisateur::class
        ));

    }
}
