# Symfony Bridge for Doсtrine Jaeger library

## Getting started
Register bundle with your kernel:
```php
// config/bundles.php
return [
    // ...
    \Doctrine\DBAL\Jaeger\Symfony\DependencyInjection\JaegerDbalBundle::class => ['all' => true],
    // ...
];
```
OR

```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new \Doctrine\DBAL\Jaeger\Symfony\DependencyInjection\JaegerDbalBundle(),
        ];

        // ...
    }
}
```

Add wrapper class definition in doctrine configuration
```yaml
doctrine:
  dbal:
    connections:
      %connection_name%:
        ...
        wrapper_class: 'Doctrine\DBAL\Jaeger\Wrapper\JaegerConnectionWrapper'
        ...
```
