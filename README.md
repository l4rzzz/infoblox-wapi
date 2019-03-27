# Infoblox-WAPI

PHP Component to interact with Infoblox WAPI (REST)

-----

### Usage


- Examples  


__DNS: Get object reference from A record__  

```php
<?php
use \L4rzzz\InfobloxWapi\Dns\Dns;

$ib = new Dns('infoblox-grid.mydomain.com', 'user', 'password', '/path/to/infoblox_web.crt');

$objString = $ib->getAObj('test.mydomain.com', '192.168.10.10', 'interne');
print $objString;
```


__DNS: Create CNAME Record__  

```php
<?php
use \L4rzzz\InfobloxWapi\Dns\Dns;

$ib = new Dns('infoblox-grid.mydomain.com', 'user', 'password', '/path/to/infoblox_web.crt');

// optional parameters with extensible attributes
$optParams = [
    'view' => 'internal' ,
    'ttl' => '14400',
    'extattrs' => [
        'User' => ['value' => 'john.smith@mydomain.com'],
        'Group' => ['value' => 'admins']
    ]
];
$objString = $ib->setCname('mycname.mydomain.com', 'mydomain.com', $optParams);
```
