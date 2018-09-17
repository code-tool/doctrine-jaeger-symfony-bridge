# Symfony Bridge for Doсtrine Jaeger library

## Getting started
Register bundle with your kernel:
```$xslt
config/bundles.php
...
\Doctrine\DBAL\Jaeger\Symfony\DependencyInjection\JaegerDbalBundle::class => ['all' => true],
...
```
OR

```$xslt
app/Kernel.php::registerBundles()
    {
        $bundles = [
            ...
            new \Doctrine\DBAL\Jaeger\Symfony\DependencyInjection\JaegerDbalBundle()
            ...
        ];    
            
        return $bundles;
    }
```
Add wrapper class definition in doctrine configuration
```$xslt
doctrine:
  dbal:
    connections:
      %connection_name%:
        ...
        wrapper_class: 'Doctrine\DBAL\Jaeger\Wrapper\JaegerConnectionWrapper'
        ...
```
