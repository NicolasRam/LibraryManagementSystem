<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Member;
use App\Entity\PBook;
use App\Repository\MemberRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'member',
                EntityType::class,
                array(
                    // looks for choices from this entity
                    'class' => Member::class,
                    'query_builder' => function (MemberRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->orderBy('u.id', 'ASC');
                    },

                    // uses the User.username property as the visible option string
                    'choice_label' => function ($member) {
                        /**
                         * @var Member $member
                         */
                        return $member->getId() . ' ' . $member->getFirstName(). ' ' . $member->getLastName();
                    }

                    // used to render a select box, check boxes or radios
                    // 'multiple' => true,
                    // 'expanded' => true,
                )
            )
            ->remove('pbook')
            ->remove('date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
