#!/bin/bash
( sleep 5 ; \

rabbitmq-plugins enable rabbitmq_management ; \

rabbitmqctl add_user $RABBITMQ_ADMIN $RABBITMQ_ADMIN_PASS; \
rabbitmqctl set_user_tags $RABBITMQ_ADMIN administrator; \
rabbitmqctl set_permissions -p / $RABBITMQ_ADMIN  ".*" ".*" ".*"; \
echo "*** User '$RABBITMQ_ADMIN' with password '$RABBITMQ_ADMIN_PASS' completed. ***" ; ) & \

rabbitmq-server $@
