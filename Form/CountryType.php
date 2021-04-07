<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Form;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use LSB\LocaleBundle\Manager\CurrencyManager;
use LSB\LocaleBundle\Manager\LanguageManager;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Form\EntityLazyType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CountryType
 * @package LSB\LocaleBundle\Form
 */
class CountryType extends BaseEntityType
{
    /**
     * @var LanguageManager
     */
    protected LanguageManager $languageManager;

    /**
     * @var CurrencyManager
     */
    protected CurrencyManager $currencyManager;

    /**
     * CountryType constructor.
     * @param LanguageManager $languageManager
     * @param CurrencyManager $currencyManager
     */
    public function __construct(LanguageManager $languageManager, CurrencyManager $currencyManager)
    {
        $this->languageManager = $languageManager;
        $this->currencyManager = $currencyManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add(
                'isoCode',
                TextType::class
            )
            ->add(
                'isUeMember',
                CheckboxType::class
            )
            ->add(
                'isDefault',
                CheckboxType::class
            )
            ->add(
                'defaultCurrency',
                EntityLazyType::class,
                [
                    'class' => $this->currencyManager->getFactory()->getClassName(),
                    'validate_uuid' => false
                ]
            )
            ->add(
                'defaultLanguage',
                EntityLazyType::class,
                [
                    'class' => $this->languageManager->getFactory()->getClassName(),
                    'validate_uuid' => false
                ]
            )
            ->add(
                'translations',
                TranslationsType::class
            );
    }
}
