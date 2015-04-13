# trello-php-client
PHP client to interact with the Trello API.

We're slowly building out this client as we need the functionality. Initially we only need it for adding accounts to organizations.

This client is built on top of [Guzzle](http://docs.guzzlephp.org/en/latest/index.html), the PHP HTTP Client.
Guzzle has a simple way to create API clients by describing the API in a Swagger-like format without the need to implement 
every method yourself. So adding support for more Trello APIs is relatively simple. If you want to submit a pull request
to add another feature, please do. If you don't know how to do that, ask us and we might be able to add it in for you.

# Trello API Docs #
https://trello.com/docs/

# Trello API Authentication #
Trello uses a key/token pair to authenticate for API calls. You can get a key/secret at https://trello.com/1/appKey/generate

# Install #
Installation is simple with [Composer](https://getcomposer.org/). Add ```"silinternational/trello-php-client", "dev-master"``` to your ```composer.json``` file and update.

# Usage #
Example:
```php
<?php

use Trello\Organization;

$org = new Organization([
  'key' => '1234567890',
  'token' => 'aasddfffds',
]);

$user = $org->addMember([
    'idOrg' => '5519vgdgh561a4a4b51154123b',
    'email' => 'testuser@domain.org',
    'fullName' => 'Test User',
]);

echo $user['id'];
// 552bfa4aadda3e05254317k

```

## Guzzle Service Client Notes ##
- Tutorial on developing an API client with Guzzle Web Services: http://www.phillipshipley.com/2015/04/creating-a-php-nexmo-api-client-using-guzzle-web-service-client-part-1/
- Presentation by Jeremy Lindblom: https://speakerdeck.com/jeremeamia/building-web-service-clients-with-guzzle-1
- Example by Jeremy Lindblom: https://github.com/jeremeamia/sunshinephp-guzzle-examples
- Parameter docs in source comments: https://github.com/guzzle/guzzle-services/blob/master/src/Parameter.php