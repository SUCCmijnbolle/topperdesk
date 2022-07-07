FROM apache:lts

WORKDIR /var/www/html/

COPY . /var/www/html/

CMD ["apt", "install"]