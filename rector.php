<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\NullsafeMethodCall\CleanupUnneededNullsafeOperatorRector;
use Rector\Config\RectorConfig;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php82\Rector\Class_\ReadOnlyClassRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;
use RectorLaravel\Rector\MethodCall\ReverseConditionableMethodCallRector;
use RectorLaravel\Rector\MethodCall\ValidationRuleArrayStringValueToArrayRector;
use RectorLaravel\Rector\PropertyFetch\OptionalToNullsafeOperatorRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/bootstrap',
        __DIR__.'/config',
        // __DIR__ . '/lang',
        __DIR__.'/public',
        __DIR__.'/resources',
        __DIR__.'/routes',
        // __DIR__ . '/scripts',
        __DIR__.'/tests',
    ])
    // Use PHP 8.2+ features for better code quality
    ->withPhpSets(php82: true)
    ->withTypeCoverageLevel(1)
    ->withDeadCodeLevel(1)
    ->withCodingStyleLevel(1)
    ->withPreparedSets()
    ->withRules([
        // Laravel specific improvements
        OptionalToNullsafeOperatorRector::class,
        CleanupUnneededNullsafeOperatorRector::class,
        ReverseConditionableMethodCallRector::class,
        ValidationRuleArrayStringValueToArrayRector::class,

        // PHP 8.0+ improvements
        ClassPropertyAssignToConstructorPromotionRector::class,

        // PHP 8.2+ improvements - be careful with readonly
        // ReadOnlyClassRector::class,

        // Type declarations for better code quality
        AddVoidReturnTypeWhereNoReturnRector::class,
        TypedPropertyFromStrictConstructorRector::class,
    ])
    ->withCodeQualityLevel(1)
    ->withSkip([
        RemoveExtraParametersRector::class,
    ]);
