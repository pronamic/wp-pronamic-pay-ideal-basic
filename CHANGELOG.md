#  Change Log

All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](http://semver.org/) and [Keep a CHANGELOG](http://keepachangelog.com/).

## [Unreleased][unreleased]
- 

## [4.3.6] - 2024-03-26

### Commits

- ncu -u ([3c22148](https://github.com/pronamic/wp-pronamic-pay-ideal-basic/commit/3c22148324745593486cae876d62d1a231760b48))

Full set of changes: [`4.3.5...4.3.6`][4.3.6]

[4.3.6]: https://github.com/pronamic/wp-pronamic-pay-ideal-basic/compare/v4.3.5...v4.3.6

## [4.3.5] - 2023-09-11

### Commits

- Fixed DateTime::__construct() deprecated warning #2 ([e1b3c90](https://github.com/pronamic/wp-pronamic-pay-ideal-basic/commit/e1b3c903856bfd454c4d052729d70ebcb82f3f5d))

Full set of changes: [`4.3.4...4.3.5`][4.3.5]

[4.3.5]: https://github.com/pronamic/wp-pronamic-pay-ideal-basic/compare/v4.3.4...v4.3.5

## [4.3.4] - 2023-07-12

### Commits

- Updated for removed payment ID fallback in formatted payment string (pronamic/wp-pronamic-pay-adyen#23). ([b8d9f82](https://github.com/pronamic/wp-pronamic-pay-ideal-basic/commit/b8d9f824ab0eb30edb91e2142c6caaff1724241e))

Full set of changes: [`4.3.3...4.3.4`][4.3.4]

[4.3.4]: https://github.com/pronamic/wp-pronamic-pay-ideal-basic/compare/v4.3.3...v4.3.4

## [4.3.3] - 2023-06-01

### Commits

- Switch from `pronamic/wp-deployer` to `pronamic/pronamic-cli`. ([016f1d1](https://github.com/pronamic/wp-pronamic-pay-ideal-basic/commit/016f1d15cafda94b4e4022fb75c1393fc64a1066))
- Updated .gitattributes ([25808b7](https://github.com/pronamic/wp-pronamic-pay-ideal-basic/commit/25808b7a1502b55760b22e2b75768ea89358664b))

Full set of changes: [`4.3.2...4.3.3`][4.3.3]

[4.3.3]: https://github.com/pronamic/wp-pronamic-pay-ideal-basic/compare/v4.3.2...v4.3.3

## [4.3.2] - 2023-03-27

### Commits

- Using version ^1.3 for pronamic/wp-deployer. ([afd65ca](https://github.com/pronamic/wp-pronamic-pay-ideal-basic/commit/afd65cad3c8ac7122b80c07f6f192e6057efa6d6))
- Set Composer type to `wordpress-plugin`. ([d34357a](https://github.com/pronamic/wp-pronamic-pay-ideal-basic/commit/d34357af4c3102f0e4c4a90eec23f7e6ba06e196))
- Updated .gitattributes ([80a707b](https://github.com/pronamic/wp-pronamic-pay-ideal-basic/commit/80a707b32e49f622e627d161f82090d3fa51db7a))

Full set of changes: [`4.3.1...4.3.2`][4.3.2]

[4.3.2]: https://github.com/pronamic/wp-pronamic-pay-ideal-basic/compare/v4.3.1...v4.3.2

## [4.3.1] - 2023-01-31
### Composer

- Changed `php` from `>=8.0` to `>=7.4`.
Full set of changes: [`4.3.0...4.3.1`][4.3.1]

[4.3.1]: https://github.com/pronamic/wp-pronamic-pay-ideal-basic/compare/v4.3.0...v4.3.1

## [4.3.0] - 2022-12-22
- Prevent payment status update without valid key with hash.

### Composer

- Changed `php` from `>=5.6.20` to `>=8.0`.
- Changed `wp-pay-gateways/ideal` from `^4.0` to `v4.1.0`.
	Release notes: https://github.com/pronamic/wp-pronamic-pay-ideal/releases/tag/v4.2.0
- Changed `wp-pay/core` from `^4.0` to `v4.6.0`.
	Release notes: https://github.com/pronamic/wp-pay-core/releases/tag/v4.2.0

Full set of changes: [`4.2.0...4.3.0`][4.3.0]

[4.3.0]: https://github.com/pronamic/wp-pronamic-pay-ideal-basic/compare/v4.2.0...v4.3.0

## [4.2.0] - 2022-09-26
- Updated payment methods registration.

## [4.1.0] - 2022-04-11
- Change mode.

## [4.0.0] - 2022-01-11
### Changed
- Updated to https://github.com/pronamic/wp-pay-core/releases/tag/4.0.0.

## [3.0.0] - 2021-08-05
- Updated to `pronamic/wp-pay-core`  version `3.0.0`.
- Updated to `pronamic/wp-money`  version `2.0.0`.
- Switched to `pronamic/wp-coding-standards`.

## [2.2.0] - 2021-06-18
- Switched to REST API for notification URL.

## [2.1.3] - 2021-04-26
- Fixed fatal error on handling invalid notification.

## [2.1.2] - 2020-11-10
- Fix setting acquirer URL.

## [2.1.1] - 2020-03-26
- Fix incomplete gateway settings.

## [2.1.0] - 2020-03-19
- Extend from AbstractGatewayIntegration class.

## [2.0.5] - 2019-12-22
- Added URL to manual in gateway settings.
- Updated output fields to use payment.

## [2.0.4] - 2019-10-04
- Fixed setting `deprecated` based on passed arguments.

## [2.0.3] - 2019-09-10
- Added context to the 'XML notification URL' translatable strings.

## [2.0.2] - 2019-08-27
- Updated packages.

## [2.0.1] - 2018-12-12
- Simplified XML notifications status updates.
- Updated deprecated function calls.

## [2.0.0] - 2018-05-11
- Switched to PHP namespaces.

## [1.1.6] - 2016-10-20
- Use the new $payment->format_string() function.

## [1.1.5] - 2016-06-08
- Simplified the gateway payment start function.

## [1.1.4] - 2016-03-22
- Updated gateway settings.
- Fixed typo 'xml_notifaction' in listener parameter.

## [1.1.3] - 2016-03-02
- Added an get_settings function to the integration class.
- Moved get_gateway_class() function to the configuration class.
- Removed get_config_class(), no longer required.

## [1.1.2] - 2016-01-29
- Added an gateway settings class.

## [1.1.1] - 2015-03-26
- Return array with output fields instead of HTML.

## [1.1.0] - 2015-03-09
- Improved support for user defined purchase ID's.

## [1.0.2] - 2015-03-03
- Changed WordPress pay core library requirement from `~1.0.0` to `>=1.0.0`.
- Changed WordPress pay iDEAL library requirement from `~1.0.0` to `>=1.0.0`.

## [1.0.1] - 2015-02-06
- No longer create random transaction ID's.
- Use payment ID as purchase ID instead of data source ID.
- Update transaction ID in XML notification listener.

## 1.0.0 - 2015-01-19
- First release.

[unreleased]: https://github.com/wp-pay-gateways/ideal-basic/compare/4.2.0...HEAD
[4.2.0]: https://github.com/pronamic/wp-pronamic-pay-ideal-basic/compare/4.1.0...4.2.0
[4.1.0]: https://github.com/wp-pay-gateways/ideal-basic/compare/4.0.0...4.1.0
[4.0.0]: https://github.com/wp-pay-gateways/ideal-basic/compare/3.0.0...4.0.0
[3.0.0]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.2.0...3.0.0
[2.2.0]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.1.3...2.2.0
[2.1.3]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.1.2...2.1.3
[2.1.2]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.1.1...2.1.2
[2.1.1]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.1.0...2.1.1
[2.1.0]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.0.5...2.1.0
[2.0.5]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.0.4...2.0.5
[2.0.4]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.0.3...2.0.4
[2.0.3]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.0.2...2.0.3
[2.0.2]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.0.1...2.0.2
[2.0.1]: https://github.com/wp-pay-gateways/ideal-basic/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.6...2.0.0
[1.1.6]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.5...1.1.6
[1.1.5]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.4...1.1.5
[1.1.4]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.3...1.1.4
[1.1.3]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.2...1.1.3
[1.1.2]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.1...1.1.2
[1.1.1]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.0...1.1.1
[1.1.0]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.0.2...1.1.0
[1.0.2]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.0.0...1.0.1
