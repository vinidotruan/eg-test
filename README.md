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
First of all, I wanted to see what the most commonly used data in this type of situation was, and then I wanted to structure the database in a simple way because later it would be analyzed by an AI and I didn't want to have to think about cleaning up the data and things like that.
With that done, I went on to make an API to register this data in an easy way for me and any smart device that wants to do this, which is why I didn't even create the other API methods like index/update/destroy, I wanted to keep it small and simple.

After that, I was concerned about showing this to the end user in a simple way and I thought that the best way would be through graphics, so I asked chatgpt for a little help to generate an interface with tailwind css so that I could show the graphics in a coherent way.

The next step was to implement the integration with OpenAI, this was surprisingly easy, I just created a token on the site, put it in the .env, made an http call with a small prompt and the raw data. And as I said, chatgpt understood me really well without any additional data processing. After that, I created an entity to save it in a history and show it to the user more easily. I added a limit of 2 hours minimum between each query using chatgpt to avoid wasting tokens.

Some changes that I think could be made in order to ensure greater maintainability is to create a “query scope” or an attribute that removes the repetition of code that limits the resources to the last 100 of each to show in the graphs.
