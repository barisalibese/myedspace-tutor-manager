# myedspace-tutor-manager

Mini Tutor App is ready to launch

You can find further instructions for installing the App

#### Critical note: For implementing this project to run you need to use Docker


## Installing Project

```bash 
  docker compose build
  docker compose up
  docker exec -it myedspace-tutor-manager composer install    
  docker exec -it myedspace-tutor-manager cp .env.example .env
  docker exec -it myedspace-tutor-manager php artisan migrate
  docker exec -it myedspace-tutor-manager php artisan db:seed
  docker exec -it myedspace-tutor-manager yarn install
  docker exec -it myedspace-tutor-manager yarn build
  docker exec -it myedspace-tutor-manager php artisan storage:link
  docker exec -it myedspace-tutor-manager php artisan optimize:clear
```

## Design Patterns and Architectural Choices and Recomendations

Used a Repo Patterns and Business layer (services) for the code Architecture

used repo pattern cause of reusable of the db queries

For the future implementations and complexity of project might be used DDD (Domian Driven Design) pattern but in this case it is not necessary

Might used modular domain structure for if a business gets complex and teams getting bigger you can seperate domains easily to microservice using that kind of structure

For the more complex features like payment systems we could use strategy pattern for different payment third party implementations


## Used Technologies

**Technologies:** Docker,Laravel,Livewire,Filament,Pint,PhpUnit,Nginx,Mysql

## Testing

For Initializing Test and Coverage
```bash
  docker exec -it myedspace-tutor-manager php artisan test --coverage
```


## Recomendations for tools

- For monitoring errors [sentry](https://docs.sentry.io/platforms/php/guides/laravel/) tool you can use and find the documentation

- CI/CD pipeline implementation and implementing the test during this automation
- For scability we can implement kubernetes
- For monitoring logs we can use ELK 
  
