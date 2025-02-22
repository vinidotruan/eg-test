# Work Test
```
 The trial project is designed to take around 8 hours to complete. No need to rush or submit it exactly 8 hours after receiving this email—this is just the estimated time we expect you to spend on it. Feel free to fit it into your schedule in a way that works best for you.

Here’s what we’d like you to build for the trial:

- Create a health monitoring application using Laravel.
- It needs to provide data to the end-user in an useful manner.
- Develop a method for smart devices to send health data to the application over the internet. 
- Implement a feature that detects anomalies in the data by leveraging the OpenAI API.
- If you need to make decisions to simplify any aspects of the project due to time constraints, please document your reasoning.
- If you finish before the allocated time, feel free to add additional features or enhancements that you find interesting.

When you are finished, please provide not only the project itself but also a detailed description of your process, progress, and any challenges you encountered. Share how you approached the specifications, the difficulties you faced, and any other details that would help us better understand your work.
```

# To Test
- run `php artisan migrate --seed`
- setup `OPEN_AI_KEY` on .env file
- run `composer run dev`
- access `localhost:8000` to login with example user (see on `TestUserSeeder.php`)
- should be redirected to the dashboard after the login
- to test the OpenAI integration, should click on 'Consult Anomalies' button.
    - should reload the page and display a new anomaly based on migrated data.
- to access the api docs, just access `localhost:8000/docs/api`
    - to access the auth protected routes, do the login request first, get the token and put on the `Token` field.

# Context of Development
## Why SQLite?
SQLite is a really good tool to do POCs like this, u can easily manage a lot of data and still with a good performance. No configurations like host, users or anything like this, just plug and play.

## Why not use docker/sail
IMO sometimes setting up docker is more hard than setup the php on a machine.

## Decisions
So I used the breezy starter kit to set up the login stuff, breezy makes it easy and fast for a simple front end. For the smart device step, I had used the sanctum api authentication to make it secure and easy as well.

My proccess doing this was really straightforward, I just get what kinda health data I should store (heart beats, blood pressure, steps in a day, weight and height), after that I made the migrations of each and the models. In the models I decided not to put the relationships in the 'health entities' because I will not use them, but in the user models has all the relationships with the 'health entities'.

After this I jumped to the frontend step to display the data for the end user, in this step I just used chartjs lib to make it easy to see, I think that is more intuitive for the users to see with image charts instead of text, wrote it on the dashboard file at the first try just to see how it will be, and asked for a little tailwind css help in chat gpt. All done, I go to the open ai integration.

This one really surprised me because it was really easy and fast, I just set a token and made a prompt like on the documentation and it surprisingly understood the data I've sent on the first way. I think if I can process the data and add some more description like "see the observations" and things like that, it should be more accurate. To protect the company side from wasting money I've added a minimum time of 2 hours interval to make a new consultation.
I decided to do the test on the scheduled time, so I don't have any other good feature except the possibility to see the history of anomalies.

Some of the planned improvements that I could implement is to make a general scope to get the last 100 records of users health relationships to display.

I choose not to put more methods on the REST controllers just to make it easier to analyze, and in the actual context there is no need to use index/update/delete.
