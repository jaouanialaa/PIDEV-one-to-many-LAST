<?php

namespace GUBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roles', ChoiceType::class, array(
            'label' => 'Type',
            'choices' => array(
                'ADMIN' => 'ROLE_ADMIN',
                'CLIENT' => 'ROLE_CLIENT',
                'ETABLISSEMENT' => 'ROLE_ETAB',
                'VENDOR' => 'ROLE_VENDOR',
                'NUTRITIONNIST' => 'ROLE_NUTRI'),
            'required' => true,
            'multiple' => true,
            "attr"=>array("class"=>"hiddenRole","id"=>"rolesSelect")
        ));
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('telephone');
        $builder->add('address');
        $builder->add('codePostal');
        $builder->add('pays',CountryType::class,array("attr"=>array("class"=>"pays")))
                ->add('region',CountryType::class,array("attr"=>array("class"=>"region")))
                ->add('ville',CountryType::class,array("attr"=>array("class"=>"ville")))
                //->add('fax',NumberType::class,array("attr"=>array("class"=>"vendeur","required"=>"false")))
                ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'gubundle_registration_type';
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
}
