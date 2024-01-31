# Week 1 | Getting Started
Welcome to the UW Cybersecurity Password Manager! Until now, this password manager has been used internally by you and your team for work-related password management. Your boss has decided that this password manager could make a great consumer product and would like to make it publicly available by the end of the quarter. You know that in the web application's current state, there are numerous security issues that need to be addressed before the general public can safely use this service. Over the next several weeks, you will apply what you learn in lecture to identify vulnerabilities in this web app, remediate them, and ensure that the web application maintains it's functionality. By the end of the quarter you will be left with a totally secure password manager!

Feel free to use whichever IDE (integrated development environment) you prefer for this course. The teaching team will primarily be using Visual Studio Code during lab section, and all demos and examples in the lab instructions will be shown in VS Code. You can download VS Code [here](https://code.visualstudio.com/Download)!

## Docker basics

This web application runs in Docker. Docker is a platform for developing and deploying applications within containers. Containers are self-sufficient units that are capable of running an application and all of it's dependencies isolated from the underlying operating system. This is extremely helpful in a development and testing environment as it allows us to run applications regardless of an end user's operating system/machine. Below is some important terminology to use moving forward:

1. **Docker Image:** An image is a standalone executable package that includes everything needed to run a piece of software, including the code, libraries, environment variables, and system tools. 

2. **Docker Container:** A container is a running instance of a Docker image and provides an isolated environment for running applications ensuring that they run consistently across different environments. 

3. **Docker Volume:** A volume in Docker is a way to persistently store and manage data that is generated and used by our Docker containers. Volumes also allow us to share data between containers easily. The great thing about using volumes in Docker is that they data inside a volume can remain in that volume even after the container is stopped and removed.

### 1. Deploying the web app with Docker

1. You will need to install Docker Desktop, which can be downloaded [here](https://www.docker.com/products/docker-desktop/). Follow the installation instructions, and note that you do not need to create a Docker account.

2. Once you have Docker installed and open, fork this github repository and clone your forked repo.

3. Inside `2024-INFO-310-Password-Manager > bin > start.py` is a python script that will deploy our web application. When we run it, the script will build our docker containers following the `docker-compose.yaml` file.:
    ```
    python .\bin\start.py
    ```

    To shut down our web application, we can run the `stop.py` script:

    ```
    python .\bin\stop.py
    ```

4. We now have our web application running in Docker! You can access it at [http://localhost:80](http://localhost:80). Take a look at the Docker Desktop application. Under Containers, you should see that we have one container running with three separate images:

![Docker Container](/lab-writeup-imgs/docker_container.png)

Our three images include:

- A MySQL server for handling our sql database.
- An Nginx server to handle static content and acts as a reverse proxy, forwarding our client's requests to the appropriate backend server (in this case our PHP server).
- A PHP server handles the dynamic content and runs our PHP scripts, executing server-side code and communicates directly with the database.

### Part 2: Using our web application:
Now that we have our Docker container deployed, and we are able to see our password manager at [http://localhost:80](http://localhost:80), we can begin exploring everything that it can do!

1. Once on the main page, you will be prompted to login. Since this password manager is only used by our team, it is much easier if we all use the same login credentials! This way we will never forget our login and can easily see all passwords needed for our work. It is nice to not have to worry about all that security nonsense :) Use the credentials below to login:

```
username: username
password: password!
```

![Create an account](/lab-writeup-imgs/login.png)

2. Now that you have logged in, you should be able to see the password manager's homepage.

![Password Manager Homepage](/lab-writeup-imgs/password_manager_homepage.png)

3. In the top right corner, you will see "Vaults". Click on that to view all password vaults used by your company.

![Password Vaults](/lab-writeup-imgs/password_vaults.png)

4. As you can see, the vaults are divided by department. You can edit the name of the vaults, or delete the vaults entirely. You can also add a new password vault at the top of the page. Click 'View Vault' to see the passwords stored in each vault.

![Developer's Vault](/lab-writeup-imgs/developers_vault.png)


##
Congratulations on successfully setting up Docker! We will be using this for each lab assignment throughout the quarter. If you run into any issues or have any questions, please don't hesitate to reach out the the teaching team, we are here to help!

Please refer to the canvas lab assignment page for the rubric and instructions on submitting the write up.