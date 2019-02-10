<?php
declare(strict_types=1);

namespace Tests\Models {

    use App\Models\User;
    use PHPUnit\Framework\TestCase;

    final class UserTests extends  TestCase
    {
        public function testCanBeCreated()
        {
            $this->assertInstanceOf(
                User::class,
                new User()
            );
        }
    }
}