#  Change Log

All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](http://semver.org/) and [Keep a CHANGELOG](http://keepachangelog.com/).

## [Unreleased][unreleased]
- 

## [1.1.6] - 2016-10-20
- Use the new $payment->format_string() function.

## [1.1.5] - 2016-06-08
- Simplified the gateay payment start function.

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
- Changed WordPress pay core library requirment from ~1.0.0 to >=1.0.0.
- Changed WordPress pay iDEAL library requirment from ~1.0.0 to >=1.0.0.

## [1.0.1] - 2015-02-06
- No longer create random transaction ID's.
- Use payment ID as purchase ID instead of data source ID.
- Update transaction ID in XML notification listener.

## 1.0.0 - 2015-01-19
- First release.

[unreleased]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.6...HEAD
[1.1.6]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.5...1.1.6
[1.1.5]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.4...1.1.5
[1.1.4]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.3...1.1.4
[1.1.3]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.2...1.1.3
[1.1.2]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.1...1.1.2
[1.1.1]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.1.0...1.1.1
[1.1.0]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.0.2...1.1.0
[1.0.2]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/wp-pay-gateways/ideal-basic/compare/1.0.0...1.0.1
