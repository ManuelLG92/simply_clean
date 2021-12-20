FROM nginx:alpine
ENV TZ=Europe/Madrid
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN chmod 777 -R /etc/nginx/ /var/cache/nginx/

RUN mkdir /etc/nginx/ssl && chmod 777 -R /etc/nginx/ssl

COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY nginx-conf-file /etc/nginx/nginx.conf

ARG USER_ID=1001
ARG GROUP_ID=1001


WORKDIR /var/www/html/

RUN chmod 777 /var/log