# WordPressPlug-User-Table
A wordPress plugin in to build an display a HTML table from a JSON fetched from a online REST Api dispalying the details of a users profile formatted with css for visuals.

## Contents
The WordPress Plugin User Table includes the following files:
- .gitignore. Used to exclude certain files from the repository.
- README.md. The file that you’re currently reading.
- A " " directory that contains the source code - a fully executable WordPress plugin.


## Features
- A table with users’ details is visible when visiting the custom endpoint.
- Clicking a user name/username/id in the table loads that user's details via AJAX and print them in the page.


## Installation
The User-Table plugin can be installed directly into your plugins folder "as-is". You will want to rename it and the classes inside of it to fit your needs. For example, if your plugin is named 'example-me' then:
- rename files from plugin-name to example-me

## How to Use
- Navigate to Plugins section on your wordpress dashboard
- Click the activate button on the plugin named "displaytable Plugin"
- A table a new page should be created with name of th epage being "" and table on the page displaying the parsed JSON reposne from the rest API at "https://jsonplaceholder.typicode.com" along with clickable links in the table to open details of different user's asynchronously.


## Authors
# Leighton Cotterell

## License
This project is licensed under the MIT License - see the LICENSE.md file for details


