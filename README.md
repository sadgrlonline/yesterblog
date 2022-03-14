# Yesterblog

I created this tool to make it easy to host and manage a blog on [Yesterweb.org](https://yesterweb.org/)

It uses PHP 7.4.

# Features
- "Blogroll" homepage
- Login authentication
- Dashboard overview
- Approval page
- Blog comments
- Submission page
- List page 
- Author bio
- Edit functionality

# To do
- Add pagination, probably
- Add form for submitting/approving blog ideas
- Add registration page (for admins)

# Database
There are four tables:
- blogs
- comments
- password_reset_temp
- users

Users and password_reset_temp are for registration/authentication.

Blogs table columns: id, owner_name, owner_email, owner_link, owner_bio, dateposted, timeposted, title, entry and approved.
Comments table columns: id, blogid, nickname, email, dateposted, comment.
