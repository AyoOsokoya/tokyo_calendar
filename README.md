# Calendar Aggregator
![Calendar Image](calendar.png)

I'm always missing amazing events in Tokyo.
This the first part of an event aggregator aimed at placing almost every event I can find online into a calendar using
Python to scrape the events and Laravel to distribute the events as an iCal format.


To install, you need a basic Laravel setup. In ```.env``` add your database credentials. In the project directory run:

```sh
    composer install
    sail artisan migrate
    sail artisan db:seed
```
Add ```http://localhost/api/v1/user/events``` to your local calendar or view the url in a browser for text output.

Pretty bare-bones at the moment. No auth as I don't need it yet.

Enjoy :)
