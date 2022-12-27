FROM php:8.1-fpm

WORKDIR /var/www

# Update core and install dependencies
RUN apt-get update -y && apt-get upgrade -y

RUN apt-get install -y \
  build-essential \
  vim \
  curl \
  zip \
  unzip \
  zsh \
  git \
  libjpeg62-turbo-dev \
  postgresql \
  libgd-dev \
  libjpeg-dev \
  htop \
  locales \
  libpng-dev \
  zlib1g-dev \
  postgresql-client \
  libpq-dev \
  libicu-dev

# reconfigure locales for pl_PL.UTF-8 UTF-8
RUN locale-gen pl_PL.UTF-8 && dpkg-reconfigure locales

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt-get clean && rm -rf /var/cache/apt/archives/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql bcmath exif opcache pcntl intl
RUN docker-php-ext-configure gd --with-jpeg \
  && docker-php-ext-install -j "$(nproc)" gd

RUN docker-php-ext-enable opcache intl

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug 

RUN pecl install redis \
  && docker-php-ext-enable redis

RUN pecl install xdebug redis && docker-php-ext-enable xdebug redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install symfony cli
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli

# Install Oh My Zsh
RUN sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

# Add plugins for oh-my-zsh
RUN git clone https://github.com/zsh-users/zsh-autosuggestions ~/.oh-my-zsh/custom/plugins/zsh-autosuggestions
RUN git clone https://github.com/zsh-users/zsh-syntax-highlighting.git ~/.oh-my-zsh/custom/plugins/zsh-syntax-highlighting

RUN sed -i 's/plugins=(git)/plugins=(git zsh-syntax-highlighting zsh-autosuggestions)/g' ~/.zshrc

COPY composer.json .

RUN if  [ ! -d "vendor" ] ; then \
  composer install \
  ;fi

EXPOSE 9000

CMD [ "php-fpm" ]