FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libicu-dev \
    libxml2-dev \
    libgmp-dev \
    libmcrypt-dev \
    libxslt1-dev \
    zip \
    unzip \
    libsodium-dev  # Add this line to install libsodium

RUN docker-php-ext-install -j$(nproc) \
    bcmath \
    exif \
    gd \
    pcntl \
    pdo_mysql \
    sodium \
    intl \
    zip

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

RUN curl -fsSL https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y yarn \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

WORKDIR /var/www

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --optimize-autoloader --no-dev

RUN yarn install
RUN cp .env.example .env
EXPOSE 9000

CMD ["php-fpm"]
