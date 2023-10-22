FROM php:7.3-alpine

RUN apk update && apk add git vim bash curl make

# Install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN chmod +x composer.phar
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /usr/src/app

# Copy setup script
COPY setup_sdk.sh /usr/src/app/
RUN chmod a+x /usr/src/app/setup_sdk.sh

ENTRYPOINT [ "/usr/src/app/setup_sdk.sh" ]