#Simple Rest Api
A Rest Api based on [Symfony 3](https://symfony.com/)

##Requirements
* A web server running PHP > 5.5.9
* A database server supported by [doctrine driver](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#driver)
* [Composer](https://getcomposer.org/)

## Quick start
1. Clone this repo: `git clone https://github.com/Netherium/Simple-Rest-Api.git`
2. Install dependencies/initialize with composer: `composer install` 
3. Create database: `php bin/console doctrine:database:create` 
4. Update schema: `php bin/console doctrine:schema:update --force`
5. Load sample data: `php bin/console doctrine:fixtures:load`

## Symfony Bundles included
* [jms/serializer-bundle](http://jmsyst.com/bundles/JMSSerializerBundle)
* [doctrine/doctrine-fixtures-bundle](https://packagist.org/packages/doctrine/doctrine-fixtures-bundle)
* [nelmio/alice](https://github.com/nelmio/alice)
* [doctrine/data-fixtures](https://github.com/doctrine/data-fixtures)

## Authors
**Netherium**

## Copyright and license
Code released under [the MIT license](https://github.com/Netherium/Simple-Rest-Api/blob/master/LICENSE)