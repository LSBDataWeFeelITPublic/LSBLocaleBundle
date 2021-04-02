<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Form;

use LSB\UtilityBundle\Form\BaseEntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CurrencyType
 * @package LSB\LocaleBundle\Form
 */
class CurrencyType extends BaseEntityType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add(
            'isoCode',
            TextType::class
        );
    }
}
