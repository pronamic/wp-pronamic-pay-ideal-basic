# WordPress Pay Gateway: iDEAL Basic

**iDEAL Basic driver for the WordPress payment processing library.**

[![Build Status](https://travis-ci.org/wp-pay-gateways/ideal-basic.svg?branch=develop)](https://travis-ci.org/wp-pay-gateways/ideal-basic)
[![Coverage Status](https://coveralls.io/repos/wp-pay-gateways/ideal-basic/badge.svg?branch=master&service=github)](https://coveralls.io/github/wp-pay-gateways/ideal-basic?branch=master)
[![Latest Stable Version](https://poser.pugx.org/wp-pay-gateways/ideal-basic/v/stable.svg)](https://packagist.org/packages/wp-pay-gateways/ideal-basic)
[![Total Downloads](https://poser.pugx.org/wp-pay-gateways/ideal-basic/downloads.svg)](https://packagist.org/packages/wp-pay-gateways/ideal-basic)
[![Latest Unstable Version](https://poser.pugx.org/wp-pay-gateways/ideal-basic/v/unstable.svg)](https://packagist.org/packages/wp-pay-gateways/ideal-basic)
[![License](https://poser.pugx.org/wp-pay-gateways/ideal-basic/license.svg)](https://packagist.org/packages/wp-pay-gateways/ideal-basic)
[![Built with Grunt](https://cdn.gruntjs.com/builtwith.svg)](http://gruntjs.com/)

## Documentation

*	[Integration manual for iDEAL Basic - Version 2.3, April 2010 - ING](http://pronamic.nl/wp-content/uploads/2011/12/iDEAL_Basic_EN_v2.3.pdf)

## Simulate XML Notification

```
curl --request POST http://pay.test/?xml_notification \
	--data '<?xml version="1.0" encoding="UTF-8"?>
<Notification xmlns="http://www.idealdesk.com/Message" version="1.1.0">
	<createDateTimeStamp>20131022120742</createDateTimeStamp>
	<transactionID>0020000048638175</transactionID>
	<purchaseID>1382436458</purchaseID>
	<status>Success</status>
</Notification>'
```
