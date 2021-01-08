<?php

/**
 * @package This a User Display Table Plugin
 */
/*
Plugin Name: displaytable Plugin
Plugin URI: https://github.com/leightonoff/Wordpress-Users-Display-Table
Description: Display table Plugin for Users from 
Version 1.0.0
Author: Leighton Cotterell
Author URI: https://github.com/leightonoff/Wordpress-Users-Display-Table
License: MIT License
Text Domain: displaytable-plugin
 */


/*
MIT License

Copyright (c) 2020 leightonoff

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
 */


defined('ABSPATH') or die('Hey, you are not suppose to be here human!');



function users_page()
{
  include_once plugin_dir_path(__FILE__) . 'views/users-table.php';
  echo "This is a simple message";
  $template = ob_get_contents();

  dd($template);
  return $template;
}




class DisplaytablePlugin
{
  function __construct()
  {
    add_action('init', array($this, 'getdata'));
  }


  function activate()
  {
    // flush rewrite rules    
    flush_rewrite_rules();
  }


  function deactivate()
  {
    flush_rewrite_rules();
  }

  function uninstall()
  {
  }

  function add_my_custom_page()
  {
    $user_id = get_current_user_id();
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags('Display Users'),
      'post_content'  => '[foobar]', //shortcode tag
      'post_status'   => 'publish',
      'post_author'   => $user_id,
      'post_type'     => 'page',
    );

    // Insert the post into the database
    wp_insert_post($my_post);
  }

}

add_shortcode('foobar', 'ap_shortcode_form');
function ap_shortcode_form($atts)
{
  ob_start();
?>
  <html>

  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" herf="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="container">

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" role="img" class="iconify iconify--ri" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" style="transform: rotate(360deg);"><path d="M12 10.586l4.95-4.95l1.414 1.414l-4.95 4.95l4.95 4.95l-1.414 1.414l-4.95-4.95l-4.95 4.95l-1.414-1.414l4.95-4.95l-4.95-4.95L7.05 5.636z" fill="currentColor"></path></svg>
              </button>
            </div>
            <div class="modal-body" id=userdata>
              hjiiiu
            </div>
          </div>

        </div>
      </div>

      <div class="table-responsive">
        <br />
        <table class="table table-bordered table-striped" id="employee_table">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
          </tr>
        </table>
      </div>

    </div>
  </body>

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    /* The Modal (background) */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      padding-top: 100px;
      /* Location of the box */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      width: 80%;
      border-radius: 0.15rem;
      position: relative;
      padding: 1rem;
    }

    .modal-header {
      display: flex;
      flex-direction: row;
      align-items: flex-end;
      justify-content: flex-end;
      position: absolute;
      padding-right: 1rem;
      right: 0;
    }

    /* The Close Button */
    .close {
      display: grid;
      place-items: center;
      place-content: center;
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      color: rgba(0, 0, 0, .48);
      background: rgba(0, 0, 0, .12);
      border: none;
      font-size: 1rem;
      font-weight: bold;
    }

    .close svg {
      fill: rgba(0, 0, 0, .72);
      width: 1rem;
      height: 1rem;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
  </style>

  </html>

<script>
  // Define api endpoint and our cache
  const api = `https://jsonplaceholder.typicode.com/users`
  const cache = {}

  /**
   * This function will fetch a resource and cache the resource
   * 
   * @param url - The url parameter to fetch/cache
   */
  const retriveResource = (url) => {
    return new Promise((resolve, reject) => {

      if (cache[url])
        return resolve(cache[url])

      fetch(url)
        .then(response => response.json())
        .then(data => {
          cache[url] = data
          resolve(data)
        })
        .catch(error => reject(error))
    })
  }


  

  /**
   * Populates the table with the inital user data and displays any errors
   * if any occur
   */
  const populateTable = () => {
    const employeeTable = $('#employee_table')

    return new Promise((resolve, reject) => {
      // Fetch Employee Data
      retriveResource(api)
        .then((data) => {
          let employeeData = ``;

          // Generate table from employee data
          data.forEach(user => {
            employeeData += `
              <tr>
                <td><a href="#" data-id="${user.id}" class="counter">${user.id}</a></td>
                <td><a href="#" data-id="${user.id}" class="counter">${user.name}</a></td>
                <td><a href="#" data-id="${user.id}" class="counter">${user.username}</a></td>
              </td>`
          })

          // Populate employee table data
          employeeTable.append(employeeData)
          setupModal()
        })
        .catch((error) => {
          // Handle error by displaying a message to the user
          employeeTable.html(`<div>There was an error retriving the employee data.</div>`)
        })
    })
  }

  /**
   * Setup modal and define triggers on each table item to display
   * employee information when a user clicks on an employee
   */
  function setupModal() {
    const modal = $('#myModal')
    document.querySelectorAll('a.counter').forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault()
        const id = e.target.getAttribute('data-id')

        retriveResource(`https://jsonplaceholder.typicode.com/users`)
          .then((data) => {
            let user = null
            for (const u of data) {
              if (parseInt(u.id) === parseInt(id)) {
                user = u
                break;
              }
            }
            const htmlData = `
              <ul>
                <li>Id: ${user.id}</li>
                <li>Name: ${user.name}</li>
                <li>Username: ${user.username}</li>
                <li>Email: ${user.email}</li>
                <li>
                  <b>Address</b>
                  <ul>Street: ${user.address.street}</ul>
                  <ul>Suite: ${user.address.suite}</ul>
                  <ul>City: ${user.address.city}</ul>
                  <ul>Zipcode: ${user.address.zipcode}</ul>
                  <ul>
                    <b>Geo</b>
                    <ul>
                      <li>Lat: ${user.address.geo.lat}</li>
                      <li>Lng: ${user.address.geo.lng}</li>
                    </ul>
                  </ul>
                </li>
                <li>Phone: ${user.phone}</li>
                <li>Website: ${user.website}</li>
                <li>
                  <b>Company</b>
                  <ul>
                    <li>Name: ${user.company.name}</li>
                    <li>CatchPhrase: ${user.company.catchPhrase}</li>
                    <li>BS: ${user.company.bs}</li>
                  </ul>
                </li>
              </ul>        
            `

          modal.find('.modal-body').html(htmlData)
          modal.modal('show')
        })
        .catch(error => {
          modal.find('.modal-body').html(`<div>There was an error retriving the employee data.</div>`)
          modal.modal('show')
        })
      })
    })
  }

  $(document).ready(() => {
    populateTable()
  });
</script>

<?php
  $html_form = ob_get_clean();
  return $html_form;
}



if (class_exists('DisplaytablePlugin')) {
  $displaytablePlugin = new DisplaytablePlugin('Table is initialized!');
}



//activation
register_activation_hook(__FILE__, array($displaytablePlugin, 'activate'));
register_activation_hook(__FILE__, array($displaytablePlugin, 'add_my_custom_page'));
register_activation_hook(__FILE__, array($displaytablePlugin, 'users_page'));



//deactivation
register_deactivation_hook(__FILE__, array($displaytablePlugin, 'deactivate'));

//uninstall
//register_uninstall_hook(__FILE__, array( $displaytablePlugin, 'uninstall'));


?>