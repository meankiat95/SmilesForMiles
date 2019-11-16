# SmilesForMiles
2201 Team 24 Smiles for Miles Project

## Introduction

## Updated Component Diagram
![Component Diagram](https://raw.githubusercontent.com/qwacsawd/SmilesForMiles/master/Images/Domain%20Object%20Modeling%20Example%20-%20Component%20Diagram.png)

## How to run

## Appendix

### Installation Guide
This portion of the readme would explain the various requirements needed to setup the server & android application for testing the SmilesforMiles application

### 1) Setting up a web server

Requirements for web server
  * VirtualBox/VMWare Workstation
  * 2GB RAM
  * 10 GB Storage Space
  * 2 Cores

  Download the .ova file of the pre-exported webserver from this link: [Here](https://drive.google.com/open?id=1p9gm9_exVeCiIgwtNIiAB_qnpEsXqFXJ)

### 2) This would include a preconfigured XAMPP and Apache webserver with HTTPS 

  **Why is this needed?**

  To prevent Man-In-The-Middle(MITM) attacks, a secured web server is configured to prevent hackers from being able to modify the GET/POST request between the application and the server to prevent unauthorized use and illegal actions within the application. This would include HTTPS configuration and HTTP2 to prevent proxy tools from being able to intercept and modify the request and response within the application.

  (Insert screen shot here)
  
### 3) Android Application Shell 

  **Why is this needed?**
  
  To prevent modification of GET requests via URL modification, the android application is attached to this project even though it is a web based application. Since the android application is able to hard code a fix URL into the loadUrl parameter, user's will not be able to modify or view the URL.
  
  (Insert screen shot here)
  
