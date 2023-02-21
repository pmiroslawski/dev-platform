FROM rabbitmq:3.11.9

LABEL author="Pawel Miroslawski <pmiroslawski@gmail.com>"
LABEL version="1.0"

#RUN rabbitmq-plugins enable --offline rabbitmq_mqtt rabbitmq_federation_management rabbitmq_stomp

ADD init.sh /init.sh
RUN chmod 755 /init.sh
EXPOSE 15672

CMD ["/init.sh"]
