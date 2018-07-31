FROM redmine:latest

ENV DIRPATH /home/neo/share/websites/LibraryManagementSystem
USER root
COPY usr/src/redmine/themes/flattheme1 /usr/src/redmine/public/themes/flattheme
RUN chown -R redmine:redmine /usr/src/redmine/public/themes/flattheme