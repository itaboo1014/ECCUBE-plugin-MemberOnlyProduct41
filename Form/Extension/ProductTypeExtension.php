<?php

namespace Plugin\BootechMemberOnlyProduct41\Form\Extension;

use Eccube\Common\EccubeConfig;
use Eccube\Form\Type\Admin\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ProductTypeExtension extends AbstractTypeExtension
{
    /**
     * @var EccubeConfig
     */
    private $eccubeConfig;

    /**
     * ProductTypeExtension constructor.
     *
     * @param EccubeConfig $eccubeConfig
     */
    public function __construct(EccubeConfig $eccubeConfig)
    {
        $this->eccubeConfig = $eccubeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('only_member', CheckboxType::class, [
                'label' => '会員限定商品',
                'label_attr' => ['class' => 'd-none'],
                'required' => false,
                'eccube_form_options' => [
                    'auto_render' => true,
                ],
                'value' => '1',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return ProductType::class;
    }
    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}
