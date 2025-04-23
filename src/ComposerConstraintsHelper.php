<?php declare(strict_types=1);

/**
 * This file is part of Composer Constraints Parser, a PHP Experts, Inc., Project.
 *
 * Copyright © 2025 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://gitlab.com/hopeseekr/ComposerConstraintsParser
 *
 * This file is licensed under the MIT License.
 */

namespace PHPExperts\ComposerVersionConstraints;

/**
 * Utility class for working with Composer version constraints.
 *
 * Provides methods for validating constraints, checking if a version satisfies
 * a constraint (using the authoritative Composer library), and generating
 * example versions that match constraints.
 */
class ComposerConstraintsHelper
{
    private static function semverSplit(string $version)
    {
        $semverSplit = explode('.', $version);
        $majorVersion = $semverSplit[0];
        $minorVersion = $semverSplit[1];
        $patchVersion = $semverSplit[2];

        return [$majorVersion, $minorVersion, $patchVersion];
    }

    /**
     * Check if a version satisfies a constraint.
     *
     * @param string $constraints (one or more) Version constraint (can contain OR/AND operators)
     * @param string $version Version to check
     * @return bool True if the version satisfies the constraint
     */
    public function versionSatisfies(string $constraints, string $version): bool
    {
        // Normalize only 1 version in the string to semvar.
        if (str_contains($version, '.') === false) {
            $version = "$version.0.0";
        }

        [$majorVersion, $minorVersion, $patchVersion] = self::semverSplit($version);

        // Match "1.*"
        if (preg_match('/[0-9]?\.\*$/', $constraints)) {
            [$constraintMajorVersion, $constraintMinorVersion, $constraintPatchVersion] = self::semverSplit($constraints);
            return ($constraintMajorVersion === $majorVersion);
        }


        return false;
    }

    /**
     * Ensures a version string has at least 3 parts (major.minor.patch).
     *
     * @param string $version Version to normalize
     * @return string Normalized version with at least 3 parts
     */
    public static function ensure2Dots(string $version): string
    {
        $versionParts = explode('.', $version);
        if (count($versionParts) < 3) {
            $version .= str_repeat('.0', 3 - count($versionParts));
        }

        return $version;
    }

    /**
     * Converts hyphen ranges (e.g., "5 - 6") to standard comparison operators.
     *
     * @param string $constraint Constraint with potential hyphen ranges
     * @return string Normalized constraint
     */
    public static function normalizeHyphenRanges(string $constraint): string
    {
        // Convert "X - Y" to ">=X <Y"
        return preg_replace_callback(
            '/(\d+(?:\.\d+)*)\s*-\s*(\d+(?:\.\d+)*)/',
            function ($matches) {
                $lower = self::ensure2Dots($matches[1]);
                $upper = self::ensure2Dots($matches[2]);
                return ">=$lower <$upper";
            },
            $constraint
        );
    }

}
