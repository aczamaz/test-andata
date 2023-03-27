FROM php:8.1-apache
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libonig-dev\
        libpng-dev \
        ssmtp \
        gettext \
        screen && \
        rm -r /var/lib/apt/lists/*

RUN apt-get update &&  apt-get install -y \
        libzip-dev \
        zip \
        && docker-php-ext-install zip
RUN docker-php-ext-install exif
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql mbstring iconv

# RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*

# # install imagick
# # Version is not officially released https://pecl.php.net/get/imagick but following works for PHP 8
# RUN mkdir -p /usr/src/php/ext/imagick; \
#         curl -fsSL https://github.com/Imagick/imagick/archive/06116aa24b76edaf6b1693198f79e6c295eda8a9.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1; \
#         docker-php-ext-install imagick;

ENV NODE_VERSION=14.20.1
RUN apt-get update && apt install -y curl
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN node --version
RUN npm --version

RUN npm install -g svgo

RUN apt-get update && apt-get install jpegoptim optipng pngquant gifsicle -y

RUN a2enmod rewrite
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
COPY start.sh /usr/local/sbin/start.sh
COPY php-mail.ini /usr/local/etc/php/conf.d/mail.ini
COPY project.ini /usr/local/etc/php/conf.d/
COPY date-timezone.conf /etc/apache2/conf-enabled/date-timezone.conf
COPY encoding.conf /etc/apache2/conf-enabled/encoding.conf
COPY servername.conf.tmpl /etc/apache2/conf-enabled/servername.conf.tmpl
COPY apache-site.conf /etc/apache2/sites-enabled/000-default.conf
COPY revaliases.tmpl /etc/ssmtp
COPY ssmtp.conf.tmpl /etc/ssmtp
COPY cron_events.sh /usr/local/sbin/cron_events.sh
RUN ["chmod", "+x", "/usr/local/sbin/start.sh"]
CMD ["/usr/local/sbin/start.sh"]

