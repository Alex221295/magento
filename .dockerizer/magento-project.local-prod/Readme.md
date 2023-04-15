## Local development - domains ##

Add the following domains to the `/etc/hosts` file:

```shell
127.0.0.1 magento-project.local mh-prod-magento-project.local pma-prod-magento-project.local
```

Urls list:
- [https://magento-project.local](https://magento-project.local) 
- [http://mh-prod-magento-project.local](http://mh-prod-magento-project.local) 
- [http://pma-prod-magento-project.local](http://pma-prod-magento-project.local)


## Local development - self-signed certificates ##

Generate self-signed certificates before running this composition in the `$SSL_CERTIFICATES_DIR`:

```shell
mkcert -cert-file=magento-project.local-prod.pem -key-file=magento-project.local-prod-key.pem magento-project.local
```

Add these keys to the Traefik configuration file if needed.