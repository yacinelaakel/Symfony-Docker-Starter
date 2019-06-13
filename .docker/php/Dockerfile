FROM php:7.3-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends vim curl debconf subversion git apt-transport-https apt-utils \
    build-essential locales acl mailutils wget zip unzip gnupg gnupg1 gnupg2 zlib1g-dev libicu-dev g++

RUN apt-get install -y libzip-dev zlib1g-dev && \
    docker-php-ext-install zip

RUN docker-php-ext-configure intl && \
    docker-php-ext-install intl pdo_mysql

RUN ln -fs /home/wwwroot/sf4/.docker/php/php.ini /usr/local/etc/php/php.ini && \
    ln -fs /home/wwwroot/sf4/.docker/php/php-fpm-pool.conf /usr/local/etc/php/php-fpm.conf && \
    ln -fs /home/wwwroot/sf4/.docker/php/.bashrc ~/.bashrc

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer

RUN wget --no-check-certificate https://phar.phpunit.de/phpunit-6.5.3.phar && \
    mv phpunit*.phar phpunit.phar && \
    chmod +x phpunit.phar && \
    mv phpunit.phar /usr/local/bin/phpunit

RUN	echo "deb https://deb.nodesource.com/node_11.x jessie main" >> /etc/apt/sources.list.d/nodejs.list && \
	wget -nv -O -  https://deb.nodesource.com/gpgkey/nodesource.gpg.key | apt-key add - && \
	echo "deb-src https://deb.nodesource.com/node_11.x jessie main" >> /etc/apt/sources.list.d/nodejs.list && \
    apt-get update && \
	apt-get install -y --force-yes nodejs && \
	rm -f /etc/apt/sources.list.d/nodejs.list

RUN groupadd dev -g 999
RUN useradd dev -g dev -d /home/dev -m

RUN rm -rf /var/lib/apt/lists/*
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

WORKDIR /home/wwwroot/sf4

CMD ["php-fpm"]
