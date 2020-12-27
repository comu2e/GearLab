FROM phppm/nginx:2.0.3
RUN apk update && apk add --no-cache \
      tzdata curl \
      && apk del tzdata \
      && rm -rf /var/cache/apk/*
COPY . /var/www
CMD ["--bootstrap=laravel","--static-directory=public/"]
