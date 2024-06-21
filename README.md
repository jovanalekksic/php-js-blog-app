# Kohana Setup Instructions

1. **Kohana Repository**:
   Pull the kohana repository in src directory.

2. **Docker Setup**:
   Navigate to the `docker` directory and use the provided `docker-compose.yml` file to set up your environment.
   ```sh
   cd docker
   docker-compose up -d
   ```

3. **Database Setup**:
    Access the MySQL container and set up your database.
    ```sh
    docker exec -it kohana_mysql bash
    mysql -u root -p
    CREATE DATABASE blog;
    ```
    - And other commands to generaate tables you need

4. **Running the Application:**
    Access the application by navigating to http://localhost:8080 in your web browser.


