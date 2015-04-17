<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Conceptual Model</title>
	</head>
	<body>
		<h1><strong><em>Conceptual Model</em> Mock Up Based on Duke City Fix Website (DCF)</strong></h1>
			<p>A fictional <em>conceptual</em> model I've created for DCF<br/></p>
		<h2><strong>User Profile Details</strong></h2>
			<p>User Data Required to make create content and comment</p>
			<ul>
				<li>E-mail address</li>
				<li>Full Name (one field)</li>
			</ul>
			<p>User Data Required by site but unnecessary to create content and comment</p>
			<ul>
				<li>Gender</li>
				<li>Country</li>
				<li>Zip</li>
				<li>About Me Comment (displayed with blog posts)</li>
				<li>Neighborhood ("where I live")</li>
				<li>What Am I (business vs person)</li>
			</ul>
		<h3><strong>Blog Details</strong></h3>
			<p>Data required for a blog post</p>
			<ul>
				<li>User Full Name</li>
				<li>Blog Title</li>
				<li>Content (text, photos, etc.)</li>
				<li>Publish Date/time (user controlled)</li>
			</ul>
			<h4><strong>Blog Comment</strong></h4>
				<p>Data required for a blog comment</p>
				<ul>
					<li>User Full Name</li>
					<li>Blog Title</li>
					<li>Comment (text)</li>
					<li>Timestamp (not user controlled)</li>
				</ul>
		<h5><strong>Relationships</strong></h5>
		<p>Notes on relationships</p>
		<ul>
			<li>Each user can have only one profile (uniquely defined by email address and name)</li>
			<li>Each user can author many blog posts</li>
			<li>Each blog post can have only one author</li>
			<li>Each blog post can have many comments</li>
			<li>Each user can author many comments</li>
			<li>Each comment can have only one author</li>
			<li>Each comment can be associated with only one blog post</li>
			<li></li>
		</ul>
		<h6><strong>High Level ERD Diagram</strong></h6>
		<figure>
			<img src="../images2/dcf_diagram.svg" alt="DCF ERD AKA Look at the pretty arrows">
		</figure>
	</body>
</html>