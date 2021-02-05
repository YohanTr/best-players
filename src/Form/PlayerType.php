<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PlayerType extends AbstractType
{

    /**
     * Configuration de base d'un champs
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    private function getConfiguration(string $label, string $placeholder, $options = [])
    {
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                $this->getConfiguration('Player\'s Name', 'Full Name Of The Player'))
            ->add('age', IntegerType::class, $this->getConfiguration('Age', 'Enter His Age'))
            ->add('imageFile', VichImageType::class,  [
                'label' => 'Player Picture',
                'required'      => false,
                'allow_delete' => true,
                'attr' => [
                    'accept' => "image/jpeg, image/png",
                    'class' => 'form-control-file'
                ]])

            ->add('gamePlayed', IntegerType::class,
                $this->getConfiguration('Game Played', 'Number of Game He Played'))
            ->add('goalScored', IntegerType::class,
                $this->getConfiguration('Goal Scored', 'Number of Goal He Scored'))
            ->add('keyPass', IntegerType::class,
                $this->getConfiguration('Key Pass', 'Number of Key Pass He Given'))
            ->add('club', null,
                $this->getConfiguration('Actual Team', 'Where He Played'))
            ->add('country', null,
                $this->getConfiguration('National Team', 'Enter His National Team'))
            ->add('save', SubmitType::class, [
                'label' => 'Add Player',
                'attr' => [
                    'class' => 'btn btn-lg buttonLogin'
                    ]
            ])
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
