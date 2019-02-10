<?php
declare(strict_types=1);

namespace Tests\Models\DataMappers {

    use PHPUnit\Framework\TestCase;

    final class UserDataMapperTests extends TestCase
    {
        public function testCanBeCreated()
        {
            $this->assertInstanceOf(
                UserDataMapper::class,
                new UserDataMapper()
            );
        }
    }
}