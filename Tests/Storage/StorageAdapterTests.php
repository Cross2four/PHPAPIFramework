<?php
declare(strict_types=1);

namespace Tests\Storage {

    use App\IStorageAdapter;
    use App\PDOStorageAdapterFactory;
    use PHPUnit\Framework\TestCase;

    final class StorageAdapterTests extends TestCase
    {
        public function testCanBeCreatedOfTypePDO()
        {
            $this->assertInstanceOf(
                IStorageAdapter::class,
                (new PDOStorageAdapterFactory())->createStorageAdapter()
            );
        }
    }
}