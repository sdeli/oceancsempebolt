<?php
namespace Inc;

class Config 
{
  const ENVIRONMENT_TYPE_LOCAL = 'local';
  const ENVIRONMENT_TYPE_DEV = 'development';
  const ENVIRONMENT_TYPE_PROD = 'production';
  // const WP_ENVIRONMENT_TYPE = ENVIRONMENT_TYPE_PROD;
  const WP_ENVIRONMENT_TYPE = ENVIRONMENT_TYPE_PROD;
  // const WP_ENVIRONMENT_TYPE = ENVIRONMENT_TYPE_DEV;
}