<?php

declare(strict_types=1);

namespace Coduo\PHPMatcher\Tests\PHPUnit;

use Coduo\PHPMatcher\PHPUnit\PHPMatcherConstraint;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestCase;

class PHPMatcherConstraintTest extends TestCase
{
    public function test_it_is_a_phpunit_constraint()
    {
        $this->assertInstanceOf('PHPUnit\Framework\Constraint\Constraint', new PHPMatcherConstraint('@string@'));
    }

    public function test_it_returns_true_if_a_value_matches_the_pattern()
    {
        $constraint = new PHPMatcherConstraint('@string@');

        $this->assertTrue($constraint->evaluate('foo', '', true));
    }

    public function test_it_returns_false_if_a_value_does_not_match_the_pattern()
    {
        $constraint = new PHPMatcherConstraint('@string@');

        $this->assertFalse($constraint->evaluate(42, '', true));
    }

    public function test_it_sets_a_failure_description_if_not_given()
    {
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('Failed asserting that 42 matches the pattern');

        $constraint = new PHPMatcherConstraint('@string@');

        $this->assertFalse($constraint->evaluate(42));
    }

    public function test_it_sets_additional_failure_description()
    {
        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessage('integer "42" is not a valid string');

        $constraint = new PHPMatcherConstraint('@string@');

        $this->assertFalse($constraint->evaluate(42));
    }
}
