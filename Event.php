<?php


namespace Plugin\BootechMemberOnlyProduct41;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Plugin\BootechMemberOnlyProduct41\Repository\ConfigRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Event implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ConfigRepository
     */
    private $configRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ConfigRepository $configRepository
    ) {
        $this->entityManager = $entityManager;
        $this->configRepository = $configRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            EccubeEvents::FRONT_PRODUCT_INDEX_SEARCH => 'onFrontProductIndexSearch',
        ];
    }

    public function onFrontProductIndexSearch(EventArgs $eventArgs)
    {
        /* @var $qb QueryBuilder */
        $qb = $eventArgs->getArgument('qb');
        $searchData = $eventArgs->getArgument('searchData');

        $ProductListOrderBy = $searchData['orderby'];

        if ($ProductListOrderBy) {
            $Config = $this->configRepository->findOneBy([
                'product_list_order_by_id' => $ProductListOrderBy->getId(),
            ]);
            if ($Config) {
                $qb->andWhere("p.only_member = 1");
            }
        }
    }
}
