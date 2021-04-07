<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Form;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use LSB\UtilityBundle\Form\BaseEntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class LanguageType
 * @package LSB\LocaleBundle\Form
 */
class LanguageType extends BaseEntityType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'isoCode',
                TextType::class
            )
            ->add(
                'isDefault',
                TextType::class
            )
            ->add(
                'isEnabled',
                TextType::class
            )
            ->add(
                'translations',
                TranslationsType::class
            );
    }
}
