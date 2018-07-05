<p align="left">
    <a href="https://travis-ci.org/ismailatkurt/cash-machine-code-challenge" alt="Backers on Open Collective">
        <img src="https://travis-ci.org/ismailatkurt/cash-machine-code-challenge.svg?branch=master" /></a>
</p>

#### Run with Docker development environment

(those steps will be changed since it should not be required to stop services on 80 port and also docker should take care of hostname on host machine by itself or with docker command.)
- have docker on your machine.
- kill any application which uses 80 port.
- go to project folder on terminal
- execute:
`docker-compose up`
- add local.cashmachine.com to your hosts file
    `127.0.0.1 local.cashmachine.com`
- visit http://local.cashmachine.com/notes/withdraw/120