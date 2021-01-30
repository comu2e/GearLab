aws ecr get-login-password --region ap-northeast-1 | docker login --username AWS --password-stdin 499506883380.dkr.ecr.ap-northeast-1.amazonaws.com

docker tag nginx:latest 499506883380.dkr.ecr.ap-northeast-1.amazonaws.com/nginx:latest
docker tag php:latest 499506883380.dkr.ecr.ap-northeast-1.amazonaws.com/php:latest
docker push 499506883380.dkr.ecr.ap-northeast-1.amazonaws.com/nginx:latest
docker push 499506883380.dkr.ecr.ap-northeast-1.amazonaws.com/php:latest

cd /Desktop/AWS
ssh -i "mykey.pem" ec2-user@ec2-54-249-78-119.ap-northeast-1.compute.amazonaws.com
