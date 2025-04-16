# Composer Constraints Parser

Composer Constraints Parser is a PHP Experts, Inc., Project that is a clean-room implementation of Packagist's
composer's version constraint system.

It is meant as a zero-dependency option to faithfully interpret whether any particular version number is satisfiable
by a composer verison constraint.

This project contains 100% of all of the in-the-world composer version constraints of every dependency of every package
in the entire packagist.org database. These can be found in [tests/constraints.json].

There are 155,623 test assertions testing all 48,209 in-the-wild composer version constraints and has 100% fidelity.
It is current as of 2025-04-01.

This is possible because of the Bettergist Collector API, which archives every PHP packagist package weekly and does
deep analysis of them quarterly.

## Project Requirements

This is primarily a scientific research project and the code will be part of a scientific study.

You are allowed only two documents and one website to solve this problem:

1. [**The official Composer Versions and Constraints documentation**](https://getcomposer.org/doc/articles/versions.md)
2. [**How Composer Version Constraints Work**](https://www.iwader.co.uk/posts/2016/02/how-composer-version-constraints-work/)
3. [**The PHP.net manual**](https://www.php.net/docs.php)

Absolutely no LLMs should be consulted for this project. No ChatGPT, nothing. This needs to be a 100% human endeavor.

Requirements:

1. Clean-room implementation: Absolutely do not look at any other source code or projects. Use your own knowledge
and the existing documentation.
2. 100% passing every single one of the 155,319 PHP unit test assertions.
3. You almost certainly must have Xdebug configured for command line debugging or this project will not be feasible.
4. The Unit tests contain Composer's version matching code itself, which you can use to test your own code.
It is in `isValidVersionConstraint`.
5. Absolutely under no circumstance may you look at or analyze Composer source code. This would be a breach of ethics
in this case. If it is done accidentally, please report to your manager immediately do not code further.
6. All of your work and research should be screen-recorded and stored as H264 with no audio and uploaded to a mega.nz
account.
7. Please attempt to do `git commits` at every possible stopping point, with descriptive commit messages. While not
essential, this will aid in the scientific research.

## Installation

Via Composer

```bash
composer install
```

## Usage

```php
use PHPExperts\ComposerVersionConstraints\ComposerConstraintsHelper;

$satisfies = ComposerConstraintsHelper::versionSatisfies('7.4', '^7.4|^8.0');
// true
```

## Use cases

 ✔ Can determine if a constraint is valid  
 ✔ Complex composer constraints  
 ✔ All composer constraints  
 ✔ Known constraint  

## Testing

```bash
phpunit
```

## Contributors

[Theodore R. Smith](https://www.phpexperts.pro/]) <theodore@phpexperts.pro>  
GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690  
CEO: PHP Experts, Inc.

## License

MIT license. Please see the [license file](LICENSE) for more information.
