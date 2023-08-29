#!/bin/bash

# Check if both arguments are provided
if [ $# -ne 2 ]; then
    echo "Usage: $0 <filename> <data>"
    exit 1
fi

# Extract arguments
filename="$1"
data="$2"

# Static path
static_path="./"

# Create the full file path
full_path="${static_path}${filename}"

# Write data to the file
echo "$data"

echo "$data" | tee "$full_path"