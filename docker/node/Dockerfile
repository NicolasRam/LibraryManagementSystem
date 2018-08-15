FROM node:10
#MAINTAINER Name Here <username@localhost>
#RUN rpm -Uvh http://mirror.pnl.gov/epel/7/x86_64/Packages/e/epel-release-7-11.noarch.rpm
#RUN yum install nodejs npm -y
WORKDIR /var/www/frontend
#COPY . /var/www/frontend
RUN cd /var/www/frontend;

RUN npm install -g nodemon

EXPOSE 7000

CMD ["nodemon","-L","/var/www/frontend" ]