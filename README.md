# Anderwijs website
This repository includes two parts. The Content Management System (CMS) and the front-end.

### Requirements
To start it locally you will need have the following packages installed:

- docker
- docker-compose
- curl
- make

### Starting
To start the local dev environment run `make install` after which you can run `make start` for good measure.
To stop it simply run `make stop`.

When it runs it you will have the following endpoints available

| url | description |
|---|---|
|http://cms.anderwijs.local/| The CMS |
| http://anderwijs.local/ | The front-end (not yet available) |

### Troubleshooting
This setup works by forwarding the domains in hostnames.txt to the docker network (specifically the traefik proxy). 
If the domains are unreachable you need to ensure the enrise-dev-proxy runs. You can check traefik's endpoints by going
 to http://localhost:10080/ . 

If you get a gateway error or an not found error it means traefik is unable to connect through to the CMS container.
- You can debug this by checking if the anderwijs_cms_cms and anderwijs_cms_web runs `docker ps` or `docker-compose ps`. 
- Check if the anderwijs_cms_cms , anderwijs_cms_web and enrise-dev-proxy run in the anderwijs network with `docker network inspect anderwijs`.
- Check http://localhost:10080/ if it has a rule for the endpoint

