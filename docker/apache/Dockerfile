FROM httpd:2.4-alpine

RUN apk add --no-cache bash
RUN echo "Include /usr/local/apache2/conf/webapp.conf" \
    >> /usr/local/apache2/conf/httpd.conf
