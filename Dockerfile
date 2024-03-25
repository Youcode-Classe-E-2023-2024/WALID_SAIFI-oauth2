# Use an official PHP runtime as a base image
FROM php:8.3-apache

# Install additional dependencies if needed
RUN apt-get update && \
    apt-get install -y \
        git \
        curl \
    && rm -rf /var/lib/apt/lists/*

# Set up a user (optional)
ARG USERNAME=developer
ARG USER_UID=1000
ARG USER_GID=$USER_UID

RUN groupadd --gid $USER
