<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getStatisticSales(string $dateStart = null, string $dateEnd = null){
        if($dateStart && $dateEnd){
            $sql = "SELECT ".
                "product.name as name, ".
                "sum(`order`.`sale_count`) as all_sales, ".
                "sum(datediff(range_date_sale.date_stop, range_date_sale.date_start)), ".
                "json_objectagg(range_date_sale.id, (unix_timestamp(if(range_date_sale.date_stop <= '$dateEnd', range_date_sale.date_stop, '$dateEnd')) ".
                "- unix_timestamp(if(range_date_sale.date_start >= '$dateStart', range_date_sale.date_start, '$dateStart') ))/86400) as dotted_day ".
                "FROM `order` ".
                "left JOIN product on product.id = `order`.`product_id_id` ".
                "left JOIN range_date_sale on range_date_sale.id = `order`.`range_date_sales_id_id` ".
                "WHERE `order`.`sale_date` >= '$dateStart' and `order`.`sale_date` <= '$dateEnd' ".
                "GROUP BY `order`.`product_id_id`";
        }else{
            $sql = "SELECT ".
                "product.name as name, ".
                "sum(`order`.`sale_count`) as all_sales,".
                "sum(datediff(range_date_sale.date_stop, range_date_sale.date_start)),".
                "json_objectagg(range_date_sale.id, (unix_timestamp(range_date_sale.date_stop) ".
                "- unix_timestamp(range_date_sale.date_start))/86400) as dotted_day ".
                "FROM `order` ".
                "left JOIN product on product.id = `order`.`product_id_id` ".
                "left JOIN range_date_sale on range_date_sale.id = `order`.`range_date_sales_id_id` ".
                "WHERE 1 ".
                "GROUP BY `order`.`product_id_id`";
        }
        $conn = $this->getEntityManager()
            ->getConnection();


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
