FROM dunglas/frankenphp

COPY ./app/ /app

COPY ./openssl.cnf /etc/ssl/openssl.cnf

ENV OPENSSL_CONF=/etc/ssl/openssl.cnf
