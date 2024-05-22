FROM composer:2

ENV COMPOSERUSER=laravel
ENV COMPOSERGROUP=laravel

RUN adduser -g ${COMPOSERGROUP} -s /bin/sh -D ${COMPOSERUSER}

CMD ["sh", "-c", "composer install --prefer-dist"]