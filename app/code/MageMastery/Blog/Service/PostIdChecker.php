<?php declare(strict_types=1);

namespace MageMastery\Blog\Service;

use MageMastery\Blog\Model\ResourceModel\Post;

class PostIdChecker
{
    public function __construct(private Post $post)
    {
    }

    public function checkUrlKey(string $urlKey): int
    {
        $connection = $this->post->getConnection();
        $select = $connection->select()
            ->from($connection->getTableName('directory_city_postal_codes'), 'entity_id')
            ->where('entity_id = ?', $urlKey);

        return (int) $connection->fetchOne($select);
    }
}
