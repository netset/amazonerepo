<?php 

?>

<h2> Customer Register Form</h2>

<form action="http://worktestserver.com/development/restaurantapp/web_service/register" method="post" enctype="multipart/form-data">
User Name* :<input type="text" name="uname" > uname <br/>
Email id*   :<input type="text" name="email">email <br/>
Password*   :<input type="text" name="pwd">pwd <br/>
<input type="submit" >
</form>

<h2> Facebook Register/Login</h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/login_fb" method="post" >
Access token:<input type="text" name="access_token" >   access_token<br/>
<input type="submit" >
</form>

<h2>Get Facebook Friends</h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/get_fb_friends" method="post" >
Access token:<input type="text" name="access_token" >   access_token<br/>
<input type="submit" >
</form>



<h2> search restaurants</h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/get_hotels" method="post" >
Cuisine type* :<input type="text" name="type" > type <br/>
Budget* :<input type="text" name="Budget" > Budget <br/>
Location/Country/zipcode* :<input type="Location" name="Location" > Location <br/>
<input type="submit" >
</form>

<h2>Top Sponsors </h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/top_sponsors" method="post" >
Location* :<input type="Location" name="Location" > Location <br/>
<input type="submit" >
</form>




<h2>Add Fav</h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/add_fav" method="post" >
fb_id* :<input type="text" name="fb_id" > fb_id <br/>
restaurant_name* :<input type="text" name="restaurant_name" > restaurant_name <br/>
restaurant_id* :<input type="text" name="restaurant_id" >restaurant_id <br/>
reviews* :<input type="text" name="reviews" >reviews <br/>
yelp_price* :<input type="text" name="yelp_price" > yelp_price <br/>
website* :<input type="text" name="website" > website <br/>
hours* :<input type="text" name="hours" > hours <br/>
phone* :<input type="text" name="phone" > phone <br/>
address* :<input type="text" name="address" > address <br/>
menu* :<input type="text" name="menu" > menu <br/>
favorite* :<input type="text" name="favorite" > favorite 1=like 0=dislike <br/>


<input type="submit" >
</form>

<h2>GET Fav</h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/get_fav" method="post" >
fb_id* :<input type="text" name="fb_id" > fb_id <br/>
<input type="submit" >
</form>

<h2>Invite Friends</h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/invite_friend" method="post" >
fb_id* :<input type="text" name="fb_id" > fb_id <br/>
friends * :<input type="text" placeholder="12,45,48,78" name="friends" >friends <br/>
date * :<input type="text" placeholder="2014-12-238" name="date" >date <br/>
time * :<input type="text" placeholder="12:30" name="time" >time <br/>
tablename * :<input type="text" placeholder="" name="tablename" >tablename <br/>

<input type="submit" >
</form>

<h2>GET Invite Friends</h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/get_invite" method="post" >
fb_id* :<input type="text" name="fb_id" > fb_id <br/>
<input type="submit" >
</form>


<h2>GET BY  factual_id</h2>
<form action="http://worktestserver.com/development/restaurantapp/web_service/getbyid" method="post" >
factual_id* :<input type="text" name="factual_id" > factual_id <br/>
<input type="submit" >
</form>


