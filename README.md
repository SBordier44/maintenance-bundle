# Intro to MaintenanceBundle

## Requirements:
- PHP `>=7.1.*`
- symfony/framework-bundle `>=3.3.*`
- Twig `>=2.*`

## Installation and configuration:

Pretty simple with [Composer](http://packagist.org), run:
```sh
composer require nuboxdevcom/maintenance-bundle
```

### Add MaintenanceBundle to your application kernel
```php
// app/AppKernel.php
public function registerBundles()
{
    return $bundles = [
        // ...
        new NDC\MaintenanceBundle\NDCMaintenanceBundle()
    ];
}
```

### Simply Configuration

Enter your IPs here to allow you to access your site during a maintenance.
```yaml
ndc_maintenance:
    authorized_ips:
        - '127.0.0.1'
        - 'your.ip.domain.name'
```

### How to Use
In your template, add this to let you know if the site is in maintenance
```twig
    {% if isMaintenanceMode() %}
        <p class="text-center bg-primary"><strong>Your site is in maintenance mode...</strong></p>
    {% endif %}
```
> **isMaintenanceMode()** return boolean.

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
> **isMaintenanceMode()** return boolean.

## How to change the view
If you want to change the view, create a new view named **maintenance.html.twig** in the 
```bash
    app/Resources/NDCMaintenanceBundle/views/
```
