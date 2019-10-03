MSG = "Push my codes."
BRNC = master
URL = ""


help:
	@cat Makefile

set:
	git branch ${BRNC}
	git checkout ${BRNC}
	git branch

push:
	git add .
	git commit -m ${MSG}
	git push origin ${BRNC}

pull:
	git pull origin master

open:
	open ${URL}
	sudo apachectl restart

end:
	sudo apachectl stop
