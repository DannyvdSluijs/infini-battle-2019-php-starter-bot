.PHONY: publish upload

URI := https://infinibattle.infi.nl
APIKEY :=  	<your bot api key here>

all: help

help:
	@echo "Infinibattle Starterbot"
	@echo ""
	@echo "make build - build the bot"
	@echo "make upload - upload the bot that has been build"
	@echo "make publish - build & upload"

publish: build upload

upload:
	@echo Publishing your bot...
	curl --insecure -X POST -Ffile=@./build.zip $(URI)/api/uploadBot/$(APIKEY)

build:
	composer dumpautoload
	zip -r build.zip *
