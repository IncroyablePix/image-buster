FROM php:7.4-fpm

RUN apt-get update
RUN apt-get install -y sqlite3
RUN rm -rf /var/lib/apt/lists/*

COPY ./*.php /var/www/html
COPY ./init.sql /var/www/html
WORKDIR /var/www/html

RUN touch ./database.db
RUN cat init.sql | sqlite3 ./database.db

EXPOSE 80 

CMD ["php", "-S", "0.0.0.0:80"]