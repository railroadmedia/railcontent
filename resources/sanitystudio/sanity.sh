#!/bin/bash

# path to our Laravel .env file
ENV_FILE="../../.env"

# extract the SANITY_CLI_AUTH_TOKEN from the .env file
if [ -f $ENV_FILE ]; then
  SANITY_CLI_AUTH_TOKEN=$(grep -E '^SANITY_CLI_AUTH_TOKEN=' $ENV_FILE | cut -d '=' -f 2-)
else
  echo ".env file not found at: $ENV_FILE"
  exit 1
fi

# ensure the token was extracted correctly
if [ -z "$SANITY_CLI_AUTH_TOKEN" ]; then
  echo "Failed to extract SANITY_CLI_AUTH_TOKEN from .env file"
  exit 1
fi

# debugging: print the retrieved token
#echo "Retrieved token: $SANITY_CLI_AUTH_TOKEN"

# run the Sanity CLI command passed as an argument
SANITY_AUTH_TOKEN=$SANITY_CLI_AUTH_TOKEN sanity "$@"
