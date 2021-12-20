<?php


namespace App\Tests\Shared\Domain;


use App\IAM\User\Domain\ValueObjects\UserEmail;
use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Utils\Constants\GlobalConstants;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * @group shared
 * @group shared_domain
 * @group unit_test
 */
final class EmailTest extends MockeryTestCase
{
    /** @test */
    public function it_should_require_a_valid_email(): void
    {
        $value = 'UserEmail';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromValue(GlobalConstants::emailPlain(), $value)->getMessage());

        EmailStub::fromValue($value);
    }

    /** @test */
    public function it_should_require_a_email_with_no_max_of_60_chars(): void
    {
        $value = 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttest@email.com';
        $this->expectException(InvalidAttributeException::class);
        $this->expectExceptionMessage(InvalidAttributeException::fromMaxLength(GlobalConstants::emailPlain(), UserEmail::MAX_LENGTH)->getMessage());

        EmailStub::fromValue($value);
    }
}