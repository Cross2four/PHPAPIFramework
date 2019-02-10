<?php
declare(strict_types=1);

namespace Tests\Controllers {

    use App\Controllers\UsersController;
    use PHPUnit\Framework\TestCase;

    final class UsersControllerTests extends TestCase
    {
        public function testCanBeCreated()
        {
            $this->assertInstanceOf(
                UsersController::class,
                new UsersController()
            );
        }
    }
}