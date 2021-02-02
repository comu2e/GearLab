FROM nginx:1.18.0
COPY ./ /var/www
#public以下だけで試してみる

COPY default.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
