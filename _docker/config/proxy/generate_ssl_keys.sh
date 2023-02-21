#!/bin/bash

print_usage() {
  echo ""
  echo "USAGE: generate_ssl_keys.sh vhost_name cert_name"
  echo "Where"
  echo "    vhost_name: the name of dir in 'keys' directory"
  echo "    cert_name: the name of crt/key file in keys/vhost_name directory"
  echo ""
}

if [ $# -lt 1 ]; then
  print_usage
  exit 1
fi

folderName="$1"
folderNumber="$2"

if [ -d "keys/$1" ]
then
  read -p "Do you want to remove existing SSL certificate for vhost $1? [Y/n]" -n 1 -r
  echo ""
  if [[ $REPLY =~ ^[Nn]$ ]]
  then
      exit 0;
  fi

  echo "Removing old certificates keys/$1"
  rm -rf "keys/$1"
fi

echo "Generating a new ssl cert for $1 ..."
mkdir "keys/$1"

openssl genrsa -aes256 -passout pass:gsahdg -out keys/$1/$2.pass.key 4096

openssl rsa -passin pass:gsahdg -in keys/$1/$2.pass.key -out keys/$1/$2.key

rm keys/$1/$2.pass.key

openssl req -new -key keys/$1/$2.key -out keys/$1/$2.csr

openssl x509 -req -sha256 -days 365 -in keys/$1/$2.csr -signkey keys/$1/$2.key -out keys/$1/$2.crt

echo "... done"
