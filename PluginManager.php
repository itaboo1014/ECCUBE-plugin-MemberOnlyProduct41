<?php

namespace Plugin\BootechMemberOnlyProduct41;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Common\EccubeConfig;
use Eccube\Entity\Master\ProductListOrderBy;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\BootechMemberOnlyProduct41\Entity\Config;
use Psr\Container\ContainerInterface;

/**
 * Class PluginManager.
 */
class PluginManager extends AbstractPluginManager
{
    const VERSION = '0.0.1';

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var EccubeConfig
     */
    protected $eccubeConfig;


    /**
     * Install the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function install(array $meta, ContainerInterface $container)
    {
    }

    /**
     * Update the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function update(array $meta, ContainerInterface $container)
    {
    }

    /**
     * Enable the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function enable(array $meta, ContainerInterface $container)
    {
        $this->createMasterData($container);
    }

    /**
     * Disable the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function disable(array $meta, ContainerInterface $container)
    {
        $this->deleteMasterData($container);
    }

    /**
     * Uninstall the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function uninstall(array $meta, ContainerInterface $container)
    {
        $this->deleteMasterData($container);
    }

    private function createMasterData(ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine')->getManager();

        $Configs = $entityManager->getRepository('Plugin\BootechMemberOnlyProduct41\Entity\Config')->findAll();

        $qb = $entityManager->createQueryBuilder();
        $maxRank = $qb->select('MAX(m.sort_no)')
            ->from(ProductListOrderBy::class, 'm')
            ->getQuery()
            ->getSingleScalarResult();

        if (!count($Configs)) {
            $qb = $entityManager->createQueryBuilder();
            $maxId = $qb->select('MAX(m.id)')
                ->from(ProductListOrderBy::class, 'm')
                ->getQuery()
                ->getSingleScalarResult();
            $data = [
                [
                    'className' => 'Eccube\Entity\Master\ProductListOrderBy',
                    'id' => ++$maxId,
                    'sort_no' => ++$maxRank,
                    'name' => '会員限定商品',
                ]
            ];
        } else {
            /* @var $Configs Config[] */
            foreach ($Configs as $Config) {
                $data[] =
                    [
                        'className' => 'Eccube\Entity\Master\ProductListOrderBy',
                        'id' => $Config->getProductListOrderById(),
                        'sort_no' => ++$maxRank,
                        'name' => $Config->getName(),
                    ]
                ;
            }
        }

        foreach ($data as $row) {
            $Entity = $entityManager->getRepository($row['className'])
                ->find($row['id']);
            if (!$Entity) {
                $Entity = new $row['className']();
                $Entity
                    ->setName($row['name'])
                    ->setId($row['id'])
                    ->setSortNo($row['sort_no'])
                ;

                $entityManager->persist($Entity);
                $entityManager->flush($Entity);

                $Config = new Config();
                $Config
                    ->setName($row['name'])
                    ->setProductListOrderById($Entity->getId())
                    ->setType(1)
                    ->setMessage("この商品は会員限定商品です。\nログインまたは、会員登録をしてからお買い求めください。");
                ;

                $entityManager->persist($Config);
                $entityManager->flush($Config);
            }
        }
    }

    private function deleteMasterData(ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine')->getManager();

        $Configs = $entityManager->getRepository('Plugin\BootechMemberOnlyProduct41\Entity\Config')->findAll();

        /* @var $Configs Config[] */
        foreach ($Configs as $Config) {
            $ProductListOrderBy = $entityManager->getRepository('Eccube\Entity\Master\ProductListOrderBy')
                ->find($Config->getProductListOrderById());

            if ($ProductListOrderBy) {
                $entityManager->remove($ProductListOrderBy);
            }
        }
    }
}
