#!/bin/sh

authroot="http://auth.cubition.net/" # put the root of the auth server here

printf "Checking for correct files and permissions...\n";
printf "sha1.php\t\t"

if [ -r gen.php ]
then
	printf "[yes]\n"
else
	printf "[no]\n"
	exit
fi

printf "gen.php\t\t\t"

if [ -r gen.php ]
then
	printf "[yes]\n"
else
	printf "[no]\n"
	exit
fi

printf "%s\t\t" $1

if [ -w $1 ]
then
	printf "[yes]\n"
else
	printf "[no]\n"
	exit
fi

printf "\nChecking commands...\n"

cp=`which cp`
mv=`which mv`
rm=`which rm`
php=`which php`

printf "cp\t\t\t"

if [ -x $cp ]
then
	printf "[yes]\n"
else
	printf "[no]\n"
	exit
fi

printf "mv\t\t\t"

if [ -x $mv ]
then
	printf "[yes]\n"
else
	printf "[no]\n"
	exit
fi

printf "rm\t\t\t"

if [ -x $rm ]
then
	printf "[yes]\n"
else
	printf "[no]\n"
	exit
fi

printf "php\t\t\t"

if [ -x $php ]
then
	printf "[yes]\n"
else
	printf "[no]\n"
	exit
fi

printf "\nChecking uname...\t"
name=`uname -s`
printf "%s\n" $name

json=`${php} --file gen.php $1 $2 $3 $authroot $name`
newname=`printf "%s-v%s.jar" $3 $2`
newjson=`printf "%s-v%s.json" $3 $2`

mv $1 ../private/versions/$newname
cd ../private/versions/
echo $json > $newjson

currname_jar=`printf "%s-Current.jar" $3`
ln -fs $newname $currname_jar

currname_json=`printf "%s-Current.json" $3`
ln -fs $newjson $currname_json