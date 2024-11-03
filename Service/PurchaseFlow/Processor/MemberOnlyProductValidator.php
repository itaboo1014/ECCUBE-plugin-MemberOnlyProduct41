<?php

namespace Plugin\BootechMemberOnlyProduct41\Service\PurchaseFlow\Processor;

use Eccube\Annotation\CartFlow;
use Eccube\Annotation\ShoppingFlow;
use Eccube\Entity\ItemInterface;
use Eccube\Service\PurchaseFlow\InvalidItemException;
use Eccube\Service\PurchaseFlow\ItemValidator;
use Eccube\Service\PurchaseFlow\PurchaseContext;
use Plugin\BootechMemberOnlyProduct41\Repository\ConfigRepository;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * 会員限定商品を購入可能かどうか判定
 **
 * @CartFlow
 * @ShoppingFlow
 */
class MemberOnlyProductValidator extends ItemValidator
{
    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    /**
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param ConfigRepository $configRepository
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        ConfigRepository $configRepository
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->configRepository = $configRepository;
    }

    /**
     * @param ItemInterface $item
     * @param PurchaseContext $context
     * @throws InvalidItemException
     */
    protected function validate(ItemInterface $item, PurchaseContext $context)
    {
        if (!$item->isProduct()) {
            return;
        }

        if ($item->isProduct()) {
            $Product = $item->getProductClass()->getProduct();
            $Config = $this->configRepository->get();
            if ($Product->getOnlyMember() && $this->authorizationChecker->isGranted('ROLE_USER') === false) {
                $this->throwInvalidItemException($Config->getMessage());
            }
        }
    }

    protected function handle(ItemInterface $item, PurchaseContext $context)
    {
        //エラーがでたら該当商品の数量0にする
        $item->setQuantity(0);
    }
}
