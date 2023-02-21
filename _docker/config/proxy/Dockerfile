FROM nginx:1.23.3

LABEL author="Pawel Miroslawski <pmiroslawski@gmail.com>"
LABEL version="1.0"

RUN apt-get update && apt-get install -y vim

# copy custom nginx.conf
RUN mv /etc/nginx/nginx.conf /etc/nginx/nginx.conf.backup
ADD nginx/nginx.conf /etc/nginx/

# prepare conf.d/default config
RUN rm /etc/nginx/conf.d/default.conf
ADD nginx/default.conf /etc/nginx/conf.d/default.conf

#RUN #mv /etc/nginx/sites-available /etc/nginx/sites-available.old
#RUN mv /etc/nginx/sites-enabled /etc/nginx/sites-enabled.old

RUN mkdir /etc/nginx/sites-available
RUN mkdir /etc/nginx/sites-enabled

# add service virtualhost
ADD keys/ /etc/ssl/

ADD vhost/ /etc/nginx/sites-available/
ADD vhost/ /etc/nginx/sites-enabled/

#RUN ln -s /etc/nginx/sites-available/demo.conf /etc/nginx/sites-enabled/demo.conf
#RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 nginx
RUN groupmod -g 1000 nginx

EXPOSE 80
EXPOSE 443
