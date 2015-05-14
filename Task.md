# PHP Architectural Struggle v2.0

The attachment named example.php is a simple PHP script.
It's job is to serve one json-encoded string in response to an http request.
The script is also using examples.csv for fetching data.

Your job is to refactor this script. Remove all mistakes and bad practices,
create some structure of folders and files that will contain classes,
design architecture as if this simple script was a small part of a much bigger project.
In other words: pimp up this script! This is more about the architecture of your code and
less about the function itself.

We will assess you on the structure, the hierarchy of objects and the overall design.
Take into consideration how clean your code is and how easy it is to read and understand it.
Avoid tight coupling between any layer you introduce to this code and remember
that this code should be easy for further extension by somebody else.

Also, using the created code, add a full CRUD feature to it.
You may change e data storage system if you want.
In the end, the system should allow to add a new entry and/or remove update existing ones.
There is no need to create any form of UI.

You have the total freedom to decide on how to achieve this.
There are, however, some rules as described below:

* You may not use any external library or framework except from the ones used to Unit Test the solution.
* After refactoring, this code must do the same thing.
* You have to use MVC pattern (or similar).
* You could use any other pattern if you feel like it.
* You should conform to programming principles.
* You have to use OOP.
* You have to do it in RESTful style.
* You should introduce some framework-like feature (routing, dispatching, autoloading).
* You have to use at least PHP 5.3 (namespace is mandatory).
* You can use psr-0 autoloading system.
* You can put comments where you describe why you do certain things or just explaining some more high level decision.
* You can change storage system for contact data.
* All above rules are very important!

Have to, may not - this is mandatory.
Could, should - this is strongly recommended.
Can - it's up to you.

# Bonus

Cover the code with Unit Tests or even better, build it using a TDD approach!

# Final notes:

Remember that this is Web-based application, http statuses are important.
Code should have some basic exception control and data validation.
You can use REST architecture - this will be a plus.
The design of this code is more important than it’s function.
Focus on good, clean architecture!
Follow programming principles! If you don’t know (but I know) what that is,
search SOLID in object oriented design.

# Support

Should you have any questions or concerns, please do get in touch.