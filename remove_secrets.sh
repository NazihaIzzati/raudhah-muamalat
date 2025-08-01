#!/bin/bash

# Remove sensitive data from git history
git filter-branch --force --index-filter \
'git rm --cached --ignore-unmatch docs/FPX_Actual_Values_Reference.md docs/FPX_Environment_Configuration.md docs/FPX\ Intergration/FPX_Actual_Values_Reference.md docs/FPX\ Intergration/FPX_Environment_Configuration.md' \
--prune-empty --tag-name-filter cat -- --all

# Force push to update remote repository
echo "Secrets removed from git history. You may need to force push with: git push --force-with-lease origin master" 