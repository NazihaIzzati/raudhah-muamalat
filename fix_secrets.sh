#!/bin/bash

# Create a script to replace sensitive content in git history
git filter-branch --force --index-filter '
    if git ls-files --cached | grep -q "docs/FPX_Actual_Values_Reference.md"; then
        git show HEAD:docs/FPX_Actual_Values_Reference.md | sed "s/SG\.8rhzjEyQRBWY-wLOx6QcsA\.7qa5rtl2Za_w0p0sU7Y5-jZC3mlMnCx3hOfkyvEqpz0/YOUR_SENDGRID_API_KEY_HERE/g" | sed "s/u^1a+!ci=ki^=\$3-jaqts^jproj@8oa4da#t3!rgpn0(^=*=jqj94!&a(74fs_9o%pougcrd_&r51#+w-\$r=hppp3oecc#icx05^/YOUR_DJANGO_SECRET_KEY_HERE/g" > temp_file && git add temp_file && git mv temp_file docs/FPX_Actual_Values_Reference.md
    fi
    if git ls-files --cached | grep -q "docs/FPX_Environment_Configuration.md"; then
        git show HEAD:docs/FPX_Environment_Configuration.md | sed "s/SG\.8rhzjEyQRBWY-wLOx6QcsA\.7qa5rtl2Za_w0p0sU7Y5-jZC3mlMnCx3hOfkyvEqpz0/YOUR_SENDGRID_API_KEY_HERE/g" | sed "s/u^1a+!ci=ki^=\$3-jaqts^jproj@8oa4da#t3!rgpn0(^=*=jqj94!&a(74fs_9o%pougcrd_&r51#+w-\$r=hppp3oecc#icx05^/YOUR_DJANGO_SECRET_KEY_HERE/g" > temp_file && git add temp_file && git mv temp_file docs/FPX_Environment_Configuration.md
    fi
    if git ls-files --cached | grep -q "docs/FPX Intergration/FPX_Actual_Values_Reference.md"; then
        git show HEAD:"docs/FPX Intergration/FPX_Actual_Values_Reference.md" | sed "s/SG\.8rhzjEyQRBWY-wLOx6QcsA\.7qa5rtl2Za_w0p0sU7Y5-jZC3mlMnCx3hOfkyvEqpz0/YOUR_SENDGRID_API_KEY_HERE/g" | sed "s/u^1a+!ci=ki^=\$3-jaqts^jproj@8oa4da#t3!rgpn0(^=*=jqj94!&a(74fs_9o%pougcrd_&r51#+w-\$r=hppp3oecc#icx05^/YOUR_DJANGO_SECRET_KEY_HERE/g" > temp_file && git add temp_file && git mv temp_file "docs/FPX Intergration/FPX_Actual_Values_Reference.md"
    fi
    if git ls-files --cached | grep -q "docs/FPX Intergration/FPX_Environment_Configuration.md"; then
        git show HEAD:"docs/FPX Intergration/FPX_Environment_Configuration.md" | sed "s/SG\.8rhzjEyQRBWY-wLOx6QcsA\.7qa5rtl2Za_w0p0sU7Y5-jZC3mlMnCx3hOfkyvEqpz0/YOUR_SENDGRID_API_KEY_HERE/g" | sed "s/u^1a+!ci=ki^=\$3-jaqts^jproj@8oa4da#t3!rgpn0(^=*=jqj94!&a(74fs_9o%pougcrd_&r51#+w-\$r=hppp3oecc#icx05^/YOUR_DJANGO_SECRET_KEY_HERE/g" > temp_file && git add temp_file && git mv temp_file "docs/FPX Intergration/FPX_Environment_Configuration.md"
    fi
' --prune-empty --tag-name-filter cat -- --all

echo "Secrets replaced in git history. You may need to force push with: git push --force-with-lease origin master" 