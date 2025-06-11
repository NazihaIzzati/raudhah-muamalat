#!/bin/bash

# Set colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}Running Authentication Tests...${NC}"
echo -e "${BLUE}=============================${NC}"

# Clear cache and optimize
echo -e "${BLUE}Clearing cache...${NC}"
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Run the tests
echo -e "${BLUE}Running Login Tests...${NC}"
php artisan test --filter=LoginTest

echo -e "${BLUE}Running Registration Tests...${NC}"
php artisan test --filter=RegisterTest

echo -e "${BLUE}=============================${NC}"
echo -e "${GREEN}Authentication tests completed!${NC}" 