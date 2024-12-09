# The Inventory Management System
- [Installation](#Installation)
- [Introduction](#Introduction)

## Installation
Before you begin, please ensure that you have Docker and Kubernetes (k8s) installed on your machine. Follow the steps below to set up the project.

### Step 1: Navigate to the Project Directory
Open your terminal and navigate to the project directory:
`cd ./phpnginxups`

### Step 2: Prepare the CodeIgniter Source Code
The source code for the CodeIgniter project is located in the directory `./phpnginxups/codeigniter` You can either build a Docker image from this code yourself or pull the existing image from my Docker Hub.

#### Option 1: Build the Docker Image
If you want to build the Docker image yourself, create an image from the CodeIgniter source code by `docker build -t <name> .` You may need to push the image into docker hub or registry to ensure the image can be pulled. Then modify the image name in `php-nginx.yaml`

#### Option 2: Pull from Docker Hub
You can pull the existing image from Docker Hub. The address is provided:
`docker pull ephemeraes/registryau:phpdemo-v33`

### Step 3: Apply Kubernetes Configuration
The program uses four Nginx servers and three PHP servers. 

One Nginx server is responsible for receiving external traffic and distributing it to the backend servers.

Three Nginx servers are used to cache static content or accelerate dynamic content, thereby reducing the load on the backend servers and improving response speed.

Three PHP servers are utilized to ensure the availability of the project.

If you feel that you do not need this many replicas, you can modify it in the replicas.

Once you have your Docker image ready, use the following command to apply the Kubernetes configuration:
`sudo kubectl apply -f .`

### Step 4: Database Setup
To set up the database:
Open your web browser and go to `http://<EXTERNAL_IP_ADDRESS>:30000`. Log in with default account.

Default Account
`Username: root
Password: mysql@admin`

Import the menuscanorder.sql file into the database.

Notice: If you cannot access the address, please reset the firewall rules to ensure that port 30180 (project), 30000 (phpmyadmin) and 30306 (mysql) are avaliable.

### Step 5: Access the Project
You can log in to the project using the following URL: 
`http://<EXTERNAL_IP_ADDRESS>:30180`

Default Account
`Username: 1
Password: test3`

## Introduction
This project is an inventory management system designed for manufacturing companies. The front-end is a CodeIgniter application. MySQL is used in the backend to store data. Additionally, PhpMyAdmin is used for IT teams to simplify database management. For stock clerks, they can view and manage the details of the specific products. For managers, they can manage the operation history of the clerks and supervise the data through data visualization functions.