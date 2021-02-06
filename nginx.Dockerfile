FROM nginx:1.18.0
RUN pwd
RUN cat ./docker/nginx/default.conf 
COPY  ./  /var/www
#public以下だけで試してみる

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
