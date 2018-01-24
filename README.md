# MaintenanceBundle v2
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/2ed013da-a349-4147-b4d1-c142eb38d290/big.png)](https://insight.sensiolabs.com/projects/2ed013da-a349-4147-b4d1-c142eb38d290)

[![License](https://poser.pugx.org/nuboxdevcom/maintenance-bundle/license?format=plastic)](https://packagist.org/packages/nuboxdevcom/maintenance-bundle)
[![Total Downloads](https://poser.pugx.org/nuboxdevcom/maintenance-bundle/downloads?format=plastic)](https://packagist.org/packages/nuboxdevcom/maintenance-bundle)
[![Latest Stable Version](https://poser.pugx.org/nuboxdevcom/maintenance-bundle/v/stable?format=plastic)](https://packagist.org/packages/nuboxdevcom/maintenance-bundle)


## Requirements
- PHP `>=7.1.*`
- symfony/framework-bundle ` 4.0.*`
- Twig `^2.*`

#
## Symfony 3.x NOTE
Please use ^1.x branch versions.

2.x versions is unavailable for symfony 3.x

#
## Installation:

Pretty simple with [Composer](http://packagist.org), run:
```console
$ composer require nuboxdevcom/maintenance-bundle
```

#
### Simply Configuration

Enter your IPs here to allow you to access your site during a maintenance.

In config/ndc_maintenance.yaml
```yaml
ndc_maintenance:
    authorized_ips:
        - '127.0.0.1'
        - 'your.ip.domain.name.example'
```

#
### Configuration
Symfony Flex takes care of everything!

#
### How to Use
In your template, add this to let you know if the site is in maintenance
```twig
    {% if isMaintenanceMode() %}
        <p class="text-center bg-danger"><strong>Your site is in maintenance mode...</strong></p>
    {% endif %}
```
> **isMaintenanceMode()** return boolean true or false.

If you want to activate maintenance mode, you will need to call the following method
```php
    $this->get('maintenance.service')->enableMaintenanceAction();
```
Or
```php
    $this->get('maintenance.service')->disableMaintenanceAction();
```
To disable maintenance mode.

If you want to know if maintenance is enabled from a controller, use this method
```php
    $this->get('maintenance.service')->isMaintenanceMode();
```
> **isMaintenanceMode()** return boolean true or false.

#
### How to change the view of maintenance page
If you want to change the view, create a new view file 
```bash
    templates/bundles/NDCMaintenanceBundle/maintenance.html.twig
```
