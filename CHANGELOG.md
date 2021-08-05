#  Change Log

All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](http://semver.org/) and [Keep a CHANGELOG](http://keepachangelog.com/).

## [Unreleased][unreleased]
- 

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

[unreleased]: https://github.com/wp-pay-gateways/ideal-basic/compare/3.0.0...HEAD
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
