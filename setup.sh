#!/bin/bash

clear

RED="\e[31m"
GREEN="\e[32m"
WHITE="\e[97m"
ENDCOLOR="\e[0m"

echo -e "
${RED}
████████╗██████╗  ██████╗ ██╗   ██╗████████╗███████╗██████╗ 
╚══██╔══╝██╔══██╗██╔═══██╗██║   ██║╚══██╔══╝██╔════╝██╔══██╗
   ██║   ██████╔╝██║   ██║██║   ██║   ██║   █████╗  ██████╔╝
   ██║   ██╔══██╗██║   ██║██║   ██║   ██║   ██╔══╝  ██╔══██╗
   ██║   ██║  ██║╚██████╔╝╚██████╔╝   ██║   ███████╗██║  ██║
   ╚═╝   ╚═╝  ╚═╝ ╚═════╝  ╚═════╝    ╚═╝   ╚══════╝╚═╝  ╚═╝
${ENDCOLOR}
${WHITE}
    [*] Author: Thiago Silva AKA thiiagoms
    [*] E-mail: thiagom.devsec@gmail.com
${ENDCOLOR}
\n";

echo -e "=> SetUp containers\n"
{
    docker-compose up -d
} &> /dev/null

echo -e "=> Go to http://localhost:8000/"