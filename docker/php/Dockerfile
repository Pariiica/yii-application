# PHP + Supervisor

FROM yiisoftware/yii2-php:8.2-fpm

RUN apt update && \
    apt install -yq supervisor && \
    apt clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 9001

ENTRYPOINT ["/usr/bin/supervisord"]
