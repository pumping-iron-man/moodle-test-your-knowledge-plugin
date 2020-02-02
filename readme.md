# Test your knowledge-Plugin

## Supported Moodle versions
The plugin currently works with Moodle 2.7 or later versions.

## What Moodle type it is
Block

## Level of knowledge of Moodle functionality
Newbie (therefore this plugin is a very simple approach to understand Moodle)

## What this Moodle plugin is for
- Plugin shows random questions from the content of a module at university and down below the specific answer (for the test we used random questions with no sense behind)
- On every reload a random question is shown
- The additional button on the block reloads the site and shows therefore another random question

## How to start the plugin
1. Download Moodle-XAMP-Package from moodle.org
2. Open Start Moodle.exe file
3. Open localhost with(-out) port (depending on initial settings at installation)
4. Put this folder in the blocks folder
5. Reload Moodle site at localhost and upgrade
6. Add block to your site with clicking on the 'Customize your page'-button -> 'Add a block'-button

## Problems

- the Event API was not fully understood due to lack of different examples, therefore log entries are made, but the database is accessed directly instead through the API.
