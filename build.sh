#!/bin/bash

if [[ $UID != 0 ]]; then
    echo "Please run this script with sudo:"
    echo "sudo $0 $*"
    exit 1
fi

sudo kill -9 $(sudo lsof -t -i:8000)

sudo kill -9 $(sudo lsof -t -i:8080)


read -p "Remove all images? (Yes/No): " removeImageConfirmation

read -p "Listen to docker after compiling? (Yes/No): " Listen

docker-compose down

if [[ "$removeImageConfirmation" == "Yes" ]]; then
    # delete all images

   echo 'Removing all docker images...'

   sleep 5

   docker kill $(docker ps -q)

   docker rmi -f $(docker images -aq)
fi

if [[ "$Listen" == "Yes" ]]; then
    docker-compose up --build
else
    docker-compose up --build -d
fi
